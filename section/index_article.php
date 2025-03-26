<?php if(get_field('index_def_cat', 'option')): ?>
<section class="content_loop_show_news">
    <div class="container">
        <div class="section_name">
            <h2>文章<span>article</span></h2>
            <div class="nav section_cat_name">
                <?php
                    $i=1;
                    $cat_id = get_field('index_def_cat', 'option');
                    foreach ($cat_id as $key => $value) {
                    $cat = get_category( $value);
                ?>
                <button class="nav-link <?php if ( $i == '1') { echo 'active'; } ?>"  data-bs-toggle="tab" data-bs-target="#index_show_tab_n_<?php echo $i ?>" type="button"><?php echo $cat->name; ?></button>
                <?php $i++; } ?>
            </div>
        </div>
        <div class="tab-content">
            <?php
                $i=1;
                $cat_id = get_field('index_def_cat', 'option');
                foreach ($cat_id as $key => $value) {
                $cat = get_category( $value);
            ?>
            <div class="tab-pane fade <?php if ( $i == '1') { echo 'show active'; } ?>" id="index_show_tab_n_<?php echo $i ?>">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-4">
                    <?php
                    $def_nub = get_field('index_def_cat_nub', 'option');
                    query_posts( array( 'cat'=>$cat->term_id, 'posts_per_page'=>$def_nub, 'ignore_sticky_posts'=>true ) );
                    while( have_posts() ): the_post();
                    ?>
                    <div class="col g-3 g-sm-4">
                        <div class="content_loop_news">
                            <div class="row g-3 g-sm-4">
                                <div class="col-4 col-sm-3">
                                    <a class="content_loop_pic" rel="nofollow" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                                        <?php the_post_thumbnail(array(400, 300, true)); ?>
                                    </a>
                                </div>
                                <div class="col-8 col-sm-9">
                                    <div class="content_loop_news_foot">
                                        <h2><a class="" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                        <p><?php echo wp_trim_words( get_the_content(), 70 ); ?></p>
                                        <div class="content_loop_info_info">
                                            <span><i class="bi bi-chat-text"></i><?php echo get_post($post->ID)->comment_count; ?></span>
                                            <span class="sjbxs"><i class="bi bi-clock"></i><?php the_time('Y.m.d'); ?> </span>
                                            <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                                        </div>
                                    </div>
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