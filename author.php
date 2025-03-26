<?php

$part_action = (isset($_GET['action'])) ? strtolower($_GET['action']) : '' ;

global $wp_query;

$curauth = $wp_query->get_queried_object();

get_header();?>

<section class="userban">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="user_top">
                    <div class="row align-items-sm-center">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-2">
                            <div class="user_top_avatar"><?php echo get_avatar( $curauth->user_email, 150); ?></div>
                        </div>
                        <div class="col-9 col-sm-9 col-md-9 col-lg-10">
                            <div class="user_top_info">
                                <h1><?php echo $curauth->nickname;?></h1>
                                <p><?php echo $curauth->description;?></p>
                                <a href="<?php the_permalink(); ?>?action=vip" class="user_top_icon yes"><i class="bi bi-gem"></i><?php echo get_field( 'user_diy_type', 'user_'.$curauth->ID); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</header>

<section class="user_foot_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="user_menu">
                    <a class="<?php if ( $part_action == 'article' ) { echo 'current'; } ?>" href="<?php bloginfo('url'); ?>/author/<?php echo $curauth->ID ?>?action=article">文章</a>
                    <a class="<?php if ( $part_action == 'shows' ) { echo 'current'; } ?>" href="<?php bloginfo('url'); ?>/author/<?php echo $curauth->ID ?>?action=shows">素材</a>
                    <a class="<?php if ( $part_action == 'forums' ) { echo 'current'; } ?>" href="<?php bloginfo('url'); ?>/author/<?php echo $curauth->ID ?>?action=forums">社区</a>
                </div>
                <?php
                if ($part_action == 'article'){
                    require get_template_directory(). '/pages/author/article.php';
                }
                elseif ($part_action == 'shows'){
                    require get_template_directory(). '/pages/author/shows.php';
                }
                elseif ($part_action == 'forums'){
                    require get_template_directory(). '/pages/author/forums.php';
                }
                else{
                    require get_template_directory(). '/pages/author/article.php';
                }
                ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>