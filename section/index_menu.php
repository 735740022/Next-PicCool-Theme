<?php if(get_field('index_menu_diy', 'option')): ?>
<section class="index_tok sjbxs">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-4">
            <?php while ( have_rows('index_menu_diy', 'option') ) : the_row(); ?>
            <div class="col">
                <div class="index_tok_box">
                    <h2 class="index_tok_name">
                        <?php the_sub_field('tb', 'option'); ?>
                        <?php the_sub_field('bt', 'option'); ?>
                    </h2>
                    <?php the_sub_field('links', 'option'); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>