<?php

class unload_company_events_with_carousal_VC_ShortCode extends unload_VC_ShortCode
{

    static public $counter = 0;

    public static function unload_company_events_with_carousal($atts = NULL)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Company Events With Carousal", 'unload'),
                "base" => "unload_company_events_with_carousal_output",
                "icon" => 'company_events_with_carousal.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__('Number of Posts', 'unload'),
                        "param_name" => "number",
                        'min' => '1',
                        'max' => '4',
                        'step' => '1',
                        "description" => esc_html__('Enter the number of posts to show', 'unload')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__('Order', 'unload'),
                        "param_name" => "order",
                        "value" => array(
                            esc_html__('Ascending', 'unload') => 'ASC',
                            esc_html__('Descending', 'unload') => 'DESC'
                        ),
                        "description" => esc_html__("Select sorting order ascending or descending for posts listing", 'unload')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Order By", 'unload'),
                        "param_name" => "orderby",
                        "value" => array_flip(array(
                            'date' => esc_html__('Date', 'unload'),
                            'title' => esc_html__('Title', 'unload'),
                            'name' => esc_html__('Name', 'unload'),
                            'author' => esc_html__('Author', 'unload'),
                            'comment_count' => esc_html__('Comment Count', 'unload'),
                            'random' => esc_html__('Random', 'unload')
                        )),
                        "description" => esc_html__("Select order by method for posts listing", 'unload')
                    )
                )
            );

            return apply_filters('unload_company_events_with_carousal_shortcode', $return);
        }
    }

    public static function unload_company_events_with_carousal_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('map', 'owl'));
        $args = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $counter = 0;
            ?>
            <div class="blog-post-carousel" id="blog-post-carousel<?php echo esc_attr(self::$counter) ?>">
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                $map = $H->unload_m('metaLocation');
                $share = array('facebook', 'twitter', 'linkedin');
                $evOrg = $H->unload_m('metaOrganiser');
                $evOrgPh = $H->unload_m('metaContact');
                $evOrgAdd = $H->unload_m('metaAddress');
                $evOrgAvt = $H->unload_m('metaavatar');
                $evStart = strtotime($H->unload_m('metaStartDate'));
                ?>
                <div class="blog-post">
                    <div id="post-thumb<?php echo esc_attr($counter) ?>" class="post-thumb">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('unload_370x370');
                        }
                        if ($H->unload_set($map, 'address') != ''):
                            ?>
                            <span><i class="fa fa-map-marker"></i></span>
                            <div id="google_map<?php echo esc_attr($counter) ?>" class="google-map"></div>
                        <?php endif; ?>
                    </div>
                    <div class="post-info">
                        <ul class="avatar">
                            <?php if (!empty($evOrgAvt)): ?>
                                <li>
										<span>
											<img width="39" height="39" src="<?php echo esc_url($evOrgAvt) ?>" alt=""/>
										</span>
                                    <a href="javascript:void(0)" title=""><?php echo esc_attr($evOrg) ?></a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <div class="date2">
                                    <i class="fa fa-calendar-o"></i>
                                    <span><?php echo date('l ', $evStart) ?>-</span><a href="javascript:void(0)"
                                                                                       title=""><?php echo date(' d M', $evStart) ?></a>
                                </div>
                            </li>
                        </ul>
                        <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
                        </h3>
                        <div class="location">
                            <?php if ($H->unload_set($map, 'address') != ''): ?><p><i
                                class="fa fa-map-marker"></i> <?php echo esc_html($H->unload_set($map, 'address')) ?>
                                </p><?php endif; ?>
                        </div>
                        <p><?php echo wp_trim_words(get_the_content(get_the_ID()), 20, NULL) ?></p>
                    </div>
                </div>
                <?php
                $counter++;
            }
            wp_reset_postdata();
        }
        ?>
        </div>
        <?php
        if ($query->have_posts()) {
            $counterMap = 0;
            while ($query->have_posts()) {
                $query->the_post();
                $map = $H->unload_m('metaLocation');
                if ($H->unload_set($map, 'latitude') != '' && $H->unload_set($map, 'longitude') != '') {
                    ob_start();
                    ?>
                    jQuery(document).ready(function ($) {
                    'use strict';

                    $("#post-thumb<?php echo esc_js($counterMap) ?> > span").live("click", function () {
                    $(this).parent("div").toggleClass("slide-down");
                    return false;
                    });

                    function initialize<?php echo esc_js($counterMap) ?>() {
                    var myLatlng = new google.maps.LatLng(<?php echo esc_js($H->unload_set($map, 'latitude')) ?>, <?php echo esc_js($H->unload_set($map, 'longitude')) ?>);
                    var mapOptions = {
                    zoom: 14,
                    disableDefaultUI: true,
                    scrollwheel: false,
                    center: myLatlng
                    }
                    var map = new google.maps.Map(document.getElementById('google_map<?php echo esc_js($counterMap) ?>'), mapOptions);

                    var image = '<?php echo unload_Uri ?>partial/images/icon.png';
                    var myLatLng = new google.maps.LatLng(<?php echo esc_js($H->unload_set($map, 'latitude')) ?>, <?php echo esc_js($H->unload_set($map, 'longitude')) ?>);
                    var beachMarker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: image
                    });
                    }
                    google.maps.event.addDomListener(window, 'load', initialize<?php echo esc_js($counterMap) ?>);
                    });
                    <?php
                    $jsOutput = ob_get_contents();
                    ob_end_clean();
                    wp_add_inline_script('unload-map', $jsOutput);
                }
                $counterMap++;
            }
            wp_reset_postdata();
        }
        //$loop = ($counter > 1) ? 'true' : 'false';
        ob_start();
        $opt = $H->unload_opt();
        $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false';
        ?>
        jQuery(document).ready(function ($) {
        'use strict';

        $("#blog-post-carousel<?php echo esc_js(self::$counter) ?>").owlCarousel({
        rtl: <?php echo esc_js($rtl) ?>,
        autoplay: false,
        autoplayTimeout: 3000,
        smartSpeed: 2000,
        loop: false,
        dots: false,
        nav: true,
        margin: 10,
        items: 1,
        singleItem: true,
        });
        });
        <?php
        $jsOutput2 = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-owl', $jsOutput2);

        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

}
