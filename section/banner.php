<?php $images = get_field('banner', 'option'); ?>
<section class="banner">
    <?php if($images): ?>
        <div class="banbox owl-carousel">
            <?php foreach($images as $image): ?>
                <div class="item">
                    <div class="image-layer" style="background-image: url(<?php echo $image['url']; ?>);"></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="height:70vh;background: #797979;"></div>
    <?php endif; ?>
</section>