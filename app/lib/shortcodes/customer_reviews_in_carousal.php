<?php

class unload_customer_reviews_in_carousal_VC_ShortCode extends unload_VC_ShortCode
{

    static public $counter = 0;

    public static function unload_customer_reviews_in_carousal($atts = NULL)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Customer Reviews In Carousal", 'unload'),
                "base" => "unload_customer_reviews_in_carousal_output",
                "icon" => 'customer_reviews_in_carousal.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "multiselect",
                        "heading" => esc_html__("Select Reviews:", 'unload'),
                        "param_name" => "reviews",
                        "description" => esc_html__("Select reviews to show.", 'unload'),
                        "value" => (new unload_Helper)->unload_posts('testimonial')
                    ),
                )
            );

            return apply_filters('unload_customer_reviews_in_carousal_shortcode', $return);
        }
    }

    public static function unload_customer_reviews_in_carousal_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('owl'));
        $args = array(
            'post_type' => 'testimonial',
            'post_status' => 'publish',
            'showposts' => -1,
            'post__in' => explode(',', $reviews)
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $counter = 0;
            ?>
            <div class="customers-reviews">
                <div class="customers-review-carousel"
                     id="customers-review-carousel<?php echo esc_attr(self::$counter) ?>">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <div class="review-area">
                            <div class="customer-thumb">
                                <?php the_post_thumbnail(get_post_thumbnail_id(get_the_ID()), 'thumbnail'); ?>
                            </div>
                            <div class="customer-detail">
                                <p itemprop="description">
									<span>
										<i class="fa fa-quote-left"></i>
									</span>
                                    <?php echo get_the_content(get_the_ID()) ?>
                                </p>
                                <div class="customer-info">
                                    <h4><?php the_title() ?></h4>
                                    <h5><?php esc_html_e('CUSTOMER REVIEWS', 'unload') ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                    wp_reset_postdata();
                    $loop = ($counter > 1) ? 'true' : 'false';
                    ?>
                </div>
            </div>
            <?php ob_start();
            $opt = $H->unload_opt();
            $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false';
            ?>
            jQuery(document).ready(function ($) {
            "use strict";

            $("#customers-review-carousel<?php echo esc_js(self::$counter) ?>").owlCarousel({
            rtl: <?php echo esc_js($rtl) ?>,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 2000,
            loop: <?php echo esc_js($loop) ?>,
            dots: false,
            nav: true,
            margin: 0,
            items: 1,
            singleItem: true,
            responsiveClass: true,
            responsive: {
            0: {
            nav: false
            },
            900: {
            nav: true
            }
            }
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-owl', $jsOutput);
        }
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

}
