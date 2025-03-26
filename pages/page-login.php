<?php
/*
Template Name: 账号登陆
*/

global $wpdb,$user_ID;

if (!$user_ID) {

if($_POST){
    $username = esc_sql($_REQUEST['username']);
    $password = esc_sql($_REQUEST['password']);
    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $user_verify = wp_signon( $login_data, false );
    if ( is_wp_error($user_verify) ) {
        echo "<span class='error'>用户名或密码有误，请重试!</span>";
        exit();
    } else {
        echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."/user'</script>"; //进入用户中心
        exit();
    }
} else {

get_header();

?>

<style>
	.top{display: none;}
	.footer{display: none;}
</style>


<section class="login_bg account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="login_box">
                    <div class="login_header">
                        <img src="<?php the_field('logo', 'option'); ?>" alt="">
                    </div>
                    <div class="login_describe">
                        <h3>账号登陆</h3>
                        <p>输入您的电子邮件地址和密码以访问管理面板</p>
                    </div>

                    <form id="wp_login_form" class="ds_login_form" action="" method="post">
                        <label>用户名/邮箱</label>
                        <input type="text" name="username" placeholder="输入你的电子邮箱" value="">
                        <label>密码</label>
                        <input type="password" name="password" placeholder="输入您的密码" value="">
                        <div id="result"></div>
                        <input type="submit" id="submitbtn" class="ds_submit" name="submit" value="账号登陆">
                    </form>

                </div>

                <div class="mt-4">
                    <div class="text-center login_nav">
                        <p><a href="<?php bloginfo('url'); ?>/reg">注册账户</a> / <a href="<?php bloginfo('url'); ?>/lostpw">找回密码</a> / <a href="<?php bloginfo('url'); ?>">返回首页</a></p>
                    </div>
                </div>

            </div>
        </div>

        <script type="text/javascript">
            $("#submitbtn").click(function() {
                $('#result').html('<div class="spinner-grow text-primary loader" role="status"><span class="visually-hidden">Loading...</span></div>').fadeIn();
                var input_data = $('#wp_login_form').serialize();
                $.ajax({
                    type: "POST",
                    url:  window.location.href,//"<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
                    data: input_data,
                    success: function(msg){
                        $('.loader').remove();
                        $('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');
                    }
                });
                return false;
            });
        </script>

    </div>
</section>

<footer class="login_foot"><i class="bi bi-c-circle me-2"></i><?php bloginfo('name'); ?></footer>



<?php
get_footer(); //载入底部文件
}
}else {
    echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";  //没有登陆访问该页面则回到首页
}
?>