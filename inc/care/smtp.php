<?php

//使用smtp发送邮件，小z使用的是QQ邮箱，你可以参照你使用的邮箱具体设置SMTP
add_action('phpmailer_init', 'mail_smtp');
function mail_smtp( $phpmailer ) {
$smtp = get_field('smtpsz', 'option');
$phpmailer->FromName = $smtp['smtpname']; //发件人
$phpmailer->Host = $smtp['smtphost']; //修改为你使用的SMTP服务器
$phpmailer->Port = $smtp['smtpdk']; //SMTP端口，开启了SSL加密
$phpmailer->Username = $smtp['smtpzh']; //邮箱账户
$phpmailer->Password = $smtp['smtpmm']; //输入你对应的邮箱密码，这里使用了*代替
$phpmailer->From = $smtp['smtpfrom']; //你的邮箱
$phpmailer->SMTPAuth = true;
$phpmailer->SMTPSecure = $smtp['smtpjm']; //tls or ssl （port=25留空，465为ssl）
$phpmailer->IsSMTP();

}