<?php get_header();?>
<section class="topban_img" style="background-image:url(<?php if (get_field('topban')) { $data = wp_get_attachment_image_src(get_field('topban'), 'full'); echo $data[0]; } else { echo get_field('bg_def', 'option'); } ?>)">
    <div class="container">
        <div class="topban_box">
            <h1><?php the_title(); ?></h1>
            <h2><?php the_excerpt(); ?></h2>
        </div>
    </div>
</section>
</header>
<main>

<section class="mb-5">
    <div class="container py-5">
        <?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
        <div class="row mb-5">
            <div class="col-lg-8">
            <?php if ( has_post_format( 'video' )) {  ?>
                <video width="100%" controls>
                    <source src="<?php if ( get_field('video_type') == 'url') { echo get_field('video_url'); } else { echo get_field('video'); } ?>" type="video/mp4">
                </video>

            <?php } else if ( has_post_format( 'audio' )) {  ?>
                <audio controls controlsList="nodownload">
                  <source src="<?php if ( get_field('audio_type') == 'url') { echo get_field('audio_url'); } else { echo get_field('audio'); } ?>" type="audio/mpeg">
                </audio>

            <?php } else{ //标准 ?>

                <?php if (get_field('lay_style') == 'shu' ) {
                    include('section/lay_style_shu.php');
                } else {
                    include('section/lay_style_def.php');
                }
                ?>

            <?php } ?>
            </div>
            <div class="col-lg-4">
                <div class="show_box_right">
                    <h1><?php the_title(); ?></h1>
                    <ul class="show_box_right_nub">
                        <li><span>素材编号:</span><b>SC<?php the_time('Ymd'); ?><?php echo $post->ID ?> </b></li>
                        <li><span>素材分类:</span><b><?php the_terms( $post->ID, 'shows', '', '' ); ?></b></li>
                        <li><span>素材用途:</span><b><?php the_field('yongtu'); ?></b></li>
                        <li><span>适用行业:</span><b><?php the_field('hangye'); ?></b></li>
                        <li><span>素材类型:</span><b><?php the_field('leixing'); ?></b></li>
                        <li><span>素材格式:</span><b><?php the_field('geshi'); ?></b></li>
                        <li class="show_tag_li"><span>作品标签:</span><b><?php the_terms( $post->ID, 'show_tag', '#', '#' ); ?></b></li>
                    </ul>

                    <div class="show_buy_type">

                        <div class="show_buy_head">
                            <h3>选择购买方式</h3>
                        </div>


                        <div class="show_buy_cent">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <h3>单张下载</h3>
                                    <p>只下载封面一张图</p>
                                    <span><?php the_field('jiage'); ?><?php the_field('money_name', 'option'); ?></span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <h3>全部下载</h3>
                                    <p>下载该资源的一整套文件</p>
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <?php
                        $single_download = get_field('wjsc');
                        $full_download = get_field('twjsc');
                        ?>

                        <a href="<?php echo $single_download; ?>" download class="show_buy_down" id="downloadBtn"><i class="bi bi-arrow-down-square me-2"></i>下载源文件</a>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const singleRadio = document.getElementById('flexRadioDefault1');
                            const fullRadio = document.getElementById('flexRadioDefault2');
                            const downloadBtn = document.getElementById('downloadBtn');
                            const singleUrl = '<?php echo $single_download; ?>';
                            const fullUrl = '<?php echo $full_download; ?>';

                            function updateDownloadUrl() {
                                downloadBtn.href = singleRadio.checked ? singleUrl : fullUrl;
                            }

                            singleRadio.addEventListener('change', updateDownloadUrl);
                            fullRadio.addEventListener('change', updateDownloadUrl);
                        });
                        </script>


                    </div>


                    <!-- <div class="show_box_right_banquan">
                        <p><span>版权所有：</span><b><i class="bi bi-c-circle"></i><?php the_field('banquan'); ?></b></p>
                        <p><span>版权授权方式：</span><b><?php the_field('shouquan'); ?></b></p>
                    </div> -->
                </div>
            </div>
        </div>
        <?php endwhile; ?>


        <?php if ( has_post_format( 'video' )) { } else if ( has_post_format( 'audio' )) { } else{ //标准 ?>


<?php if ( get_field('lay_style') != 'shu' ) { ?>



            <div class="row row-cols-4 row-cols-sm-4 row-cols-md-6 g-3 mb-4 pb-2">
            <?php
            $post_content = $post->post_content;
            $search_pattern = '/<img.*?src="(.*?)"/i';
            preg_match_all( $search_pattern, $post_content, $embedded_images );
            $embedded_images_count = count( $embedded_images[0] );
            if ( $embedded_images_count > 0 ) {
            for ( $i=0; $i < $embedded_images_count ; $i++ ) {

            $pic_id = attachment_url_to_postid($embedded_images[1][$i]);

                ?>
                <div class="col">
                    <a class="show_fancy" href="<?php echo $embedded_images[1][$i] ?>" data-fancybox="gallery" data-caption="<?php the_title(); ?>" ><img src="<?php $data = wp_get_attachment_image_src($pic_id, array(300,200,true)); echo $data[0]; ?>" alt="">
                        <i class="bi bi-aspect-ratio"></i>
                    </a>
                </div>
            <?php } };?>
            </div>

<?php } ?>


        <?php } ?>


        <?php if(get_field('show_banquan', 'option')): ?>
        <p class="show_box_shengming"><i class="bi bi-c-circle me-2"></i><?php the_field('show_banquan', 'option'); ?></p>
        <?php endif; ?>

    </div>
</section>



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


<section class="bg-white py-5">
    <div class="container py-5">
        <div class="hg_name mb-5">
            <h6 class="f12">探索</h6>
            <h3 class="f24">相关内容</h3>
        </div>
        <div class="pubuliu row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-4">
        <?php
            $term_info = get_the_terms($post->ID,'shows'); //获取分类信息
            $args = array(
                'post_type' => 'show',
                'showposts' => 10,
                'post__not_in' => array( $post->ID ),   //排除当前文章
                'tax_query' => array(
                    array(
                        'taxonomy' => 'shows',
                        'terms' => $term_info[0]->term_id
                        ),
                    )
                );
            $my_query = new WP_Query($args);
            if( $my_query->have_posts() ) {
                while ($my_query->have_posts()) : $my_query->the_post();
        ?>
        <div class="col">
            <div class="content_loop">
                <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>" target="_blank">
                <?php if ( has_post_format( 'video' )) {  ?>
                    <video oncontextmenu="return false;" width="100%" onMouseOver="this.play()" onMouseOut="this.pause()" controlslist="nodownload noplaybackrate" disablePictureInPicture controls>
                        <source src="<?php if ( get_field('video_type') == 'url') { echo get_field('video_url'); } else { echo get_field('video'); } ?>" type="video/mp4">
                    </video>

                <?php } else if ( has_post_format( 'audio' )) {  ?>
                    <audio controls controlsList="nodownload">
                      <source src="<?php if ( get_field('audio_type') == 'url') { echo get_field('audio_url'); } else { echo get_field('audio'); } ?>" type="audio/mpeg">
                    </audio>

                <?php } else{ //标准 ?>
                    <?php if (get_field('show_lay', 'option') == 'pbl' ) {
                        the_post_thumbnail(array(400, true));
                    } else {
                        the_post_thumbnail(array(400, 300, true));
                    }
                    ?>
                <?php } ?>
                </a>

                <div class="content_loop_foot bg-light">
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
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-lg-8">

                        <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                    <?php get_sidebar('show') ?>
                </div>
            </div>
        </div>
    </div>
</section>


</main>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/fancybox/fancybox.css"/>
<script src="<?php bloginfo('template_directory'); ?>/assets/fancybox/fancybox.js"></script>


<?php get_footer(); ?>