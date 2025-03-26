<?php
//WordPress 5.0 古腾堡默认样式
add_action( 'wp_enqueue_scripts', 'fanly_remove_block_library_css', 100 );
function fanly_remove_block_library_css() {
    wp_dequeue_style( 'wp-block-library' );
}

add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false');