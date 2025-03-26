<?php
$cat_fild = get_queried_object();
$term_id = $cat_fild->term_id;
//不准删除
get_header(); ?>

<section class="topban_img" style="background-image:url(<?php if ( get_field('topban', $cat_fild) ) { $data = wp_get_attachment_image_src( get_field('topban', $cat_fild ), 'full' ); echo $data[0]; } else { echo get_field('bg_def', 'option'); } ?>);">
    <div class="container">
        <div class="topban_box">
            <h1><?php single_cat_title(); ?></h1>
            <h2><?php echo category_description();?></h2>
        </div>
    </div>
</section>

</header>

<main>

<?php

$currentterm = get_queried_object();
$base_url = get_term_link($currentterm,'category'); //获取当前分类的url
$sift_array = ds_get_sift_array(); //获取筛选数组

$yongtu_array['all'] = '全部';
$yongtu_array = array_merge( $yongtu_array, $sift_array['yongtu']);
$yongtu_keys = array_keys( $yongtu_array);

$hangye_array['all'] = '全部';
$hangye_array = array_merge( $hangye_array, $sift_array['hangye']);
$hangye_keys = array_keys( $hangye_array);

$leixing_array['all'] = '全部';
$leixing_array = array_merge( $leixing_array, $sift_array['leixing']);
$leixing_keys = array_keys( $leixing_array);

$geshi_array['all'] = '全部';
$geshi_array = array_merge( $geshi_array, $sift_array['geshi']);
$geshi_keys = array_keys( $geshi_array);

$sift_vars = array();
$sift_vars['yongtu'] = get_query_var('yongtu', 'all');
$sift_vars['hangye'] = get_query_var('hangye', 'all');
$sift_vars['leixing'] = get_query_var('leixing', 'all');
$sift_vars['geshi'] = get_query_var('geshi', 'all');

$yongtu_params = array();
$hangye_params = array();
$leixing_params = array();
$geshi_params = array();

if( in_array( $sift_vars['yongtu'], $yongtu_keys ) ){
  $hangye_params['yongtu'] = $sift_vars['yongtu'];
  $leixing_params['yongtu'] = $sift_vars['yongtu'];
  $geshi_params['yongtu'] = $sift_vars['yongtu'];
}

if( in_array( $sift_vars['hangye'], $hangye_keys ) ){
  $yongtu_params['hangye'] = $sift_vars['hangye'];
  $leixing_params['hangye'] = $sift_vars['hangye'];
  $geshi_params['hangye'] = $sift_vars['hangye'];
}

if( in_array( $sift_vars['leixing'], $leixing_keys ) ){
  $yongtu_params['leixing'] = $sift_vars['leixing'];
  $hangye_params['leixing'] = $sift_vars['leixing'];
  $geshi_params['leixing'] = $sift_vars['leixing'];
}

if( in_array( $sift_vars['geshi'], $geshi_keys ) ){
  $yongtu_params['geshi'] = $sift_vars['geshi'];
  $hangye_params['geshi'] = $sift_vars['geshi'];
  $leixing_params['geshi'] = $sift_vars['geshi'];
}

$selected = 'class="selected"';

?>

<section class="sort">
    <div class="container">
        <div class="sort_box">

            <div class="sort_loop">
                <h3>分类:</h3>
                <div class="sort_a">
                <?php
                $args=array(
                'hide_empty'    => 0,
                'taxonomy'      => 'shows',
                'orderby'       => 'name',
                'order'         => 'ASC'
                );
                $categories=get_categories($args);
                foreach($categories as $category) { ?>
                <a <?php if ( $term_id == $category->term_id ) { echo $selected; } ?> href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name ?>(<?php echo $category->count ?>)</a>
                <?php } ?>
                </div>
            </div>

            <div class="sort_loop">
                <h3>用途:</h3>
                <div class="sort_a">
                <?php
                foreach( $yongtu_array as  $key=>$name ){
                $yongtu_params['yongtu'] = $key;
                ?>
                <a <?php if( $sift_vars['yongtu'] == $key ) echo $selected; ?> href="<?php echo esc_url( add_query_arg( $yongtu_params, $base_url ) ); ?>"><?php echo $name; ?></a>
                <?php } ?>
                </div>
            </div>
            <div class="sort_loop">
                <h3>行业:</h3>
                <div class="sort_a">
                <?php
                foreach( $hangye_array as  $key=>$name ){
                $hangye_params['hangye'] = $key;
                ?>
                <a <?php if( $sift_vars['hangye'] == $key ) echo $selected; ?> href="<?php echo esc_url( add_query_arg( $hangye_params, $base_url ) ); ?>"><?php echo $name; ?></a>
                <?php } ?>
                </div>
            </div>
            <div class="sort_loop">
                <h3>类型:</h3>
                <div class="sort_a">
                <?php
                foreach( $leixing_array as  $key=>$name ){
                $leixing_params['leixing'] = $key;
                ?>
                <a <?php if( $sift_vars['leixing'] == $key ) echo $selected; ?> href="<?php echo esc_url( add_query_arg( $leixing_params, $base_url ) ); ?>"><?php echo $name; ?></a>
                <?php } ?>
                </div>
            </div>
            <div class="sort_loop">
                <h3>格式:</h3>
                <div class="sort_a">
                <?php
                foreach( $geshi_array as  $key=>$name ){
                $geshi_params['geshi'] = $key;
                ?>
                <a <?php if( $sift_vars['geshi'] == $key ) echo $selected; ?> href="<?php echo esc_url( add_query_arg( $geshi_params, $base_url ) ); ?>"><?php echo $name; ?></a>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $lay = get_field('show_lay', 'option'); if ( $lay == 'pbl') { ?>
<script src="<?php bloginfo('template_directory'); ?>/assets/masonry/masonry.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/masonry/imagesloaded.js"></script>
<script>
$(function(){
    var $container = $('.pubuliu');
    $container.imagesLoaded(function(){
        $container.masonry({
            itemSelector: '.col'
        });
    });
});
</script>
<?php } ?>

<section class="content_loop_show">
    <div class="container">
        <div class="pubuliu row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-4">
            <?php while( have_posts() ): the_post(); ?>
                <div class="col">
                    <div class="content_loop">
                        <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>">

                            <?php if ( has_post_format( 'video' )) {  ?>
                                <video oncontextmenu="return false;" width="100%" onMouseOver="this.play()" onMouseOut="this.pause()" controlslist="nodownload noplaybackrate" disablePictureInPicture controls>
                                    <source src="<?php if ( get_field('video_type') == 'url') { echo get_field('video_url'); } else { echo get_field('video'); } ?>" type="video/mp4">
                                </video>

                            <?php } else if ( has_post_format( 'audio' )) {  ?>
                                <audio controls controlsList="nodownload">
                                  <source src="<?php if ( get_field('audio_type') == 'url') { echo get_field('audio_url'); } else { echo get_field('audio'); } ?>" type="audio/mpeg">
                                </audio>

                            <?php } else{ //标准 ?>

                                <?php $lay = get_field('show_lay', 'option'); if ( $lay == 'pbl') {
                                    the_post_thumbnail(array(400, true));
                                } else {
                                    the_post_thumbnail(array(400, 300, true));
                                }
                                ?>

                            <?php } ?>

                        </a>
                        <div class="content_loop_foot">
                            <h2 class=""><a class="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
            <?php endwhile; ?>
        </div>
        <div class="posts-nav clearfix">
        <?php echo paginate_links(array(
            'prev_next' => 1,
            'before_page_number' => '',
            'mid_size' => 4,
            'prev_text' => __('<'),
            'next_text' => __('>'),
        ));
        ?>
        </div>
    </div>
</section>

</main>


<?php get_footer(); ?>