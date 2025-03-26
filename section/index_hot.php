<?php if(get_field('index_hot_cat', 'option')): ?>
<section class="cat_pic_loop">
    <div class="container">
        <div class="owl-carousel index_hot_cat">
            <?php
                $cat_id = get_field('index_hot_cat', 'option');
                foreach ($cat_id as $key => $value) {
                $cat = get_category( $value);
            ?>
            <div class="item">
                <a class="cat_pic_loop_box antu" rel="nofollow" href="<?php echo get_category_link( $cat ); ?>" title="<?php echo $cat->name; ?>">
                    <?php if( get_field('topban', 'category_'.$cat->cat_ID) ): ?>
                    <?php $logo = get_field('topban', 'category_'.$cat->cat_ID); echo wp_get_attachment_image($logo, array(120, 80, true)); ?>
                    <?php endif; ?>
                    <h2 class=""><?php echo $cat->name; ?><small>[<?php echo $cat->count ?>]</small></h2>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php endif; ?>