<?php

//加载css及js
function dsjs_add_scripts(){
wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
wp_enqueue_style( 'bootstrap' );
wp_register_style( 'owlcss', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );
wp_enqueue_style( 'owlcss' );
wp_register_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );
wp_enqueue_style( 'animate' );
wp_register_style( 'bifont', get_template_directory_uri() . '/assets/bifont/bootstrap-icons.css' );
wp_enqueue_style( 'bifont' );
wp_register_style( 'stylecss', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'stylecss' );
wp_register_script( 'jquerymin', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '', false ); //false就在页头显示
wp_enqueue_script( 'jquerymin' );

wp_deregister_script( 'jquery' );

wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '', true );
wp_enqueue_script( 'bootstrap' );
wp_register_script( 'owljs', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '', true );
wp_enqueue_script( 'owljs' );
wp_register_script( 'dsjs', get_template_directory_uri() . '/assets/js/js.js', array(), '', true );
wp_enqueue_script( 'dsjs' );
}
add_action('wp_enqueue_scripts', 'dsjs_add_scripts');

require get_template_directory(). '/inc/norm.php';

require get_template_directory(). '/inc/comment/main.php';	//评论核心

require get_template_directory(). '/inc/type/show.php';//自定义分类法show

require get_template_directory(). '/inc/type/forum.php';//自定义分类法forum

require get_template_directory(). '/inc/query_show.php'; //素材筛选核心

require get_template_directory(). '/inc/query_field.php'; //素材筛选字段

require get_template_directory(). '/pages/user/inc/setup-functions.php'; //用户中心 - 资料


//注册导航
register_nav_menus(
	array(
	'main'	=> __( '主菜单导航' ),
	'mob' 	=> __( '手机导航' ),
	'foot1'	=> __( '底部菜单1' ),
	'foot2'	=> __( '底部菜单2' ),
	'foot3'	=> __( '底部菜单3' ),
	'foot4'	=> __( '底部菜单4' ),
	'hot_s'	=> __( '热门搜索' ),
	)
);


/* 访问计数 */
function record_visitors()
{if (is_singular()) { global $post;$post_ID = $post->ID;if($post_ID) { $post_views = (int)get_post_meta($post_ID, 'views', true);if(!update_post_meta($post_ID, 'views', ($post_views+1))) { add_post_meta($post_ID, 'views', 1, true);}}}}
add_action('wp_head', 'record_visitors');
/// 函数名称：post_views
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
global $post;
$post_ID = $post->ID;
$views = (int)get_post_meta($post_ID, 'views', true);
if ($echo) echo $before, number_format($views), $after;
else return $views;
}


//面包屑 https://v4.bootcss.com/docs/components/breadcrumb/  by 2大叔
function get_breadcrumbs()
{
global $wp_query;
//首页
if ( !is_home() || is_front_page() ) {
echo '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
echo '<li class="breadcrumb-item breadcrumb-home"><a href="'.get_option('home').'">首页</a></li>';
//分类
if ( is_category() ) {
$catTitle = single_cat_title('',false);
$cat = get_cat_ID( $catTitle );
echo '<li class="breadcrumb-item">'.get_category_parents($cat,true,'<em>/</em>').'</li>';
}
//tag
elseif ( is_tag() ) {
echo '<li class="breadcrumb-item active" aria-current="page">'.single_tag_title('',false).'</li>';
}
//作者
elseif ( is_author() ) {
global $author;
$userdata = get_userdata($author);
echo '<li class="breadcrumb-item active111" aria-current="page">'.$userdata->display_name.'</li>';
}
//搜索
elseif ( is_search() ) {
echo '<li class="breadcrumb-item active" aria-current="page">搜索词 [ '.get_search_query().' ] 的结果页</li>';
}
//404
elseif ( is_404() ) {
echo '<li class="breadcrumb-item active" aria-current="page">404 Not Found</li>';
}
//taxonomy
elseif ( is_tax() ) {
echo '<li class="breadcrumb-item active" aria-current="page">'.single_tag_title('',false).'</li>';
}
//文章
elseif ( is_single() ) {
$category = get_the_category();
$category_id = get_cat_ID( $category[0]->cat_name );
echo '<li class="breadcrumb-item"> '.get_category_parents($category_id,true,'<em>/</em>').' </li>';
echo '<li class="breadcrumb-item active" aria-current="page">'.the_title('','',false).'</li>';
}
//页面
elseif ( is_page() ) {
echo '<li class="breadcrumb-item active" aria-current="page">'.the_title('','',false).'</li>';
}
echo "</ol></nav>";
} //end home
} //get_breadcrumbs





//gravatar国内加速
function replace_gravatar($avatar) {
$avatar = str_replace(array("//gravatar.com/", "//secure.gravatar.com/", "//www.gravatar.com/", "//0.gravatar.com/",
"//1.gravatar.com/", "//2.gravatar.com/", "//cn.gravatar.com/"), "//gravatar.loli.net/", $avatar);
return $avatar;}
add_filter( 'get_avatar', 'replace_gravatar' );


//赞
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'specs_zan',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('specs_zan_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        }
        else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id,'specs_zan',true);
    }
    die;
}

//支持svg
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );