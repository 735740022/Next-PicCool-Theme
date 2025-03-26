<?php

//自定义分类法之素材
function show_custom_product(){
    $labels = array(
        'menu_name'             => '素材',
        'name'                  => '素材',
        'singular_name'         => '素材',
        'add_new'               => '添加素材',
        'add_new_item'          => '添加素材',
        'edit_item'             => '编辑素材',
        'new_item'              => '新素材',
        'all_items'             => '所有素材',
        'view_item'             => '查看素材',
        'search_items'          => '搜索素材',
        'not_found'             => '无素材',
        'not_found_in_trash'    => '无素材',
    );
    $args = array(
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_rest'          => true,    //支持古腾堡
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => true,
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-buddicons-groups',
        'supports'              => array( 'title', 'editor', 'author', 'excerpt', 'comments', 'thumbnail', 'revisions', 'custom-fields' )
    );
    register_post_type('show',$args);
}
add_action('init', 'show_custom_product');


//分类法支持独立标签
function ds_show_taxonomy() {
    $labels = array(
        'menu_name'         => '素材标签',
        'name'              => '素材标签',
        'singular_name'     => '素材标签',
        'add_new_item'      => '新建标签',
        'parent_item'       => null,    //无父级
        'parent_item_colon' => null,    //无父级
        'all_items'         => '所有标签',
        'search_items'      => '搜素标签',
        'edit_item'         => '编辑标签',
        'update_item'       => '更新标签',
        'new_item_name'     => '新标签名',
    );
    register_taxonomy('show_tag','show',array(
        'hierarchical'              => false,
        'labels'                    => $labels,
        'show_ui'                   => true,
        'show_in_rest'              => true,
        'show_admin_column'         => true,
        'query_var'                 => true,
        'rewrite'                   => array( 'slug'  => 'show_tag' ),
        ));
    }
add_action( 'init', 'ds_show_taxonomy', 0 );


//分类法支持独立分类
function ds_show_taxonomies() {
    $labels = array(
        'menu_name'         => '素材分类',
        'name'              => '素材分类',
        'singular_name'     => '素材分类',
        'add_new_item'      => '新建分类',
        'parent_item'       => '父级',
        'parent_item_colon' => '父级',
        'all_items'         => '全部分类',
        'search_items'      => '搜索分类',
        'edit_item'         => '编辑分类',
        'update_item'       => '更新分类',
        'new_item_name'     => '新分类名',
    );
    $args = array(
        'hierarchical'      => true,    //设置true作为分类是用，设置false则作为标签使用
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,    //古腾堡显示分类
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'shows' ),   //类url
    );
    register_taxonomy( 'shows', array( 'show' ), $args );
}

add_action( 'init', 'ds_show_taxonomies', 0 );


//产品文章url重写
function custom_show_link( $link, $post = 0 ){
    if ( $post->post_type == 'show' ){
        return home_url( 'show/' . $post->ID .'.html' );
    } else {
        return $link;
    }
}
add_filter('post_type_link', 'custom_show_link', 1, 3);

function rewrites_show(){
    add_rewrite_rule(
        'show/([0-9]+)?.html$',
        'index.php?post_type=show&p=$matches[1]',
        'top' );
    add_rewrite_rule(
        'show/([0-9]+)?.html/comment-page-([0-9]{1,})$',
        'index.php?post_type=show&p=$matches[1]&cpage=$matches[2]',
        'top'
        );
    }
add_action( 'init', 'rewrites_show' );

