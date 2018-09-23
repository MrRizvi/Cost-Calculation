<?php
(new unload_Helper())->unload_header();
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $column = (new unload_Helper())->unload_column(get_the_ID());
    $h = new unload_Helper();
    $map = $h->unload_m('metaLocation');
    $share = array('facebook', 'twitter', 'linkedin');
    $evOrg = $h->unload_m('metaOrganiser');
    $evOrgPh = $h->unload_m('metaContact');
    $evOrgAdd = $h->unload_m('metaAddress');
    $evOrgAvt = $h->unload_m('metaavatar');
    unload_Media::unload_singleton()->unload_eq(array('map'));
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin blog-detail-main">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <div class="news-thumb post-thumb">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('unload_1170x593');
                                    }
                                    if ($h->unload_set($map, 'address') != ''):
                                        ?>
                                        <span><i class="fa fa-map-marker"></i></span>
                                        <div id="google_map" class="google-map"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="news-detail">
                                    <h1 itemprop="headline"><?php the_title() ?></h1>
                                    <div class="detail-info2">
                                        <div class="detail-infodiv1 detail-com">
                                            <ul class="post-meta2">
                                                <li><i class="fa fa-user"></i><?php esc_html_e('By ', 'unload') ?> <a
                                                        itemprop="url" title=""
                                                        href="<?php esc_url($h->unload_authorLink()) ?>"><?php ucfirst(the_author()) ?></a>
                                                </li>
                                                <li><i class="fa fa-comment-o"></i><a itemprop="url" title=""
                                                                                      href="javascript:void(0)"><?php echo esc_html($h->unload_comments(get_the_ID())) ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-infodiv2 detail-com">
                                            <?php if ($h->unload_set($map, 'address') != ''): ?>
                                                <p>
                                                    <i class="fa fa-map-marker"></i> <?php echo esc_html($h->unload_set($map, 'address')); ?>
                                                </p>
                                            <?php endif; ?>
                                            <div class="share-it">
                                                <span><?php esc_html_e('Share This Event', 'unload') ?>:</span>
                                                <?php if (!empty($share) && count($share) > 0): ?>
                                                    <ul>
                                                        <?php $h->unlod_socialShare($share, false, false, true) ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($evOrg) || !empty($evOrgPh) || !empty($evOrgAdd) || !empty($evOrgAvt)): ?>
                                            <div class="orgnaizer-info detail-com">
                                                <ul class="">
                                                    <?php if (!empty($evOrg)): ?>
                                                        <li>
                                                        <strong><?php echo esc_html_e('Event Organiser', 'unload') ?>
                                                            :</strong> <span><i class="fa fa-user"></i> <a
                                                                href="javascript:void(0)"
                                                                title=""><?php echo esc_html($evOrg) ?></a></span>
                                                        </li><?php endif; ?>
                                                    <?php if (!empty($evOrgPh)): ?>
                                                        <li>
                                                        <strong><?php echo esc_html_e('Organiser Phone', 'unload') ?>
                                                            :</strong> <span><i
                                                                class="fa fa-phone"></i> <?php echo esc_html($evOrgPh) ?></span>
                                                        </li><?php endif; ?>
                                                    <?php if (!empty($evOrgAdd)): ?>
                                                        <li>
                                                        <strong><?php echo esc_html_e('Organiser Address', 'unload') ?>
                                                            :</strong> <span><i
                                                                class="fa fa-map-marker"></i> <?php echo esc_html($evOrgAdd) ?></span>
                                                        </li><?php endif; ?>
                                                </ul>
                                                <?php if (!empty($evOrgAvt)): ?><span class="organiser-thumb"><img
                                                        src="<?php echo esc_url($evOrgAvt) ?>" alt=""/>
                                                    </span><?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                                <?php
                                if (comments_open() || get_comments_number(get_the_ID())) :
                                    comments_template();
                                endif;
                                ?>
                            </div>
                            <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php ob_start(); ?>
    jQuery(document).ready(function ($) {
    'use strict';

    $(".post-thumb > span").on("click", function () {
    $(this).parent("div").toggleClass("slide-down");
    return false;
    });

    function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo esc_js($h->unload_set($map, 'latitude')) ?>, <?php echo esc_js($h->unload_set($map, 'longitude')) ?>);
    var mapOptions = {
    zoom: 14,
    disableDefaultUI: true,
    scrollwheel: false,
    center: myLatlng
    }
    var map = new google.maps.Map(document.getElementById('google_map'), mapOptions);

    var image = '<?php echo unload_Uri ?>partial/images/icon.png';
    var myLatLng = new google.maps.LatLng(<?php echo esc_js($h->unload_set($map, 'latitude')) ?>, <?php echo esc_js($h->unload_set($map, 'longitude')) ?>);
    var beachMarker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    icon: image
    });

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    });
    <?php
    $jsOutput = ob_get_contents();
    ob_end_clean();
    wp_add_inline_script('unload-map', $jsOutput);
}
get_footer();
