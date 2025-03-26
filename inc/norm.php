<?php

//自定义后台版权
function remove_footer_admin () {
	echo '本站由 <a href="https://www.nextok.com" target="_blank" style="text-decoration:none">Next Theme</a> 驱动';
	}
add_filter('admin_footer_text', 'remove_footer_admin');


//自定义wp-login.php登录页面
class Huitheme_Custom_Admin_Login{
    private static $instance = null;
    public static function get_instance(){
        if( self::$instance == null ){
            self::$instance = new self();
        }
        return self::$instance;
    }
    function __construct(){
        add_filter( 'login_title', [$this, 'login_title'], 10,2 );
        add_filter( 'login_headerurl', [$this, 'login_headerurl'] );
        add_filter( 'login_headertext', [$this, 'login_headertext'] );
        add_action( 'login_head', [$this, 'login_styles'] );
    }
    // 浏览器标题，默认带有WordPress字样
    function login_title( $login_title, $title ){
        return $title .' - '. get_bloginfo( 'name' );
    }
    // logo的链接，默认链接到WordPress
    function login_headerurl(){
        return site_url();
    }
    // a标签里的文字，logo是a标签的背景
    function login_headertext(){
        return '';
    }
    // 通过css修改页面样式
	function login_styles() {
?>

<style type="text/css">
body.login{background:url(https://api.kdcc.cn/img/rand.php);background-size:cover;background-repeat:no-repeat;background-position:center center;display:flex;align-items:center;justify-content:center;}
#login{background:rgb(255 255 255 / 74%);padding:10px 10px 20px 10px;}
#login h1{display:none!important;}
#login form{border:none;box-shadow:none;background:none;padding-bottom:0px;}
#login form p{margin-bottom:5px;}
#login form p .input{margin-top:5px;}
#login form .forgetmenot{width:100%;}
#login form p.submit{width:100%;margin-top:20px;}
#login form p #wp-submit{width:100%;height:42px;background:#58b3e8;border:none;box-shadow:none;text-shadow:none;}
#login form p.forgetmenot{display:block;padding-bottom:20px;}
#login form .clear{display:none!important;}
#login #nav{}
#login #nav a{margin:0px 10px;}
#login .message{display:none}
#login #login_error,
#login .success{border:none;box-shadow:none;color:#fd1616;font-weight:300;margin-bottom:0px;background:none;padding:30px 30px 0px 30px;}
#reg_passmail{display:none}
.language-switcher{display:none!important;}
@media (max-width:768px){
	body.login{background:#fff;}
	#login{width:100%;padding:30px;margin:0px;}
}
</style>

<?php } } Huitheme_Custom_Admin_Login::get_instance();


//后端CSS控制
function my_admin_theme_style() { ?>
<style>
#wp-admin-bar-wp-logo { display: none !important; }
.form-field td img{width: 200px;}
#wp-admin-bar-my-account .avatar,#wp-admin-bar-user-actions,.user-comment-shortcuts-wrap,.user-rich-editing-wrap,.user-admin-bar-front-wrap,.user-first-name-wrap,.user-last-name-wrap,#wp-admin-bar-new-content,#wp-admin-bar-comments{display: none !important;}
.icl_als_iclflag,#wpml_als_help_link{display: none !important;}
.acf-field select{text-indent:10px;}
.edit-post-meta-boxes-area .postbox{background:#f7f7f7;border-radius:10px;margin:10px 10px 30px 10px;overflow:hidden;}
.edit-post-meta-boxes-area .postbox-header{border-top:none;border-bottom:2px solid #e9e9e9;}
.edit-post-meta-boxes-area #poststuff h2.hndle{padding:15px 25px;font-size:16px;}
.edit-post-meta-boxes-area #poststuff .inside{padding:13px!important;}
.wp-core-ui .acf-settings-wrap .notice.is-dismissible{border:none;padding:0px;margin:0px;box-shadow:none;}
.wp-core-ui .acf-settings-wrap .notice.is-dismissible p{color:#cacaca;margin-right:10px;}
.wp-core-ui .acf-settings-wrap .notice.is-dismissible .notice-dismiss{display:none;}
#sub-accordion-section-ds_setting_index .customize-control{margin-bottom: 50px!important;position: relative;}
#sub-accordion-section-ds_setting_index .customize-control:before{content:"";position:absolute;bottom:-30px;left:-12px;width:calc(100% + 24px);height:2px;background:#dcdcdf;}
</style>
<?php }
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');



//禁止谷歌字体
function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );


//禁止代码标点转换
remove_filter('the_content', 'wptexturize');


// 经典编辑器的增强  ===============可删除===========================
// 增强按钮增强
function enable_more_buttons($buttons) {
$buttons[] = 'del';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'cleanup';
$buttons[] = 'styleselect';
$buttons[] = 'wp_page';
$buttons[] = 'anchor';
$buttons[] = 'backcolor';
$buttons[] = 'copy';
$buttons[] = 'cut';
$buttons[] = 'charmap';
return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");
//字体增加
function custum_fontfamily($initArray){
$initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';";
return $initArray;
}
add_filter('tiny_mce_before_init', 'custum_fontfamily');
// 经典编辑器的增强  ================可删除==========================


//激活友情链接后台
add_filter( 'pre_option_link_manager_enabled', '__return_true' );


//去掉描述P标签
function deletehtml($description) {
$description = trim($description);
$description = strip_tags($description,"");
return ($description);
}
add_filter('category_description', 'deletehtml');


/* 评论作者链接新窗口打开 */
function specs_comment_author_link() {
$url    = get_comment_author_url();
$author = get_comment_author();
if ( empty( $url ) || 'http://' == $url )
return $author;
else
return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');


//文章链接新窗口打开
function autoblank($text) {
	$return = str_replace('<a', '<a target="_blank"', $text);
	return $return;
}
add_filter('the_content', 'autoblank');


/**
* Sitemap xml 禁止 wp-sitemap-users-1.xml
* https://www.huitheme.com/wp-sitemap-users.html
*/
add_filter( 'wp_sitemaps_add_provider', function ($provider, $name) { return ( $name == 'users' ) ? false : $provider; }, 10, 2);


/**
* 禁用wordpress默认的favicon.ico图标
*/
add_action( 'do_faviconico', function() {
//Check for icon with no default value
if ( $icon = get_site_icon_url( 32 ) ) {
//Show the icon
wp_redirect( $icon );
} else {
//Show nothing
header( 'Content-Type: image/vnd.microsoft.icon' );
}
exit;
} );


//修改url重写后的作者存档页的链接变量
add_filter( 'author_link', 'yundanran_author_link', 10, 2 );
function yundanran_author_link( $link, $author_id) {
    global $wp_rewrite;
    $author_id = (int) $author_id;
    $link = $wp_rewrite->get_author_permastruct();
    if ( empty($link) ) {
        $file = home_url( '/' );
        $link = $file . '?author=' . $author_id;
    } else {
        $link = str_replace('%author%', $author_id, $link);
        $link = home_url( user_trailingslashit( $link ) );
    }
    return $link;
}
//此处做的是，在url重写之后，把author_name替换为author
add_filter( 'request', 'yundanran_author_link_request' );
function yundanran_author_link_request( $query_vars ) {
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id=$query_vars['author_name'];
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );
        }
    }
    return $query_vars;
}


//搜索支持分类法
function template_chooser($template)
{
global $wp_query;
$post_type = get_query_var('post_type');
	if( isset($_GET['s'] ) && $post_type == 'show' ) {
	return locate_template('search/search-show.php');
}
else if( isset($_GET['s'] ) && $post_type == 'forum' ) {
	return locate_template('search/search-forum.php');
}
	return $template;
}
add_filter('template_include', 'template_chooser');


//后台文章列表显示缩略图 以辨识文章
if (function_exists( 'add_theme_support' )){
    add_filter('manage_posts_columns', 'my_add_posts_columns', 5);
    add_action('manage_posts_custom_column', 'my_custom_posts_columns', 5, 2);
}
function my_add_posts_columns($defaults){
   $defaults['my_post_thumbs'] = '特色图像';
    return $defaults;
}
function my_custom_posts_columns($column_name, $id){
    if($column_name === 'my_post_thumbs'){
        echo the_post_thumbnail( array(80,50) );
    }
}




//theme_options
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/meta/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/meta/' );
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}
define( 'ACF_LITE', true );
require get_template_directory(). '/inc/meta/acf.php';
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
if( current_user_can( 'manage_options' ) ) {
if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' 	=> '主题选项',
		'menu_title' 	=> '主题选项',
		'menu_slug' 	=> 'theme-settings',
		'capability' 	=> 'edit_posts',
		'icon_url' => 'dashicons-cloud',
		'redirect' 	=> false
	));
	//add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'SEO设置',
		'menu_title' 	=> 'SEO设置',
		'menu_slug' 	=> 'seo-settings',
		'parent_slug' 	=> $option_page['menu_slug'],
	));
	//add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> '优化清理',
		'menu_title' 	=> '优化清理',
		'menu_slug' 	=> 'clear-settings',
		'parent_slug' 	=> $option_page['menu_slug'],
	));
}
}
}

if ( get_field( 'ybpql', 'option', true ) ) : include_once get_template_directory() .'/inc/care/ybpql.php'; endif;
if ( get_field( 'nocg', 'option', true ) ) : include_once get_template_directory() .'/inc/care/no_category.php'; endif;
if ( get_field( 'nofeed', 'option', true ) ) : include_once get_template_directory() .'/inc/care/nofeed.php'; endif;
if ( get_field( 'pingback', 'option', true ) ) : include_once get_template_directory() .'/inc/care/pingback.php'; endif;
if ( get_field( 'picalt', 'option', true ) ) : include_once get_template_directory() .'/inc/care/picalt.php'; endif;
if ( get_field( 'nofollow', 'option', true ) ) : include_once get_template_directory() .'/inc/care/nofollow.php'; endif;
if ( get_field( 'cnpic', 'option', true ) ) : include_once get_template_directory() .'/inc/care/cnpic.php'; endif;
if ( get_field( 'smtp', 'option', true ) ) : include_once get_template_directory() .'/inc/care/smtp.php'; endif;
if ( get_field( 'topbar', 'option', true ) ) : include_once get_template_directory() .'/inc/care/topbar.php'; endif;
if ( get_field( 'remove_block', 'option', true ) ) : include_once get_template_directory() .'/inc/care/remove_block.php'; endif;
if ( get_field( 'login_tx', 'option', true ) ) : include_once get_template_directory() .'/inc/care/login_tx.php'; endif;

include_once get_template_directory() .'/inc/care/wpbs.php';    //优化去除所有wp的标识
require get_template_directory(). '/inc/care/login_reg.php'; 	//注册优化
require get_template_directory(). '/inc/thumbnails.php'; 		//静默运行，缩略图裁剪