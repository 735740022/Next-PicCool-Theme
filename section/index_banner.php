<section class="index_banner">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="index_banner_box">
                    <h2>你在寻找什么素材</h2>
                    <h3>我们的设计在获得更多转化方面有着良好的记录</h3>
                    <form method="get" class="search_ban" action="<?php bloginfo('url'); ?>">
                        <select name="post_type" class="search-select">
                            <option value="show">素材</option>
                            <option value="forum">社区</option>
                            <option value="post"> 文章</option>
                        </select>
                        <input type="text" name="s" class="search-input" autocomplete="off" placeholder="输入关键词">
                        <button class="btn-search">搜索</button>
                    </form>
                    <div class="search_other">
                        <span>推荐关注</span>
                        <?php
                        $menuParameters = array(
                        'echo' => false,
                        'items_wrap' => '%3$s',
                        'depth' => 0,
                        'theme_location'=>'hot_s',
                        );
                        echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>