<?php
$cat_fild = get_queried_object();
$term_id = $cat_fild->term_id;
//不准删除
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

<script src="<?php bloginfo('template_directory'); ?>/assets/masonry/masonry.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/masonry/imagesloaded.js"></script>
<script>
$(function(){
    var $container = $('.pubuliu');
    $container.imagesLoaded(function(){
        $container.masonry({
            itemSelector: '.col'
        });
    });
});
</script>


<section class="content_loop_show">
<div class="container">
    <div class="pubuliu row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-4">
        <?php $i=1; while( have_posts() ): the_post(); ?>
        <div class="col">
            <div class="content_loop" >
                <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail(array(400, true)); ?>
                </a>
                <div class="content_loop_foot">
                    <h2 class=""><a class="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    <div class="content_loop_description">
                        <?php echo wp_trim_words( get_the_content(), 150 ); ?>
                    </div>
                    <div class="content_loop_info_info">
                        <span><i class="bi bi-chat-text"></i><?php comments_popup_link ('0','1','%'); ?></span>
                        <span class="sjbxs"><i class="bi bi-clock"></i><?php the_time('Y.m.d'); ?> </span>
                        <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++; endwhile; ?>
    </div>

    <div class="posts-nav clearfix mt-5">
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
</section>

</main>


<?php get_footer(); ?>