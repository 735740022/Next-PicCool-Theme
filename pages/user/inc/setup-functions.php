<?php

//修改资料
add_action('wp_ajax_noprive_edit_user_ww', 'edit_user_ww');
add_action('wp_ajax_edit_user_ww', 'edit_user_ww');
function edit_user_ww(){
    $current_user=wp_get_current_user();
    $error = 0;
    $msg = '';
    $uid = $current_user->ID;
    $email=$_POST['email'];
    $nickname=$_POST['nickname'];
    $description=$_POST['description'];

    $user_email = apply_filters( 'user_registration_email', $email );

    if ( $user_email == '' ) {
        $error = 1;
        $msg = '邮箱不能为空';
    } elseif ( email_exists( $user_email ) && $user_email != $current_user->user_email) {
        $error = 1;
        $msg = '邮箱已被使用';
    }else{
        $userdata = array();
        $userdata['ID'] = $uid;
        $userdata['nickname'] = str_replace(array('<','>','&','"','\'','#','^','*','_','+','$','?','!'), '', $nickname);
        $userdata['user_email'] = $email;
        $userdata['description'] = $description;
        wp_update_user($userdata);
        $error = 0;
        $msg = '用户资料修改成功';
    }
    $arr=array("error"=>$error,"msg"=>$msg);
    echo json_encode($arr);

    die();
}

//修改密码
add_action('wp_ajax_noprive_edit_user_pw', 'edit_user_pw');
add_action('wp_ajax_edit_user_pw', 'edit_user_pw');
function edit_user_pw(){
    is_user_logged_in() or die(json_encode(array("error"=>"0","msg"=>"非法操作")));
    $current_user=wp_get_current_user();
    $uid = $current_user->ID;
    $error = '';
    $msg = '';
    $pwd1=$_POST["pwd1"];
    $pwd2=$_POST["pwd2"];
    if($pwd1 == $pwd2 && !empty($pwd1) && !empty($pwd2)){
        wp_set_password( $pwd1, $uid );
        $error = 1;
        $msg = '用户密码修改成功';
    }
    else
    {
        $error = 0;
        $msg = '用户密码修改失败';
    }
    $arr=array("error"=>$error,"msg"=>$msg);
    echo json_encode($arr);

    die();
}

//只允许管理员访问WordPress后台
if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
$current_user = wp_get_current_user();
if($current_user->roles[0] == get_option('default_role')) {
wp_safe_redirect("/user");
exit();
}
}



//访问wp-login.php重定向到指定页面。
function ds_custom_login(){
    global $pagenow;
    if( 'wp-login.php' == $pagenow && $_GET['action']!="logout") {
        wp_redirect(get_field('login_url', 'option'));
        exit();
    }
}

//重定向到指定页面，且不影响重置密码及退出账户
add_action('init', 'ds_redirect_wp_login');
function ds_redirect_wp_login() {
    // WP全局变量
    global $pagenow;
    // 如果设置了$_GET['action']，则加载到$action变量中
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';
    // 判断是否在登录页面，并且不是重置密码
    if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
        // 重定向的网址
        $page = get_field('login_url', 'option');
        // 重定向
        wp_redirect($page);
        // 停止执行
        exit();
    }
}
