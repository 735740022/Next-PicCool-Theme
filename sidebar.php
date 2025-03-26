<div class="col-lg-4">
    <div class="sidebar_sticky">
        <aside class="aside_box mb-4">
        	<h3 class="aside_name"><i class="bi bi-cup-hot me-2"></i>热门作品</h3>
        	<div class="aside_list">
        		<?php
                global $post;
                $cats = wp_get_post_categories($post->ID);
                if ($cats) {
                $args = array(
                'category__in' => array( $cats[0] ),
                'post__not_in' => array( $post->ID ),
                'showposts' => 6,
                'ignore_sticky_posts' => 1
                );
                query_posts($args);
                if (have_posts()) {
                while (have_posts()) {
                the_post(); update_post_caches($posts); ?>
                <div class="row align-items-center position-relative mb-4 g-3">
                    <div class="col-3">
                    	<?php the_post_thumbnail(array(300, 200, true)); ?>
                    </div>
                    <div class="col-9">
                    	<h2><a class="stretched-link" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    	<div class="content_loop_info_info">
                            <span><i class="bi bi-chat-text"></i><?php echo get_post($post->ID)->comment_count; ?></span>
                            <span class="sjbxs"><i class="bi bi-clock"></i><?php the_time('Y.m.d'); ?> </span>
                            <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                        </div>
                    </div>
                </div>
        		<?php } } else { echo ''; } wp_reset_query(); } else { echo ''; } ?>
        	</div>
        </aside>
        <aside class="aside_box mb-4">
            <h3 class="aside_name"><i class="bi bi-chat-right-text me-2"></i>最新评论</h3>
            <ul class="sidebar_comments">
            <?php
            $comments = get_comments('post_type=post&number=6&order=DESC');
            foreach($comments as $comment) : ?>
                <li class="">
                    <?php echo get_avatar( $comment->comment_author_email, 30); ?>
                    <a class="text-secondary" href="<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>">
                        <small><?php echo get_comment_author(); ?>:</small>
                        <span><?php echo wp_trim_words( $comment->comment_content , 30 ); ?></span>
                        <p><?php echo $comment->comment_date ?></p>
                    </a>
                </li>
            <?php endforeach;?>
            </ul>
        </aside>
        <aside class="aside_box mb-5">
            <h3 class="aside_name"><i class="bi bi-broadcast me-2"></i>活跃用户</h3>
            <div class="row row-cols-3 row-cols-sm-4 row-cols-md-4 mb-3 g-3">
            <?php
            $args = array(
            'orderby'   => 'post_count',
            'order'     => 'DESC',
            'number'    => '9',
            );
            $user_query = new WP_User_Query( $args );
            if ( ! empty( $user_query->results ) ) {
            foreach ( $user_query->results as $user ) { ?>
                <div class="col">
                    <a class="sidebar_author mb-3 d-block text-center" href="<?php echo get_author_posts_url($user->ID); ?>">
                        <?php echo get_avatar( $user->user_email,44,null,$user->display_name); ?>
                        <p class="f12 text-secondary f300 mb-0 mt-2"><?php echo $user->display_name; ?></p>
                    </a>
                </div>
            <?php } } ?>
            </div>
        </aside>
    </div>
</div>