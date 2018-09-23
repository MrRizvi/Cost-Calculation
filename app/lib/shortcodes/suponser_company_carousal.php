<?php

class unload_suponser_company_carousal_VC_ShortCode extends unload_VC_ShortCode
{

    static public $counter = 0;

    public static function unload_suponser_company_carousal($atts = NULL)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Company Suponser Carousal", 'unload'),
                "base" => "unload_suponser_company_carousal_output",
                "icon" => 'suponser_company_carousal.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "attach_images",
                        "heading" => esc_html__('Images', 'unload'),
                        "param_name" => "images",
                        "description" => esc_html__("Upload images", 'unload')
                    )
                )
            );

            return apply_filters('unload_suponser_company_carousal_shortcode', $return);
        }
    }

    public static function unload_suponser_company_carousal_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('owl'));
        $siplitImages = explode(',', $images);
        if (!empty($siplitImages) && count($siplitImages) > 0) {
            echo '<ul class="partners" id="partners' . esc_attr(self::$counter) . '">';
            foreach ($siplitImages as $img) {
                $src = wp_get_attachment_image_src($img, 'full');
                ?>
                <li>
                    <a itemprop="url" href="javascript:void(0)" title="">
                        <img itemprop="image" src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt=""/>
                    </a>
                </li>
                <?php
            }
            echo '</ul>';
            ?>
            <?php ob_start();
            $opt = $H->unload_opt();
            $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false';
            ?>
            jQuery(document).ready(function ($) {
            "use strict";

            $("#partners<?php echo esc_js(self::$counter) ?>").owlCarousel({
            rtl: <?php echo esc_js($rtl) ?>,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 2000,
            loop: true,
            dots: false,
            nav: true,
            margin: 90,
            items: 5,
            singleItem: true,
            responsiveClass: true,
            responsive: {
            0: {
            items: 1
            },
            480: {
            items: 2
            },
            600: {
            items: 3
            },
            900: {
            items: 3
            },
            1200: {
            items: 5
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
