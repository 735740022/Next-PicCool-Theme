<?php

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”
function reset_password_message( $message, $key ) {
if ( strpos($_POST['user_login'], '@') ) {
$user_data = get_user_by('email', trim($_POST['user_login']));
} else {
$login = trim($_POST['user_login']);
$user_data = get_user_by('login', $login);
}
$user_login = $user_data->user_login;
$msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
$msg .= network_site_url() . "\r\n\r\n";
$msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
$msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
$msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
$msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);




//支持中文名注册，来自肚兜
function ludou_sanitize_user ($username, $raw_username, $strict) {
  $username = wp_strip_all_tags( $raw_username );
  $username = remove_accents( $username );
  // Kill octets
  $username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
  $username = preg_replace( '/&.+?;/', '', $username ); // Kill entities
  // 网上很多教程都是直接将$strict赋值false，
  // 这样会绕过字符串检查，留下隐患
  if ($strict) {
    $username = preg_replace ('|[^a-z\p{Han}0-9 _.\-@]|iu', '', $username);
  }
  $username = trim( $username );
  // Consolidate contiguous whitespace
  $username = preg_replace( '|\s+|', ' ', $username );
  return $username;
}
add_filter ('sanitize_user', 'ludou_sanitize_user', 10, 3);


//WordPress 后台用户列表显示用户昵称
add_filter('manage_users_columns', 'add_user_nickname_column');
function add_user_nickname_column($columns) {
    $columns['user_nickname'] = '昵称';
    unset($columns['name']);
    return $columns;
}
add_action('manage_users_custom_column',  'show_user_nickname_column_content', 20, 3);
function show_user_nickname_column_content($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    $user_nickname = $user->nickname;
    if ( 'user_nickname' == $column_name )
        return $user_nickname;
    return $value;
}


//支持后台昵称搜索
function wpkj_extend_user_search( $u_query ){
    if ( $u_query->query_vars['search'] ){
        $search_query = trim( $u_query->query_vars['search'], '*' );
        if ( $_REQUEST['s'] == $search_query ){
            global $wpdb;
            // 添加昵称搜索查询语句
            $u_query->query_from .= " JOIN {$wpdb->usermeta} fname ON fname.user_id = {$wpdb->users}.ID AND fname.meta_key = 'nickname'";
            // 设置可搜索的字段
            $search_by = array( 'user_login', 'user_email', 'fname.meta_value' );
            // 应用到搜索
            $u_query->query_where = 'WHERE 1=1' . $u_query->get_search_sql( $search_query, $search_by, 'both' );
        }
    }
}
add_action('pre_user_query', 'wpkj_extend_user_search');



//禁止注册一些会员名
function sozot_validate_username($valid, $username) {
    $forbidden = array('directory', 'domain', 'download', 'downloads', 'edit', 'editor', 'email', 'ecommerce', 'forum', 'forums', 'favorite', 'feedback', 'follow', 'files', 'gadget', 'gadgets', 'games', 'guest', 'group', 'groups', 'homepage', 'hosting', 'hostname', 'httpd', 'https', 'information', 'image', 'images', 'index', 'invite', 'intranet', 'indice', 'iphone', 'javascript', 'knowledgebase', 'lists','websites', 'webmaster', 'workshop', 'yourname', 'yourusername', 'yoursite', 'yourdomain', 'admin', 'admins', 'administrator', 'administrators', 'manage', 'administer');
    $pages = get_pages();
    foreach ($pages as $page) {
        $forbidden[] = $page->post_name;
    }
    if(!$valid || is_user_logged_in() && current_user_can('create_users') ) return $valid;
    $username = strtolower($username);
    if ($valid && strpos( $username, ' ' ) !== false) $valid=false;
    if ($valid && in_array( $username, $forbidden )) $valid=false;
    if ($valid && strlen($username) < 5) $valid=false;
    return $valid;
}
add_filter('validate_username', 'sozot_validate_username', 10, 2);

function sozot_registration_errors($errors) {
    if ( isset( $errors->errors['invalid_username'] ) )
        $errors->errors['invalid_username'][0] = __( '错误：该用户名不允许注册！', 'sozot' );
    return $errors;
}
add_filter('registration_errors', 'sozot_registration_errors');



//挂钩WP后台用户列表
add_filter('manage_users_columns', function($column_headers){
    $column_headers['registered']       = '注册时间';
    return $column_headers;
});

//添加用户列表自定义列
add_filter('manage_users_custom_column', function($value, $column_name, $user_id){
    if($column_name=='registered'){
        return get_date_from_gmt(get_userdata($user_id)->user_registered);
    }
    else{
        return $value;
    }
},11,3);

//设置列可以排序
add_filter('manage_users_sortable_columns', function($sortable_columns){
    $sortable_columns['registered'] = 'registered';
    return $sortable_columns;
});