<?php

function add_settings_menu() {
    add_menu_page('订单管理', '订单管理', 'administrator', 'order_admin_page', 'order_admin_page', 'dashicons-cart', '81');
        add_submenu_page('order_admin_page', '会员购买', '会员购买', 'administrator', 'order_vip_buy', 'order_vip_buy');
        add_submenu_page('order_admin_page', '充值记录', '充值记录', 'administrator', 'order_charge', 'order_charge');
}
add_action('admin_menu', 'add_settings_menu');

function order_admin_page() {
    require_once get_template_directory() . '/inc/order/order_list.php';
}

function order_vip_buy() {
    require_once get_template_directory() . '/inc/order/order_vip_buy.php';
}

function order_charge() {
    require_once get_template_directory() . '/inc/order/order_charge.php';
}