<?php get_header(); ?>
<section class="topban_img" style="background-image:url(<?php echo get_field('bg_def', 'option'); ?>);">
    <div class="container">
        <div class="topban_box">
            <h1 class="mb-4 pb-3">搜索 [<?php the_search_query(); ?>] 的结果页</h1>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form method="get" class="search_ban" action="<?php bloginfo('url'); ?>">
                        <select name="post_type" class="search-select">
                            <option value="forum">社区</option>
                            <option value="show">素材</option>
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

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="jj_wd_l me-0 me-lg-4">

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
                                        <a class="wd_name_r" href="<?php the_permalink(); ?>">关注</a>
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