<?php
(new unload_Helper())->unload_header();
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $column = (new unload_Helper())->unload_column(get_the_ID());
    $h = new unload_Helper();
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin blog-detail-main">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <div class="page-contents">
                                    <?php
                                    the_content();
                                    if (comments_open() || get_comments_number(get_the_ID())) :
                                        comments_template();
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
get_footer();
