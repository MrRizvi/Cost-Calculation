<?php
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column('', 'optTagLayout', 'optTagSidebar');
$h = new unload_Helper();
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin blog-detail-main">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar('', 'optTagLayout', 'optTagSidebar') ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <?php
                                get_template_part('blog-content');
                                ?>
                            </div>
                            <?php $h->unload_themeRightSidebar('', 'optTagLayout', 'optTagSidebar') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
get_footer();
