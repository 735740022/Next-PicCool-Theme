<div class="col-lg-4">
    <div class="sidebar_sticky">
        <aside class="aside_box mb-4">
            <h3 class="aside_name"><i class="bi bi-app-indicator me-2"></i>社区分类</h3>
            <?php
            $args=array(
            'hide_empty'    => 0,
            'taxonomy'      => 'forums',
            'orderby'       => 'name',
            'order'         => 'ASC'
            );
            $categories=get_categories($args);
            foreach($categories as $category) { ?>
            <div class="aside_list_com">
                <div class="aside_list_name">
                    <?php $logo = get_field('topban', 'category_'.$category->term_id); echo wp_get_attachment_image($logo, array(48, 48, true)); ?>
                    <div class="aside_list_name_l">
                        <a class="" href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name ?>"><?php echo $category->name ?></a>
                        <span><?php echo $category->count ?>篇帖子</span>
                    </div>
                </div>
                <a class="aside_gz" href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo $category->name ?>">查看</a>
            </div>
            <?php } ?>
        </aside>
        <aside class="aside_box mb-5">
            <h3 class="aside_name"><i class="bi bi-chat-right-text me-2"></i>热门讨论</h3>
            <?php
            query_posts( array( 'post_type'=>'forum', 'posts_per_page'=>5, 'orderby'=>'comment_count', ) );
            while( have_posts() ): the_post();
            ?>
            <div class="aside_list_com">
                <div class="aside_list_name">
                    <?php the_post_thumbnail(array(48, 48, true)); ?>
                    <div class="aside_list_name_l">
                        <a class="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        <span><?php post_views('',''); ?>人关注</span>
                    </div>
                </div>
                <a class="aside_gz" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">查看</a>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </aside>
    </div>
</div>