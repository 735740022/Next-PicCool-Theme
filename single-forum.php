<?php get_header();?>
<section class="topban_img" style="background-image:url(<?php if (get_field('topban')) { $data = wp_get_attachment_image_src(get_field('topban'), 'full'); echo $data[0]; } else { echo get_field('bg_def', 'option'); } ?>)">
    <div class="container">
        <div class="topban_box">
            <h1><?php $term_info = get_the_terms($post->ID,'forums'); echo $term_info[0]->name; ?></h1>
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

                        <div class="jj_wd_l me-0 me-lg-4">

                            <?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
                            <div class="jj_wd_list mb-5">
                                <div class="wd_list_img">
                                    <?php echo get_avatar( get_the_author_meta('email'),'80');?>
                                </div>
                                <div class="wd_list_right">
                                    <div class="wd_name">
                                        <div class="wd_name_l">
                                            <?php the_author_posts_link(); ?>
                                            <span><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?></span>
                                        </div>
                                    </div>
                                    <div class="wd_fbnr">
                                        <h1><?php the_title(); ?></h1>

                                        <article class="wznrys f14 text-justify">
                                        <?php the_content(); ?>
                                        </article>

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

    						<?php
    						if ( comments_open() || get_comments_number() ) :
    						    comments_template();
    						endif;
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