<?php
// Template Name:	Event List
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column(get_the_ID());
$h = new unload_Helper();
$args = array(
    'post_type' => 'event',
    'post_status' => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
    'ignore_sticky_posts' => false,
);
$query = new WP_Query($args);
$column = $h->unload_column(get_the_ID());
unload_Media::unload_singleton()->unload_eq(array('map'));
$setLimti = ($column == 'col-md-8') ? 20 : 72;
?>
    <section class="block gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-sec">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <div class="top-margin event-page">
                                    <?php
                                    $counter = 0;
                                    while ($query->have_posts()):
                                        $query->the_post();
                                        $map = $h->unload_m('metaLocation');
                                        $share = array('facebook', 'twitter', 'linkedin');
                                        $evOrg = $h->unload_m('metaOrganiser');
                                        $evOrgPh = $h->unload_m('metaContact');
                                        $evOrgAdd = $h->unload_m('metaAddress');
                                        $evOrgAvt = $h->unload_m('metaavatar');
                                        $evStart = strtotime($h->unload_m('metaStartDate'));
                                        ?>
                                        <div class="blog-post">
                                            <div class="post-thumb post-thumb<?php echo esc_attr($counter); ?>">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail('unload_370x370');
                                                }
                                                if ($h->unload_set($map, 'address') != ''):
                                                    ?>
                                                    <span><i class="fa fa-map-marker"></i></span>
                                                    <div id="google_map<?php echo esc_attr($counter) ?>"
                                                         class="google-map"></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="post-info">
                                                <ul class="avatar">
                                                    <?php if (!empty($evOrgAvt)): ?>
                                                        <li>
														<span>
															<img src="<?php echo esc_url($evOrgAvt) ?>" alt=""/>
														</span>
                                                            <a href="javascript:void(0)"
                                                               title=""><?php echo esc_attr($evOrg) ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <div class="date2">
                                                            <i class="fa fa-calendar-o"></i>
                                                            <span><?php echo date('l ', $evStart) ?>-</span><a
                                                                href="javascript:void(0)"
                                                                title=""><?php echo date(' d M', $evStart) ?></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <h3><a href="<?php the_permalink() ?>"
                                                       title="<?php the_title() ?>"><?php the_title() ?></a></h3>
                                                <div class="location">
                                                    <?php if ($h->unload_set($map, 'address') != ''): ?><p><i
                                                        class="fa fa-map-marker"></i> <?php echo esc_html($h->unload_set($map, 'address')) ?>
                                                        </p><?php endif; ?>
                                                </div>
                                                <p><?php echo wp_trim_words(get_the_content(get_the_ID()), $setLimti, null) ?></p>
                                            </div>
                                        </div><!-- Blog Post -->
                                        <?php ob_start(); ?>
                                        jQuery(document).ready(function ($) {
                                        'use strict';

                                        $("div.post-thumb<?php echo esc_js($counter) ?> span").on("click", function () {
                                        $(this).parent("div.post-thumb").toggleClass("slide-down");
                                        return false;
                                        });

                                        function initialize<?php echo esc_js($counter) ?>() {
                                        var myLatlng = new google.maps.LatLng(<?php echo esc_js($h->unload_set($map, 'latitude')) ?>, <?php echo esc_js($h->unload_set($map, 'longitude')) ?>);
                                        var mapOptions = {
                                        zoom: 14,
                                        disableDefaultUI: true,
                                        scrollwheel: false,
                                        center: myLatlng
                                        }
                                        var map = new google.maps.Map(document.getElementById('google_map<?php echo esc_js($counter) ?>'), mapOptions);

                                        var image = '<?php echo unload_Uri ?>partial/images/icon.png';
                                        var myLatLng = new google.maps.LatLng(<?php echo esc_js($h->unload_set($map, 'latitude')) ?>, <?php echo esc_js($h->unload_set($map, 'longitude')) ?>);
                                        var beachMarker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map,
                                        icon: image
                                        });

                                        }
                                        google.maps.event.addDomListener(window, 'load', initialize<?php echo esc_js($counter) ?>);
                                        });
                                        <?php
                                        $jsOutput = ob_get_contents();
                                        ob_end_clean();
                                        wp_add_inline_script('unload-script', $jsOutput);
                                        $counter++;
                                    endwhile;
                                    wp_reset_postdata();
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
get_footer();
