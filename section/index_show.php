<?php if(get_field('index_show_cat', 'option')): ?>
<section class="content_loop_show">
    <div class="container">
        <div class="section_name">
            <h2>素材<span>show</span></h2>
            <div class="nav section_cat_name">
            <?php
                $i=1;
                $cat_id = get_field('index_show_cat', 'option');
                foreach ($cat_id as $key => $value) {
                $cat = get_category( $value);
            ?>
                <button class="nav-link <?php if ( $i == '1') { echo 'active'; } ?>"  data-bs-toggle="tab" data-bs-target="#index_show_tab_<?php echo $i ?>" type="button"><?php echo $cat->name; ?></button>
            <?php $i++; } ?>
            </div>
        </div>
        <div class="tab-content">

            <?php
                $i=1;
                $cat_id = get_field('index_show_cat', 'option');
                foreach ($cat_id as $key => $value) {
                $cat = get_category( $value);
            ?>

            <div class="tab-pane fade <?php if ( $i == '1') { echo 'show active'; } ?>" id="index_show_tab_<?php echo $i ?>">

                <div class="index_pbl">
                    <?php
                    $display_nub = get_field('index_show_cat_nub', 'option');
                    $args = array(
                        'post_type'=>'show',
                        'tax_query'=>array(
                            array(
                                'taxonomy'=>'shows',
                                'field'=>'term_id',
                                'terms'=>$cat->term_id
                            )
                        ),
                        'posts_per_page'=>$display_nub
                    );
                    query_posts( $args );
                    while( have_posts() ): the_post();
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
                    <?php endwhile; wp_reset_query(); ?>
                </div>
            </div>
            <?php $i++; } ?>
        </div>
    </div>
</section>
<?php endif; ?>



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