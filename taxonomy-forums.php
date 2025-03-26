<?php
$cat_fild = get_queried_object();
$term_id = $cat_fild->term_id;
get_header(); ?>



<section class="topban_img" style="background-image:url(<?php if ( get_field('topban', $cat_fild) ) { $data = wp_get_attachment_image_src( get_field('topban', $cat_fild ), 'full' ); echo $data[0]; } else { echo get_field('bg_def', 'option'); } ?>);">
    <div class="container">
        <div class="topban_box">
            <h1><?php single_cat_title(); ?></h1>
            <h2><?php echo category_description();?></h2>
        </div>
    </div>
</section>

</header>

<main>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="jj_wd_l me-0 me-lg-4 mb-5">

                            <?php while( have_posts() ): the_post(); ?>
                            <div class="jj_wd_list mb-4">
                                <div class="wd_list_img">
                                    <?php echo get_avatar( get_the_author_meta('email'),'80');?>
                                </div>
                                <div class="wd_list_right">
                                    <div class="wd_name">
                                        <div class="wd_name_l">
                                            <?php the_author_posts_link(); ?>
                                            <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?></span>
                                        </div>
                                        <a class="wd_name_r" href="<?php the_permalink(); ?>">查看</a>
                                    </div>
                                    <div class="wd_fbnr">
                                        <a class="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                    </div>
                                    <div class="wd_biaoqian">
                                        <?php the_terms( $post->ID, 'forum_tag', '#', '#' ); ?>
                                    </div>
                                    <div class="wd_icon_list">
                                        <span><i class="bi bi-chat-text"></i><?php echo get_post($post->ID)->comment_count; ?></span>
                                        <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                                        <span class="post-like">
                                            <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="dianzan specsZan <?php if(isset($_COOKIE['specs_zan_'.$post->ID])) echo 'done';?>">
                                                <i class="bi bi-hand-thumbs-up"></i><small class="count"><?php if( get_post_meta($post->ID,'specs_zan',true) ){echo get_post_meta($post->ID,'specs_zan',true);} else {echo '0';}?></small>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>

                        <div class="posts-nav clearfix">
                        <?php echo paginate_links(array(
                            'prev_next' => 1,
                            'before_page_number' => '',
                            'mid_size' => 4,
                            'prev_text' => __('<'),
                            'next_text' => __('>'),
                        ));
                        ?>
                        </div>

                    </div>

                    <?php get_sidebar('forum') ?>

                </div>
            </div>
        </div>
    </div>
</section>

</main>


<?php get_footer(); ?>