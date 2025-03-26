<?php get_header();?>
<section class="topban_img" style="background-image:url(<?php if (get_field('topban')) { $data = wp_get_attachment_image_src(get_field('topban'), 'full'); echo $data[0]; } else { echo get_field('bg_def', 'option'); } ?>)">
    <div class="container">
        <div class="topban_box">
            <h1><?php the_title(); ?></h1>
            <h2><?php the_field('seodescription'); ?></h2>
        </div>
    </div>
</section>
</header>
<main>
<section class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
		    	<div class="single_sty_def bg-white mb-5">
		    		<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
					<article class="wznrys f16 text-justify">
					<?php the_content(); ?>
					</article>
					<?php endwhile; ?>
		    	</div>
		    </div>
        </div>
    </div>
</section>
</main>
<?php get_footer(); ?>