<?php get_header();?>
<section class="topban_img" style="background-image:url(<?php if (get_field('topban')) { $data = wp_get_attachment_image_src(get_field('topban'), 'full'); echo $data[0]; } else { echo get_field('bg_def', 'option'); } ?>)" >
    <div class="container">
        <div class="topban_box">
            <h1><?php the_title(); ?></h1>
            <h2>分类描述分类描述分类描述分类描述分类描述</h2>
        </div>
    </div>
</section>

</header>

<main>



<section class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            	<div class="row">
            		<div class="col-lg-8">
            			<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>

						<?php if ( has_post_format( 'video' )) { ?>
            			<div class="single_sty_video">
            				<video width="100%" height="100%" controls>
							  <source src="<?php the_field('video'); ?>" type="video/mp4">
							</video>
				    	</div>
						<?php } ?>

				    	<div class="single_sty_def bg-white mb-5">
				    		<h1 class="single_sty_def_title"><?php the_title(); ?></h1>
				    		<div class="single_sty_def_info">
				    			<span class="me-3"><i class="bi bi-card-text me-2"></i><?php the_category(', ') ?></span>
				    			<span class="me-3"><i class="bi bi-clock me-2"></i><?php the_time('Y-m-d'); ?></span>
				    			<span><i class="bi bi-book me-2"></i><?php post_views('',''); ?></span>
				    		</div>
							<article class="wznrys f16 text-justify">
							<?php the_content(); ?>
							</article>
							<div class="single_sty_def_tag">
								<b class="me-3"><i class="bi bi-bookmark-check me-2"></i>标签</b>
								<?php the_tags('', '', ''); ?>
							</div>
				    	</div>
				    	<?php endwhile; ?>

				    	<?php
						if ( comments_open() || get_comments_number() ) :
						    comments_template();
						endif;
						?>
		            </div>

		            <?php get_sidebar() ?>

		        </div>
		    </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>