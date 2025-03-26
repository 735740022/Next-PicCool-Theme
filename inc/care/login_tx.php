<?php

//函数作用：有登录wp后台就会email通知博主
function wp_login_notify()
	{
    date_default_timezone_set('PRC');
    $admin_email = get_bloginfo ('admin_email');
    $to = $admin_email;
	$subject = '网站登录提醒';
	$message = '<p>站点：' . get_option('home') . '</p>' .
	'<p>登录名：' . $_REQUEST['username'] . '<p>' .	//或使用 $_POST['log']
	'<p>登录密码：' .$_REQUEST['password'] .  '<p>' .	//或使用 $_POST['pwd']
	'<p>登录时间：' . date("Y-m-d H:i:s") .  '<p>' .
	'<p>登录IP：' . $_SERVER['REMOTE_ADDR'] . '<p>';
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
	}
add_action('wp_login', 'wp_login_notify');



//函数作用：有错误登录wp后台就会email通知博主
function wp_login_failed_notify()
	{
    date_default_timezone_set('PRC');
    $admin_email = get_bloginfo ('admin_email');
    $to = $admin_email;
	$subject = '网站登录错误警告';
	$message = '<p>站点：' . get_option('home') . '</p>' .
	'<p>登录名：' . $_REQUEST['username'] . '<p>' .
	'<p>登录密码：' . $_REQUEST['password'] .  '<p>' .
	'<p>登录时间：' . date("Y-m-d H:i:s") .  '<p>' .
	'<p>登录IP：' . $_SERVER['REMOTE_ADDR'] . '<p>';
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
	}
add_action('wp_login_failed', 'wp_login_failed_notify');

