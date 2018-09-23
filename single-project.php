<?php
(new unload_Helper())->unload_header();
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $column = (new unload_Helper())->unload_column(get_the_ID());
    $h = new unload_Helper();
    $contentImg = $h->unload_m('metaProjectPostImg');
    $subTitle = $h->unload_m('metaProjectSubTitle');
    $perPack = $h->unload_m('metaPerPack');
    $time = $h->unload_m('metaDeliveryTime');
    $date = $h->unload_m('metaDeliveryDate');
    $deliverBy = $h->unload_m('metaService');
    $fromAddress = $h->unload_m('metaFromAddress');
    $toAddress = $h->unload_m('metatoAddress');
    $refNo = $h->unload_m('metaRefNub');
    $column = $h->unload_column(get_the_ID());
    $contentCol = (!empty($contentImg)) ? 'col-md-8' : 'col-md-12';
    $bottom = $h->unload_m('metaPAD');
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="project-detail-main">
                        <div class="project-detail-img">
                            <?php
                            if (has_post_thumbnail()):
                                the_post_thumbnail('unload_1170x593');
                            endif;
                            ?>
                            <?php if (!empty($refNo)): ?><strong><?php esc_html_e('Ref No', 'unload'); ?>
                                : <?php echo esc_html($refNo) ?></strong><?php endif; ?>
                            <div class="project-info">
                                <div class="title2">
                                    <span><?php echo esc_html($subTitle) ?></span>
                                    <h2><?php the_title() ?></h2>
                                </div>
                                <div class="pack-info">
                                    <?php if (!empty($perPack)): ?><strong>$<?php echo esc_attr($perPack) ?>
                                        <i><?php esc_html_e('Per Pack', 'unload') ?></i></strong><?php endif; ?>
                                    <?php if (!empty($time)): ?><span><?php esc_html_e('Delivery With In', 'unload') ?>
                                        <i><?php echo esc_html($time) ?></i></span><?php endif; ?>
                                </div>
                                <?php if (!empty($date) || !empty($deliverBy) || !empty($fromAddress) || !empty($toAddress)): ?>
                                    <ul class="delivered-info">
                                        <?php if (!empty($date)): ?>
                                            <li>
                                                <strong><?php esc_html_e('Delivery Date', 'unload') ?>:</strong>
                                                <span>Monday - 04 May 2016</span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($deliverBy)): ?>
                                            <li>
                                                <strong><?php esc_html_e('Delivered By', 'unload') ?>:</strong>
                                                <i><?php echo esc_html($deliverBy) ?></i>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($fromAddress)): ?>
                                            <li>
                                                <strong><?php esc_html_e('From', 'unload') ?>:</strong>
                                                <span><?php echo esc_html($fromAddress) ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($toAddress)): ?>
                                            <li>
                                                <strong><?php esc_html_e('To', 'unload') ?>:</strong>
                                                <span><?php echo esc_html($toAddress) ?></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="project-desc">
                        <div class="row">
                            <div class="<?php echo esc_attr($contentCol) ?>">
                                <?php the_content() ?>
                            </div>
                            <?php if ($contentCol == 'col-md-8'): ?>
                                <div class="col-md-4">
                                    <img src="<?php echo esc_url($contentImg) ?>" alt=""/>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    if ($bottom == 'on'):
                        unload_Media::unload_singleton()->unload_eq(array('owl'));
                        $gallery = array_keys($h->unload_m('metaPADGallery'));
                        $isGallery = (count($gallery) > 0) ? 'col-md-6' : 'col-md-12';
                        $PTitle = $h->unload_m('metaPADTitle');
                        $PSubTitle = $h->unload_m('metaPADSubTitle');
                        $PNote = $h->unload_m('metaPADShortNote');
                        $bottomContent = $h->unload_m('metaPADBottomContent');
                        $keyFeatures = $h->unload_m('metaPADKeyFeatures');
                        ?>
                        <div class="project-overview">
                            <div class="row">
                                <?php if (count($gallery) > 0): ?>
                                    <div class="col-md-6">
                                        <div class="project-overview-carousel" id="project-overview-carousel">
                                            <?php
                                            $loop = (count($gallery) > 0) ? 'true' : 'false';
                                            foreach ($gallery as $gal):
                                                $src = wp_get_attachment_image_src($gal, 'unload_340x378');
                                                ?>
                                                <div class="project-overview-thumb">
                                                    <img src="<?php echo esc_url($h->unload_set($src, '0')) ?>" alt=""/>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php ob_start();
                                    $rtl = ($h->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false';
                                    ?>
                                    jQuery(document).ready(function ($) {
                                    'use strict';
                                    $("#project-overview-carousel").owlCarousel({
                                    rtl: <?php echo esc_js($rtl) ?>,
                                    autoplay: true,
                                    autoplayTimeout: 3000,
                                    smartSpeed: 2000,
                                    loop: <?php echo esc_js($loop) ?>,
                                    dots: false,
                                    nav: true,
                                    margin: 10,
                                    items: 1,
                                    singleItem: true
                                    });

                                    });
                                    <?php
                                    $jsOutput = ob_get_contents();
                                    ob_end_clean();
                                    wp_add_inline_script('unload-owl', $jsOutput);
                                endif;
                                ?>
                                <div class="<?php echo esc_attr($isGallery) ?>">
                                    <div class="project-overview-detail">
                                        <div class="title2">
                                            <span><?php echo esc_html($PSubTitle) ?> </span>
                                            <?php if (!empty($PTitle)): ?> <h2> <i
                                                class="fa fa-paint-brush"> </i> <?php echo esc_html($PTitle) ?>
                                                </h2><?php endif; ?>
                                        </div>
                                        <p><?php echo esc_html($PNote) ?> </p>
                                        <?php if (count($keyFeatures) > 0): ?>
                                            <ul class="company-values">
                                                <?php foreach ($keyFeatures as $f): ?>
                                                    <li><?php echo esc_html($f) ?> </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo wpautop($bottomContent) ?>
                        </div>
                    <?php endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

get_footer();
