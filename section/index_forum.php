<section class="index_forum">
    <div class="container">
        <div class="section_name">
            <h2>社区<span>forum</span></h2>
            <div class="nav section_cat_name" id="nav-tab" role="tablist">
                <?php
                    $cat_id = get_field('index_forum', 'option');
                    if($cat_id && is_array($cat_id)) {
                        foreach ($cat_id as $key => $value) {
                            $cat = get_term($value);
                            if($cat && !is_wp_error($cat)) {
                ?>
                                <a href="<?php echo get_category_link($cat->term_id); ?>"># <?php echo $cat->name; ?></a>
                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-5 mb-4 mb-md-0">
                <?php
                $t_id = get_field('index_single_top', 'option');
                if($t_id) {
                    $args = array(
                        'post_type'=>'forum',
                        'tax_query'=>array(
                            array(
                                'taxonomy'=>'forums',
                                'field'=>'term_id',
                                'terms'=>$t_id
                            )
                        ),
                        'posts_per_page'=>1,
                    );
                    query_posts($args);
                    while(have_posts()): the_post();
                ?>
                    <a class="index-news-lay-1 antu d-block h-100 rounded-3 overflow-hidden" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail(array(600, 400, true)); ?>
                        <div class="index-news-lay-1-box">
                            <div class="time"><span><?php the_time('d'); ?></span><small><?php the_time('F'); ?><br><?php the_time('Y'); ?></small></div>
                            <h2><?php the_title(); ?></h2>
                            <div class="index-news-lay-1-foot">—— <?php
                                $taxonomy = get_term($t_id, 'forums');
                                echo ($taxonomy && !is_wp_error($taxonomy)) ? $taxonomy->name : '';
                            ?></div>
                        </div>
                    </a>
                <?php endwhile; wp_reset_query();
                }
                ?>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="row">
                    <div class="index-news-lay-top d-flex">
                        <div class="col-6">
                            <?php
                            $tags_id = get_field('index_single_tag','option');
                            if($tags_id && is_array($tags_id)) {
                                $i=1;
                                foreach ($tags_id as $key => $value) {
                                    $tag = get_term($value, 'forum_tag');
                                    if($tag && !is_wp_error($tag)) {
                                        $topban = get_field('topban', 'forum_tag_'.$tag->term_id);
                                        if($topban) {
                            ?>
                                            <a class="index-news-lay-2 index-news-lay-2-s antu d-block rounded-3 overflow-hidden" rel="nofollow" href="<?php echo get_tag_link($tag); ?>" title="<?php echo $tag->name; ?>">
                                                <?php echo wp_get_attachment_image($topban, array(300, 220, true)); ?>
                                                <span class="index-news-lay-2-foot">
                                                    #<?php echo $tag->name; ?>
                                                </span>
                                            </a>
                            <?php
                                        }
                                        $i++;
                                        if($i>2) break;
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="col-6">
                            <?php
                            if($tags_id && is_array($tags_id)) {
                                $i=1;
                                foreach ($tags_id as $key => $value) {
                                    $tag = get_term($value, 'forum_tag');
                                    if($tag && !is_wp_error($tag)) {
                                        $topban = get_field('topban', 'forum_tag_'.$tag->term_id);
                                        if($topban && $i == 3) {
                            ?>
                                            <a class="index-news-lay-2 index-news-lay-2-e antu d-block rounded-3 overflow-hidden" rel="nofollow" href="<?php echo get_tag_link($tag); ?>" title="<?php echo $tag->name; ?>">
                                                <?php echo wp_get_attachment_image($topban, array(300, 450, true)); ?>
                                                <span class="index-news-lay-2-foot">
                                                    #<?php echo $tag->name; ?>
                                                </span>
                                            </a>
                            <?php
                                        }
                                        $i++;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="index-news-lay-bottom">
                        <?php
                        if($tags_id && is_array($tags_id)) {
                            $i=1;
                            foreach ($tags_id as $key => $value) {
                                $tag = get_term($value, 'forum_tag');
                                if($tag && !is_wp_error($tag)) {
                                    $topban = get_field('topban', 'forum_tag_'.$tag->term_id);
                                    if($topban && $i == 4) {
                        ?>
                                        <a class="index-news-lay-2 antu d-block h-100 rounded-3 overflow-hidden" rel="nofollow" href="<?php echo get_tag_link($tag); ?>" title="<?php echo $tag->name; ?>">
                                            <?php echo wp_get_attachment_image($topban, array(500, 200, true)); ?>
                                            <span class="index-news-lay-2-foot">
                                                #<?php echo $tag->name; ?>
                                            </span>
                                        </a>
                        <?php
                                    }
                                    $i++;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $t_id = get_field('index_single_r', 'option');
                if($t_id) {
                    $args = array(
                        'post_type'=>'forum',
                        'tax_query'=>array(
                            array(
                                'taxonomy'=>'forums',
                                'field'=>'term_id',
                                'terms'=>$t_id
                            )
                        ),
                        'posts_per_page'=>1,
                    );
                    query_posts($args);
                    while(have_posts()): the_post();
                ?>
                    <a class="index-news-lay-3 antu d-block h-100 rounded-3 overflow-hidden" rel="nofollow" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail(array(500, 400, true)); ?>
                        <div class="index-news-lay-3-box">
                            <i class="bi bi-play-circle-fill"></i>
                            <h2><?php the_title(); ?></h2>
                            <span><?php
                                $taxonomy = get_term($t_id, 'forums');
                                echo ($taxonomy && !is_wp_error($taxonomy)) ? $taxonomy->name : '';
                            ?></span>
                        </div>
                    </a>
                <?php endwhile; wp_reset_query();
                }
                ?>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            $cat_id = get_field('index_forum', 'option');
            if($cat_id && is_array($cat_id)) {
                foreach ($cat_id as $key => $value) {
                    $cat = get_term($value);
                    if($cat && !is_wp_error($cat)) {
            ?>
                        <div class="col">
                            <div class="index-news-loop">
                                <div class="index-news-loop-name">
                                    <?php
                                    $logo = get_field('topban', 'forum_tag_'.$cat->term_id);
                                    if($logo) {
                                        echo wp_get_attachment_image($logo, array(450, 140, true));
                                    }
                                    ?>
                                    <div class="index-news-loop-name-foot">
                                        <h2><?php echo $cat->name; ?></h2>
                                        <a href="<?php echo get_category_link($cat->term_id); ?>">more</a>
                                    </div>
                                </div>
                                <ul class="index-news-loop-ul">
                                    <?php
                                    $display_nub = get_field('index_forum_nub', 'option');
                                    $display_nub = $display_nub ? $display_nub : 5; // 默认显示5条
                                    $args = array(
                                        'post_type'=>'forum',
                                        'tax_query'=>array(
                                            array(
                                                'taxonomy'=>'forums',
                                                'field'=>'term_id',
                                                'terms'=>$cat->term_id
                                            )
                                        ),
                                        'posts_per_page'=>$display_nub
                                    );
                                    query_posts($args);
                                    while(have_posts()): the_post();
                                    ?>
                                    <li>
                                        <a class="" href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                        <div class="content_loop_info_info">
                                            <span><i class="bi bi-chat-text"></i><?php echo get_post($post->ID)->comment_count; ?></span>
                                            <span class="sjbxs"><i class="bi bi-clock"></i><?php the_time('Y.m.d'); ?> </span>
                                            <span><i class="bi bi-book"></i><?php post_views('',''); ?></span>
                                        </div>
                                    </li>
                                    <?php endwhile; wp_reset_query(); ?>
                                </ul>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</section>