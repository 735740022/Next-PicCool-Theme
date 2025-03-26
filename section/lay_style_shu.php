<div class="lay_style_shu mb-4" style="background-image: url(<?php echo get_the_post_thumbnail_url( null, 'full' ); ?>);">
<img src="<?php echo get_the_post_thumbnail_url( null, 'full' ); ?>" alt="">
</div>

<div class="row row-cols-4 row-cols-sm-4 row-cols-md-4 g-3">
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
        <a class="show_fancy rounded-2 overflow-hidden" href="<?php echo $embedded_images[1][$i] ?>" data-fancybox="gallery" data-caption="<?php the_title(); ?>" ><img src="<?php $data = wp_get_attachment_image_src($pic_id, array(300,true)); echo $data[0]; ?>" alt="">
            <i class="bi bi-aspect-ratio"></i>
        </a>
    </div>
<?php } };?>
</div>