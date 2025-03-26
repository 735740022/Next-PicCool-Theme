<?php get_header(); ?>
<?php include('section/index_banner.php') ?><!-- 大banner -->
<?php include('section/banner.php') ?><!-- 实际幻灯片 -->
</header>
<main>
<?php include('section/index_menu.php') ?><!-- 自定义入口 -->
<?php include('section/index_hot.php') ?><!-- 热门类目入口 -->
<?php include('section/index_show.php') ?><!-- 素材展示 -->
<?php include('section/index_article.php') ?><!-- 文章展示 -->
<?php include('section/index_forum.php') ?><!-- 社区聚合 -->
</main>
<?php get_footer(); ?>