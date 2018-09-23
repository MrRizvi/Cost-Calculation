<?php
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column('', 'optCategoryLayout', 'optCategorySidebar');
$h = new unload_Helper();
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin blog-detail-main">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar('', 'optCategoryLayout', 'optCategorySidebar') ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <?php
                                get_template_part('blog-content');
                                ?>
                            </div>
                            <?php $h->unload_themeRightSidebar('', 'optCategoryLayout', 'optCategorySidebar') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
get_footer();
