<div class="col-lg-4">
    <div class="sidebar_sticky">
        <aside class="aside_box mb-4">
            <h3 class="aside_name"><i class="bi bi-balloon me-2"></i>共创用户</h3>
            <div class="row all_author mb-4 row-cols-3 row-cols-sm-3 g-2">

                <div class="col">
                    <a href="<?php bloginfo('url'); ?>/author/<?php echo $author_id=$post->post_author; ?>" class="all_author_box">
                    <?php echo get_avatar( get_the_author_meta( 'user_email'), 44); ?>
                    <h3>作者</h3>
                    </a>
                </div>

                <?php if(get_field('all_author')): ?>
                <?php
                $args = array(
                    'include' => get_field('all_author')
                );
                $user_query = new WP_User_Query($args);
                foreach ( $user_query->results as $user ) { ?>
                <div class="col">
                    <a href="<?php bloginfo('url'); ?>/author/<?php echo $user->ID ?>" class="all_author_box">
                    <?php echo get_avatar( $user->ID, 44); ?>
                    <h3><?php echo $user->display_name ?></h3>
                    </a>
                </div>
                <?php } ?>
                <?php endif; ?>
            </div>
        </aside>
        <aside class="aside_box mb-4">
        	<h3 class="aside_name"><i class="bi bi-cup-hot me-2"></i>热门作品</h3>
        	<div class="aside_list">
        		<?php
                query_posts( array( 'post_type'=>'show', 'posts_per_page'=>8, 'orderby'=>'comment_count', ) );
                while( have_posts() ): the_post();
                ?>
                <div class="row align-items-center position-relative mb-4">
                    <div class="col-4">
                    	<?php the_post_thumbnail(array(300, 200, true)); ?>
                    </div>
                    <div class="col-8">
                    	<h2><a class="stretched-link" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <div class="content_loop_info_info">
                            <span><i class="bi bi-chat-text"></i><?php echo get_post($post->ID)->comment_count; ?></span>
                            <span class="sjbxs"><i class="bi bi-clock"></i><?php the_time('Y.m.d'); ?> </span>
                            <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                        </div>
                    </div>
                </div>
        		<?php endwhile; wp_reset_query(); ?>
        	</div>
        </aside>
        <aside class="aside_box mb-5">
            <h3 class="aside_name"><i class="bi bi-chat-right-text me-2"></i>热门素材评论</h3>
            <ul class="sidebar_comments">
            <?php
            $comments = get_comments('post_type=show&number=6&order=DESC');
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
    </div>
</div>