<?php
$h = new unload_Helper;
$h->unload_header();
$template = $h->unloadTpl('tpl-booking.php');
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $column = (new unload_Helper())->unload_column(get_the_ID());
    $h = new unload_Helper();
    unload_Media::unload_singleton()->unload_eq(array('bootstrap', 'circliful'));
    $list = $h->unload_m('metaServiceList');
    $listTitle = $h->unload_m('metaListTitle');
    $listSubTitle = $h->unload_m('metaListSubTitle');
    $subTitle = $h->unload_m('metaServiceSubTitle');
    $shortNote = $h->unload_m('metaShortNote');
    $time = $h->unload_m('metaDeliveryTime');
    $mail = $h->unload_m('metaEmailId');
    $address = $h->unload_m('metaOfficeAddress');
    $satisfication = $h->unload_m('metaSatisfideUser');
    $innerCol = (!empty($list)) ? 'col-md-8' : 'col-md-12';
    $column = $h->unload_column(get_the_ID());
    $custombookingurl = $h->unload_m('metacustombookingurl');
    $url = $h->unloadTpl('tpl-booking.php');
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                <div class="<?php echo esc_attr($column) ?>">
                    <div class="row">
                        <?php if ($list == 'on'): ?>
                            <div class="col-md-4">
                                <div class="services-menu">
                                    <div class="heading2">
                                        <span><?php echo esc_html($listSubTitle) ?></span>
                                        <h2><?php echo esc_html($listTitle) ?></h2>
                                    </div>
                                    <?php
                                    $args = array(
                                        'post_type' => 'service',
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'ignore_sticky_posts' => false,
                                    );
                                    $query = new WP_Query($args);
                                    if ($query->have_posts()):
                                        ?>
                                        <ul>
                                            <?php
                                            while ($query->have_posts()):
                                                $query->the_post();
                                                echo '<li><a href="' . get_the_permalink(get_the_ID()) . '" title="' . get_the_title(get_the_ID()) . '" itemprop="url">' . get_the_title(get_the_ID()) . '</a></li>';
                                            endwhile;
                                            wp_reset_postdata();
                                            ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="<?php echo esc_attr($innerCol) ?>">
                            <div class="services-details">
                                <div class="service-detail-post">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="services-thumb">
                                            <?php the_post_thumbnail('unload_1170x593') ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="services-info">
                                        <h2 itemprop="name"><?php the_title() ?></h2>
                                        <span><?php echo esc_html($subTitle) ?></span>
                                    </div>
                                </div>
                            </div><!-- Services Details -->
                            <div id="services-detail-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#description"
                                                                              aria-controls="description" role="tab"
                                                                              data-toggle="tab"><?php esc_html_e('Description', 'unload') ?></a>
                                    </li>
                                    <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab"
                                                               data-toggle="tab"><?php esc_html_e('Comments', 'unload') ?></a>
                                    </li>
                                    <li role="presentation"><a href="#chart" aria-controls="chart" role="tab"
                                                               data-toggle="tab"><?php esc_html_e('Chart', 'unload') ?></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="description">
                                        <div class="services-tabs-content">
                                            <?php the_content() ?>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="reviews">
                                        <div class="services-tabs-content comment-main">
                                            <?php
                                            if (comments_open() || get_comments_number(get_the_ID())) :
                                                comments_template();
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="chart">
                                        <div class="services-tabs-content">
                                            <p itemprop="description"><?php echo esc_html($shortNote) ?></p>
                                            <div class="chart-detail">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="chart-rating">
                                                            <div id="rating-chart" data-startdegree="60"
                                                                 data-dimension="250"
                                                                 data-text="<?php echo esc_attr($satisfication) ?>%"
                                                                 data-info="<?php esc_html_e('Satisfide Users', 'unload') ?>"
                                                                 data-width="7" data-fontsize="30"
                                                                 data-percent="<?php echo esc_attr($satisfication) ?>"
                                                                 data-fgcolor="#f5b120" data-bgcolor="#ededed"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="address-book">
                                                            <?php if (!empty($time) || !empty($mail) || !empty($address)): ?>
                                                                <ul>
                                                                    <?php if (!empty($time)): ?>
                                                                        <li><span><?php esc_html_e('Time', 'unload') ?>
                                                                            :</span> <?php echo esc_html($time) ?>
                                                                        </li><?php endif; ?>
                                                                    <?php if (!empty($mail)): ?>
                                                                        <li>
                                                                        <span><?php esc_html_e('Email Id', 'unload') ?>
                                                                            :</span> <?php echo esc_html($mail) ?>
                                                                        </li><?php endif; ?>
                                                                    <?php if (!empty($address)): ?>
                                                                        <li>
                                                                        <span><?php esc_html_e('Office Address', 'unload') ?>
                                                                            :</span> <?php echo esc_html($address) ?>
                                                                        </li><?php endif; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                            <a class="theme-btn" href="<?php
                                                            if($custombookingurl != ''){
                                                                echo esc_url($custombookingurl);
                                                            } else {
                                                                echo esc_url($url);
                                                            }
                                                            ?>"
                                                               itemprop="url" title=""><i
                                                                    class="fa fa-paper-plane"></i><?php esc_html_e('Book Now', 'unload') ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Services Detail Tabs -->
                        </div>
                    </div>
                </div>
                <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
            </div>
        </div>
    </section>

    <?php ob_start(); ?>
    jQuery(document).ready(function ($) {
    "use strict";
    $('#rating-chart').circliful();
    });
    <?php
    $jsOutput = ob_get_contents();
    ob_end_clean();
    wp_add_inline_script('unload-circliful', $jsOutput);
}

get_footer();
