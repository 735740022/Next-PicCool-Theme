<?php
/*
Template Name: 注册页面
*/

if( !empty($_POST['ludou_reg']) ) {
    $error = '';
    $sanitized_user_login = sanitize_user( $_POST['user_login'] );
    $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

    // Check the username
    if ( $sanitized_user_login == '' ) {
        $error .= '<strong>错误</strong>：请输入用户名。<br />';
    } elseif ( ! validate_username( $sanitized_user_login ) ) {
        $error .= '<strong>错误</strong>：此用户名包含无效字符,请输入有效的用户名.<br />';
        $sanitized_user_login = '';
    } elseif ( username_exists( $sanitized_user_login ) ) {
        $error .= '<strong>错误</strong>：该用户名已被注册,请再选择一个.<br />';
    }

    // Check the e-mail address
    if ( $user_email == '' ) {
        $error .= '<strong>错误</strong>：请填写电子邮件地址.<br />';
    } elseif ( ! is_email( $user_email ) ) {
        $error .= '<strong>错误</strong>：电子邮件地址不正确!<br />';
        $user_email = '';
    } elseif ( email_exists( $user_email ) ) {
        $error .= '<strong>错误</strong>：该电子邮件地址已经被注册,请换一个.<br />';
    }

    // Check the password
    if(strlen($_POST['user_pass']) < 6)
    $error .= '<strong>错误</strong>：密码长度至少6位!<br />';
    elseif($_POST['user_pass'] != $_POST['user_pass2'])
    $error .= '<strong>错误</strong>：两次输入的密码必须一致!<br />';

    if($error == '') {
        $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );

        if ( ! $user_id ) {
          $error .= sprintf( '<strong>错误</strong>：无法完成您的注册请求... 请联系<a href="mailto:%s">管理员</a>！<br />', get_option( 'admin_email' ) );
        }
        else if (!is_user_logged_in()) {
            $user = get_user_by( 'login', $sanitized_user_login );
            $user_id = $user->ID;
            // 自动登录
            wp_set_current_user($user_id, $user_login);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $user_login);
            wp_redirect( home_url() ); exit;	//登陆进首页
        }
    }
}

get_header();

?>

<?php the_content(); ?>

<?php if (!is_user_logged_in()) { ?>

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
                        <h3>注册账号</h3>
                        <p>请输入账号及密码并妥善保管</p>
                    </div>

                    <form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="ds_login_form">

                    	<label for="user_login">用户名(至少5位)</label>
                    	<input type="text" name="user_login" tabindex="1" id="user_login" placeholder="输入您的用户名" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" />


                    	<label for="user_email">电子邮件</label>
                    	<input type="text" name="user_email" tabindex="2" id="user_email" placeholder="输入您的电子邮件" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="25" />


                    	<label for="user_pwd1">密码(至少6位)</label>
                    	<input id="user_pwd1" class="input" tabindex="3" type="password" placeholder="输入您的密码" tabindex="21" size="25" value="" name="user_pass" />


                    	<label for="user_pwd2">重复密码</label>
                    	<input id="user_pwd2" class="input" tabindex="4" type="password" placeholder="请再次确认您的密码" tabindex="21" size="25" value="" name="user_pass2" />


                    	<input type="hidden" name="ludou_reg" value="ok" />

                    	<?php  if(!empty($error)) { echo '<p class="reg_error">'.$error.'</p>'; } ?>

                    	<input type="submit" class="ds_submit" name="submit" value="账号注册">

                    </form>

                </div>

				<div class="mt-4">
                    <div class="text-center login_nav">
                        <p><a href="<?php bloginfo('url'); ?>/login">登陆</a> / <a href="<?php bloginfo('url'); ?>">返回首页</a></p>
                    </div>
                </div>


            </div>
        </div>

    </div>
</section>

<footer class="login_foot"><i class="bi bi-c-circle me-2"></i><?php bloginfo('name'); ?></footer>

<?php }

else { echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";  }

?>


<?php get_footer(); ?>