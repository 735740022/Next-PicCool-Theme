<?php
/*
* Template Name: 找回密码
*/

global $wpdb;
$error = '';
$success = '';
if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ) {
    $email = esc_sql(trim($_POST['email']));
    if( empty( $email ) ) {
        $error = '请输入邮箱地址';
    } else if( ! is_email( $email )) {
        $error = '邮箱地址无效';
    } else if( ! email_exists( $email ) ) {
        $error = '邮箱地址有误';
    } else {
        $random_password = wp_generate_password( 12, false );
        $user = get_user_by( 'email', $email );
        $update_user = wp_update_user( array (
                'ID' => $user->ID,
                'user_pass' => $random_password
            )
        );
        if( $update_user ) {
            $to = $email;
            $subject = '您的新密码';
            $sender = get_option('name');
            $message = '您的新密码: '.$random_password;
            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
            $mail = wp_mail( $to, $subject, $message, $headers );
            if( $mail )
                $success = '新的密码已发送至您的邮箱';
        } else {
            $error = '哎呀，你的账户似乎出现了问题';
        }
    }
}

get_header()
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
                        <h3>找回密码</h3>
                        <p>请输入您的电子邮件以自动获取新的密码</p>
                    </div>

				    <form method="post" class="ds_login_form">

						<label for="email">电子邮箱</label>
						<input type="text" name="email" id="email"  value="" />

                        <?php
                            if ( ! empty( $error ) )
                            echo '<div class="text-danger text-center f300">'. $error .'</div>';
                            if( ! empty( $success ) )
                            echo '<div class="text-success text-center f300">'. $success .'</div>';
                        ?>

				        <input type="hidden" name="action" value="reset" />
				        <input type="submit" value="找回密码" class="ds_submit" id="submit" />
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


<?php get_footer() ?>