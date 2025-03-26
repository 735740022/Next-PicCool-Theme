<?php

if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {

    global $wpdb;

    $last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");

    if ( (date_i18n('U') - strtotime($last_post)) < 20 ) {
        echo "<script>alert('您投稿也太勤快了吧，先歇会儿！')</script>";
    }

    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
    $category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
    $content =  isset( $_POST['tougao_content'] ) ? trim($_POST['tougao_content']) : '';


    if ( empty($title) || mb_strlen($title) > 100 ) {
        echo "<script>alert('标题必须填写，且长度不得超过100字。')</script>";
    }

    if ( empty($content) || mb_strlen($content) > 99999 || mb_strlen($content) < 30) {
        echo "<script>alert('内容必须填写，且长度不得超过5000字，不得少于50字。')</script>";
    }

    $post_content = $content;

    $tougao = array(
        'post_title' => $title,
        'post_content' => $post_content,
        'post_category' => array($category)
    );


    // 将文章插入数据库
    $status = wp_insert_post( $tougao );

    if ($status != 0) {

        // 投稿成功邮件提醒
        $email   = get_field('tougao_mail', 'option');
        $subject = get_field('tougao_title', 'option');
        $message = get_field('tougao_message', 'option');
        wp_mail($email, $subject, $message);

        echo "<script>alert('发布成功，等待通过。')</script>";
    }
    else {
        echo "<script>alert('投稿失败！')</script>";
    }
}

?>


 <?php if ( current_user_can('level_0') ){ ?>

    <form class="ludou-tougao" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; $current_user = wp_get_current_user(); ?>">

        <div class="tougao_section tougao_head">

            <h3 class="tougao_box_name">发布内容</h3>

            <div class="tougao_label">
                <label for="tougao_title">标题</label>
                <input type="text" size="40" value="" id="tougao_title" name="tougao_title" />
            </div>

            <div class="post-area">
                <?php
                    $content = '';
                    $editor_id = 'tougao_content';
                    $settings = array(
                        'media_buttons' => true,
                        'textarea_rows' => 10,
                        'quicktags'     => false,
                    );
                    wp_editor( $content, $editor_id, $settings );
                ?>
            </div>

        </div>

        <div class="tougao_section tougao_foot">

            <h3 class="tougao_box_name">发布设置</h3>

            <div class="tougao_radio">
                <h4>选择分类</h4>
                <?php
                $args=array(
                'hide_empty'    => 0,
                'orderby'       => 'name',
                'order'         => 'ASC'
                );
                $categories=get_categories($args);
                foreach($categories as $category) { ?>
                    <div class="form-check">
                      <input type="radio" name="cat" id="formcat_<?php echo $category->term_id ?>" value="<?php echo $category->term_id ?>">
                      <label for="formcat_<?php echo $category->term_id ?>"><?php echo $category->name ?></label>
                    </div>
                <?php } ?>
            </div>

        </div>

        <div class="tougao_submit">
            <input type="hidden" value="send" name="tougao_form" />
            <input type="submit" value="提交发布" class="tougao_submit_button" />
            <button type="button" class="tougao_shenming" data-bs-toggle="modal" data-bs-target="#tougao_shenming_box">投稿申明</button>
        </div>

    </form>

<?php } else { ?>

<script>alert('提示：您需要登录，才能投稿！');window.location.replace("<?php the_field('login_url', 'option'); ?>");</script>

<?php } ?>