<?php
/*
Template Name: 用户中心
*/

if(!is_user_logged_in()) {

	wp_safe_redirect("/");
}

$wpdb->hide_errors(); nocache_headers();

$current_user = wp_get_current_user();

$part_action = (isset($_GET['action'])) ? strtolower($_GET['action']) : '' ;

get_header();

?>

<section class="userban">
    <div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9">
				<div class="user_top">
			        <div class="row align-items-sm-center">
			            <div class="col-3 col-sm-3 col-md-3 col-lg-2">
			            	<div class="user_top_avatar"><?php echo get_avatar( $current_user->user_email, 150); ?></div>
			            </div>
			            <div class="col-9 col-sm-9 col-md-9 col-lg-10">
			        		<div class="user_top_info">
								<h1><?php echo $current_user->nickname;?><small>ID:<?php echo $current_user->ID ?> </small></h1>
								<p><?php echo $current_user->description;?></p>
								<em class="user-rz yes"><i class="bi bi-shield-fill-check"></i>认证会员</em>
							</div>
			            </div>
			        </div>
				</div>
			</div>
		</div>
    </div>
</section>

</header>


<section class="user_foot_bg">
    <div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9">

				<div class="user_menu">
					<a class="<?php if ( $part_action == 'article' ) { echo 'current'; } ?>" href="<?php the_permalink(); ?>?action=article">文章</a>
					<a class="<?php if ( $part_action == 'shows' ) { echo 'current'; } ?>" href="<?php the_permalink(); ?>?action=shows">素材</a>
					<a class="<?php if ( $part_action == 'forums' ) { echo 'current'; } ?>" href="<?php the_permalink(); ?>?action=forums">社区</a>
					<a class="<?php if ( $part_action == 'account' ) { echo 'current'; } ?>" href="<?php the_permalink(); ?>?action=account">资料</a>
				</div>

				<?php
				if ($part_action == 'article'){
					require get_template_directory(). '/pages/user/article.php';
				}
				elseif ($part_action == 'shows'){
					require get_template_directory(). '/pages/user/shows.php';
				}
				elseif ($part_action == 'forums'){
					require get_template_directory(). '/pages/user/forums.php';
				}
				elseif ($part_action == 'account'){
					require get_template_directory(). '/pages/user/account.php';
				}
				else{
					require get_template_directory(). '/pages/user/article.php';
				}
				?>
			</div>
		</div>
    </div>
</section>


<?php get_footer(); ?>