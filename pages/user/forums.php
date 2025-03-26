<div class="row">
    <div class="col-lg-8">

        <div class="jj_wd_l me-0 me-lg-4">

            <?php
                $args = array(
                  'author__in'      => $current_user->ID ,
                  'post_type'       =>'forum',
                  'post_status'     =>'publish',
                  'posts_per_page'  => 12,
                  'paged'           => get_query_var('paged'),
                  'orderby'         =>'date',
                  'order'           =>'DESC'
                );
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                    while ($my_query->have_posts()) : $my_query->the_post();
            ?>
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
                        <?php if ( get_field('user_delete', 'option') == 'yes' ) { ?>
                        <?php
                        $url = get_bloginfo('url');
                        if (current_user_can('edit_post', $post->ID)){
                            echo '<a class="delete-post" href="';
                            echo wp_nonce_url("$url/wp-admin/post.php?action=delete&post=$id", 'delete-post_' . $post->ID);
                            echo '"><span class="text-success">删除</span></a>';
                        }
                        ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); } ?>
        </div>

        <div class="posts-nav my-5 py-5 text-center">
            <?php
                // https://developer.wordpress.org/reference/functions/paginate_links/
                $big = 999999999;
                echo paginate_links( array(
                    'prev_text' => '上页',
                    'next_text' => '下页',
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $my_query->max_num_pages
                ) );
            ?>
        </div>

    </div>

    <?php get_sidebar('forum') ?>

</div>