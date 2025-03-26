<div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
    <?php
        $args = array(
		  'author__in'		=> $curauth->ID,
		  'post_type'		=>'show',
		  'post_status'		=>'publish',
		  'posts_per_page'	=> 12,
		  'paged' 			=> get_query_var('paged'),
		  'orderby'			=>'date',
		  'order'			=>'DESC'
		);
        $my_query = new WP_Query($args);
        if( $my_query->have_posts() ) {
            while ($my_query->have_posts()) : $my_query->the_post();
    ?>
    <div class="col">
        <div class="content_loop h-100">
            <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                <?php the_post_thumbnail(array(400,300, true)); ?>
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