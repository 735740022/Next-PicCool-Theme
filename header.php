<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<meta name="format-detection" content="address=no">
<meta name="format-detection" content="date=no">
<?php include('inc/seo.php' ); ?>
<?php wp_head(); ?>
<?php the_field('header_diy', 'option'); ?>
</head>
<body <?php body_class(); ?> >
<header class="header">
<section class="top">
    <div class="container">
    	<div class="top_flex">
			<div class="top_logo">
				<a class="logo" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php the_field('logo', 'option'); ?>" alt="">
				</a>
			    <?php
			        wp_nav_menu( array(
			            'theme_location'  => 'main',
			            'container'       => 'nav',
			            'container_class' => 'header-menu',
			            'container_id'    => '',
			            'menu_class'      => 'header-menu-ul',
			            'menu_id'         => '',
			        )
			     );
			    ?>
			</div>
			<div class="top_righr">
				<button class="top_righr_a" type="button" data-bs-toggle="offcanvas" data-bs-target="#c_sousuo"><i class="bi bi-search"></i></button>

                <?php if (is_user_logged_in()) { $current_user = wp_get_current_user(); ?>

                <div class="top_login_avatar">

                    <button type="button" class="top_login_avatar_pic" data-bs-toggle="dropdown"><?php echo get_avatar( $current_user->user_email, 40); ?></button>

                    <div class="dropdown-menu dropdown-menu-end shadow-sm top_login_avatar_dropdown">

                        <div class="top_login_avatar_head">
                            <?php echo get_avatar( $current_user->user_email, 60); ?>
                            <div class="top_login_avatar_head_right">
                                <h6><a href="<?php bloginfo('url'); ?>/author/<?php echo $current_user->ID ?>"><?php echo $current_user->nickname;?></a></h6>
                            </div>
                        </div>

                        <div class="top_login_avatar_menu">
                            <?php if( current_user_can( 'manage_options' ) ) { ?>
                            <a class="" href="<?php echo admin_url(); ?>"><i class="bi bi-terminal-plus"></i>管理后台</a>
                            <?php } ?>
                            <a class="" href="<?php bloginfo('url'); ?>/user"><i class="bi bi-person-video3"></i>用户中心</a>
                            <a class="" href="<?php echo wp_logout_url( home_url() ); ?>"><i class="bi bi-power"></i>退出登陆</a>
                        </div>
                    </div>

                </div>

                <?php } else { ?>
                    <a class="top_righr_a" href="<?php bloginfo('url'); ?>/login"><i class="fa fa-user"></i>登录</a>
                    <a class="top_righr_a" href="<?php bloginfo('url'); ?>/reg"><i class="fa fa-sign-in"></i>注册</a>
                <?php } ?>

			</div>
		</div>
    </div>
</section>


<div class="offcanvas offcanvas-top" id="c_sousuo">
    <button type="button" class="search_close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 search_box">
                <form action="/" class="ss_a clearfix" method="get">
                	<select name="post_type" class="search-select">
                        <option value="show">素材</option>
                        <option value="forum">社区</option>
                        <option value="post"> 文章</option>
                    </select>
                    <input name="s" aria-label="关键词" type="text" onblur="if(this.value=='')this.value='关键词'" onfocus="if(this.value=='关键词')this.value=''" value="关键词">
                    <button type="submit" title="搜索">搜索</button>
                </form>
            </div>
        </div>
    </div>
</div>