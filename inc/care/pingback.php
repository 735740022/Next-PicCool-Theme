<?php
//关闭 pingback
function deel_setup(){
//阻止站内PingBack
    if( dopt('d_pingback_b') ){
        add_action('pre_ping','deel_noself_ping');
    }
}

/**
 * WordPress 关闭 XML-RPC 的 pingback 端口
 */
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}
