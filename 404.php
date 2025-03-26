<?php get_header();?>
<style>
	.top{display: none;}
	.footer{display: none;}
</style>
<section class="login_bg account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-3 col-lg-5">
                <div class="login_box">
                    <div class="login_header">
                        <img src="<?php the_field('logo', 'option'); ?>" alt="">
                    </div>
                    <div class="login_describe">
                        <h3>404 PAGE NOT FOUND</h3>
                        <p>看起来你可能走错了方向</p>
                    </div>
                    <a class="go_back_for_404" href="<?php bloginfo('url'); ?>">返回首页</a>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="login_foot"><i class="bi bi-c-circle me-2"></i><?php bloginfo('name'); ?></footer>
<?php get_footer(); ?>