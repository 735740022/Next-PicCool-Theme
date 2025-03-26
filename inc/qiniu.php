<?php
//静态文件CDN加速
if ( !is_admin() ) {
add_action('wp_loaded','yuncai_ob_start');
function yuncai_ob_start() {
ob_start('yuncai_qiniu_cdn_replace');
}
function yuncai_qiniu_cdn_replace($html){
$local_host = '';//博客域名
$qiniu_host = '';//CDN域名
$cdn_exts = 'png|jpg|jpeg|gif|ico';//扩展名（使用|分隔）
$cdn_dirs = 'wp-content|wp-includes';//目录（使用|分隔）
$cdn_dirs = str_replace('-', '\-', $cdn_dirs);
if ($cdn_dirs) {
$regex = '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
$html = preg_replace($regex, $qiniu_host . '/$1$4', $html);
} else {
$regex = '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
$html = preg_replace($regex, $qiniu_host . '/$1$3', $html);
}
return $html;
}
}