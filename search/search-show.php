<?php get_header(); ?>

<section class="topban_img" style="background-image:url(<?php echo get_field('bg_def', 'option'); ?>);">
    <div class="container">
        <div class="topban_box">
            <h1 class="mb-4 pb-3">搜索 [<?php the_search_query(); ?>] 的结果页</h1>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form method="get" class="search_ban" action="<?php bloginfo('url'); ?>">
                        <select name="post_type" class="search-select">
                            <option value="show">素材</option>
                            <option value="forum">社区</option>
                            <option value="post">文章</option>
                        </select>
                        <input type="text" name="s" class="search-input" autocomplete="off" placeholder="输入关键词">
                        <button class="btn-search">搜索</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</header>

<main>

<section class="content_loop_show">
    <div class="container">
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-5 row-cols-lg-5 g-4">
            <?php while( have_posts() ): the_post(); ?>
                <div class="col">
                    <div class="content_loop">
                        <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>" target="_blank">
                            <?php if ( has_post_format( 'video' )) {  ?>
                                <video width="100%" muted="muted" onMouseOver="this.play()" onMouseOut="this.pause()" controlslist="nodownload nofullscreen noremoteplayback disablePictureInPicture noplaybackrate" controls>
                                    <source src="<?php the_field('video'); ?>" type="video/mp4">
                                </video>
                            <?php } else{ //标准 ?>
                                <?php the_post_thumbnail(array(400, 300, true)); ?>
                            <?php } ?>
                        </a>
                        <div class="content_loop_foot">
                            <h2 class=""><a class="" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                            <div class="content_loop_info_cat">
                                <span><i class="bi bi-card-text me-1"></i><?php the_terms( $post->ID, 'shows', '', '' ); ?></span>
                                <span class="sjbxs"><?php the_terms( $post->ID, 'show_tag', '#', '#' ); ?></span>
                            </div>
                            <div class="content_loop_info_info">
                                <span><i class="bi bi-chat-text"></i><?php echo get_post($post->ID)->comment_count; ?></span>
                                <span class="sjbxs"><i class="bi bi-clock"></i><?php the_time('Y.m.d'); ?> </span>
                                <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                            </div>
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
</section>

</main>


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



<?php get_footer(); ?>