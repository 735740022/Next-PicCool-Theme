<?php get_header(); ?>

<section class="topban_img" style="background-image:url(<?php echo get_field('bg_def', 'option'); ?>);">
    <div class="container">
        <div class="topban_box">
            <h1 class="mb-4 pb-3">搜索 [<?php the_search_query(); ?>] 的结果页</h1>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form method="get" class="search-form" action="<?php bloginfo('url'); ?>">
                        <select name="post_type" class="search-select">
                            <option value="post">文章</option>
                            <option value="show">素材</option>
                            <option value="forum">社区</option>
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
    <div id="waterfall-container">
        <?php $i=1; while( have_posts() ): the_post(); ?>
        <div class="pin">
            <div class="content_loop" >
                <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail(array(400, true)); ?>
                </a>
                <div class="content_loop_foot">
                    <h2 class=""><a class="" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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


<script src="<?php bloginfo('template_directory'); ?>/assets/js/bootstrap-waterfall.js"></script>
<script>
$(document).ready(function () {
  $('#waterfall-container').waterfall();
});
</script>

<?php get_footer(); ?>