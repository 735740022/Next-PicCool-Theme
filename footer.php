<footer class="footer">

	<section class="footbar">
	    <div class="container">
	        <div class="row">
	            <div class="col-sm-3">
					<div class="foot_about pe-0 pe-sm-5">
						<img src="<?php the_field('logo', 'option'); ?>" alt="">
						<?php the_field('foot_about', 'option'); ?>
					</div>
	            </div>
	            <div class="col-sm-7 sjbxs">
			        <div class="row row-cols-4 row-cols-sm-4 g-3">
			            <div class="col">
			            	<div class="foot_nav">
			            		<h3><?php $menu=get_nav_menu_locations(); if(isset($menu["foot1"])):$menu_object=wp_get_nav_menu_object($menu["foot1"]); echo $menu_object->name ;else:echo '菜单名'; endif; ?></h3>
								<?php wp_nav_menu(
								    array(
								    'theme_location'  => 'foot1',
								    'container'       => 'nav',
								    'container_class' => 'primary',
								    'menu_class'      => 'foot-ul',
								    'menu_id'         => 'foot-ul',
								    'depth'           => 1,
								    )
								);
								?>
			            	</div>
			            </div>
			            <div class="col">
			            	<div class="foot_nav">
			            		<h3><?php $menu=get_nav_menu_locations(); if(isset($menu["foot2"])):$menu_object=wp_get_nav_menu_object($menu["foot2"]); echo $menu_object->name ;else:echo '菜单名'; endif; ?></h3>
			            		<?php wp_nav_menu(
								    array(
								    'theme_location'  => 'foot2',
								    'container'       => 'nav',
								    'container_class' => 'primary',
								    'menu_class'      => 'foot-ul',
								    'menu_id'         => 'foot-ul',
								    'depth'           => 1,
								    )
								);
								?>
			            	</div>
			            </div>
			            <div class="col">
			            	<div class="foot_nav">
			            		<h3><?php $menu=get_nav_menu_locations(); if(isset($menu["foot3"])):$menu_object=wp_get_nav_menu_object($menu["foot3"]); echo $menu_object->name ;else:echo '菜单名'; endif; ?></h3>
			            		<?php wp_nav_menu(
								    array(
								    'theme_location'  => 'foot3',
								    'container'       => 'nav',
								    'container_class' => 'primary',
								    'menu_class'      => 'foot-ul',
								    'menu_id'         => 'foot-ul',
								    'depth'           => 1,
								    )
								);
								?>
			            	</div>
			            </div>
			            <div class="col">
			            	<div class="foot_nav">
			            		<h3><?php $menu=get_nav_menu_locations(); if(isset($menu["foot4"])):$menu_object=wp_get_nav_menu_object($menu["foot4"]); echo $menu_object->name ;else:echo '菜单名'; endif; ?></h3>
			            		<?php wp_nav_menu(
								    array(
								    'theme_location'  => 'foot4',
								    'container'       => 'nav',
								    'container_class' => 'primary',
								    'menu_class'      => 'foot-ul',
								    'menu_id'         => 'foot-ul',
								    'depth'           => 1,
								    )
								);
								?>
			            	</div>
			            </div>
			        </div>
	            </div>
	            <div class="col-sm-2">
		            <div class="foot_nav">
	            		<h3>关注我们</h3>
	            		<?php if(get_field('foot_ewm', 'option')): ?>
	            		<div class="footer_ewm">
	            			<?php while ( have_rows('foot_ewm', 'option') ) : the_row(); ?>
	            			<div class="footer_ewm_box">
	            				<img src="<?php the_sub_field('pic', 'option'); ?>" alt="">
	            				<h4><?php the_sub_field('ms', 'option'); ?></h4>
	            			</div>
	            			<?php endwhile; ?>
	            		</div>
	            		<?php endif; ?>
	            		<?php if(get_field('foot_icon', 'option')): ?>
	            		<div class="footer_icon">
							<?php while ( have_rows('foot_icon', 'option') ) : the_row(); ?>
	            			<a href="<?php the_sub_field('link', 'option'); ?>"><?php the_sub_field('tb', 'option'); ?></a>
	            			<?php endwhile; ?>
	            		</div>
	            		<?php endif; ?>
	            	</div>
	            </div>
	        </div>
	    </div>
    </section>

	<section class="banquan">
	    <div class="container">
	        <div class="banquan_box">
				<div class="">本站由 <a href="https://www.nextok.com/">Next Theme</a> 驱动</div>
	            <?php the_field('banquan_r', 'option'); ?>
	        </div>
	    </div>
	</section>

</footer>


<?php if ( wp_is_mobile()) { } else { ?>
<?php if(get_field('r_tool', 'option')): ?>
<aside class="r_aside show_m">
	<ul>
		<?php while ( have_rows('r_tool', 'option') ) : the_row(); ?>
		<li>
			<a class="r_aside_a" href=""><?php the_sub_field('tb', 'option'); ?></a>
			<?php if ( get_sub_field('ewm', 'option') ) { ?>
				<span class="aside_box">
					<h4><?php the_sub_field('ms', 'option'); ?></h4>
					<img src="<?php the_sub_field('ewm', 'option'); ?>" alt="">
					<p><?php the_sub_field('ewm_ms', 'option'); ?></p>
				</span>
			<?php } else { ?>
				<span><?php the_sub_field('ms', 'option'); ?></span>
			<?php } ?>
		</li>
		<?php endwhile; ?>
		<li><button type="button" class="r_aside_a back-top"><i class="bi bi-arrow-up-circle"></i></button>
			<span>返回顶部</span>
		</li>
	</ul>
</aside>
<?php endif; ?>
<?php } ?>


<?php the_field('footer_diy', 'option'); ?>
<?php wp_footer();?>
</body>
</html>