<?php
(new unload_Helper())->unload_header();
$h = new unload_Helper();
$template = $h->unloadTpl('tpl-booking.php');
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $column = (new unload_Helper())->unload_column(get_the_ID());
    $h = new unload_Helper();
    unload_Media::unload_singleton()->unload_eq(array('bootstrap'));
    $time = $h->unload_m('metaDeliveryTime');
    $keyFeatures = $h->unload_m('metaKeyFeatures');
    $gallery = array_keys($h->unload_m('metaGallery'));
    $column = $h->unload_column(get_the_ID());
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin packages-details-main">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <div id="package-details-tabs">
                                    <?php
                                    if (count($gallery) > 0):
                                        $imgCounter = 0;
                                        ?>
                                        <div class="tab-content">
                                            <?php
                                            foreach ($gallery as $g):
                                                $src = wp_get_attachment_image_src($g, 'unload_1170x593');
                                                $active = ($imgCounter == 0) ? 'active' : '';
                                                ?>
                                                <div role="tabpanel"
                                                     class="tab-pane fade in <?php echo esc_attr($active) ?>"
                                                     id="package<?php echo esc_attr($imgCounter) ?>">
                                                    <div class="our-packages packages-detail">
                                                        <div class="packages-thumb">
                                                            <img itemprop="image"
                                                                 src="<?php echo esc_url($h->unload_set($src, '0')) ?>"
                                                                 alt=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $imgCounter++;
                                            endforeach;
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="packages-info">
                                        <?php if (!empty($time)): ?>
                                            <span><?php esc_html_e('Delivery Within ', 'unload') ?><?php echo esc_html($time) ?></span><?php endif; ?>
                                        <h2 itemprop="name"><?php the_title() ?></h2>
                                        <a href="<?php echo esc_url($template) ?>" itemprop="url" class="theme-btn" title="">
                                            <i class="fa fa-paper-plane"></i><?php esc_html__('ORDER NOW', 'unload') ?>
                                        </a>
                                        <?php if (count($keyFeatures) > 0): ?>
                                            <ul class="features">
                                                <?php foreach ($keyFeatures as $k): ?>
                                                    <li><?php echo esc_html($k) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                        <?php
                                        if (count($gallery) > 0):
                                            $imgCounter2 = 0;
                                            ?>
                                            <ul class="nav nav-tabs" role="tablist">
                                                <?php
                                                foreach ($gallery as $g):
                                                    $src = wp_get_attachment_image_src($g, 'unload_370x370');
                                                    $active = ($imgCounter2 == 0) ? 'class=active' : '';
                                                    ?>
                                                    <li role="presentation" <?php echo esc_attr($active) ?>>
                                                        <a href="#package<?php echo esc_attr($imgCounter2) ?>"
                                                           aria-controls="package<?php echo esc_attr($imgCounter2) ?>"
                                                           role="tab" data-toggle="tab">
                                                            <img src="<?php echo esc_url($h->unload_set($src, '0')) ?>"
                                                                 alt="" itemprop="image"/>
                                                            <i>+</i>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $imgCounter2++;
                                                endforeach;
                                                ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <div class="desc"><?php the_content() ?></div>
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
