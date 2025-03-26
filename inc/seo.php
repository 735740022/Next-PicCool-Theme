<?php

$all_title	= get_field('sytitle', 'option'); 			//整站标题
$all_key 	= get_field('sykeywords', 'option');		//整站关键词
$all_des	= get_field('sydescription', 'option');		//整站描述
$fgf 		= get_field('seofgf', 'option');			//分隔符
$sitename 	= get_field('seowzbt', 'option');			//网站名称
$cat_fild 	= get_queried_object();						//分类catid

if ( is_home() || is_front_page() ) { ?>
<title><?php echo $all_title ?><?php if ( $paged > 1 ) echo $fgf.'第'.$paged.'页' ?></title>
<meta name="keywords" content="<?php echo $all_key ?>" />
<meta name="description" content="<?php echo $all_des ?>" />
<?php } ?>
<?php if ( is_single() || is_page() ) { ?>
<title><?php if (get_field('seotitle')) { echo the_field('seotitle'); } else { echo get_the_title().$fgf.$sitename ; }?></title>
<meta name="keywords" content="<?php if ( get_field('seokeywords')) { echo get_field('seokeywords'); } else { $posttags = get_the_tags(); if ($posttags) { foreach ( $posttags as $tag ) { echo $tag->name . ','; } } } ?>" />
<meta name="description" content="<?php if ( get_field('seodescription')) { echo the_field('seodescription'); } else { echo wp_trim_words( get_the_content(), 150, '...' ); } ?>"/>
<?php } ?>
<?php if ( is_category() || is_tag() || is_tax() ) { ?>
<title><?php if ( get_field('seotitle',$cat_fild) ) { echo the_field('seotitle', $cat_fild); } else { echo single_cat_title(); echo $fgf.$sitename; }?><?php if ( $paged > 1 ) echo $fgf.'第'.$paged.'页' ?></title>
<meta name="keywords" content="<?php the_field('seokeywords', $cat_fild); ?>" />
<meta name="description" content="<?php the_field('seodescription', $cat_fild); ?>" />
<?php } ?>
<?php if ( is_search() ) { ?>
<title><?php echo get_query_var( 's' ); echo $fgf.$sitename; ?><?php if ( $paged > 1 ) echo $fgf.'第'.$paged.'页' ?></title>
<meta name="keywords" content="<?php echo get_query_var( 's' ); ?>" />
<meta name="description" content="<?php echo get_query_var( 's' ); ?>" />
<?php } ?>
<?php if ( is_author() ) { ?>
<title><?php echo get_the_author_meta('nickname') .$fgf.$sitename ?><?php if ( $paged > 1 ) echo $fgf.'第'.$paged.'页' ?></title>
<meta name="keywords" content="<?php echo get_the_author_meta('nickname'); ?>" />
<meta name="description" content="<?php echo get_the_author_meta('description'); ?>" />
<?php } ?>
<?php if ( is_404() ) { ?>
<title>404 NOT FOUND<?php echo $fgf.$sitename ?></title>
<?php } ?>