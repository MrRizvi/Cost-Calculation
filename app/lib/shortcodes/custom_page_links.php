<?php

class unload_custom_page_links_VC_ShortCode extends unload_VC_ShortCode
{

    static public $counter = 0;

    public static function unload_custom_page_links($atts = NULL)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Custom Page Links", 'unload'),
                "base" => "unload_custom_page_links_output",
                "icon" => 'unload_custom_page_links_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_pages_block_output'),
                "content_element" => TRUE,
                "show_settings_on_create" => TRUE,
                "is_container" => TRUE,
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Sub Title:", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
                )
            );

            return apply_filters('unload_custom_page_links_output', $return);
        }
    }

    public static function unload_custom_page_links_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('owl'));
        ?>
        <div class="row">
            <div class="col-md-3">
                <div class="column-title">
                    <span><?php echo esc_html($subtitle) ?></span>
                    <h2><?php echo esc_html($title) ?></h2>
                    <p><?php echo esc_html($desc) ?></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="modern-services-carousel style2 checkCar<?php echo self::$counter ?>"
                     id="modern-services-carousel<?php echo esc_attr(self::$counter) ?>">
                    <?php echo wp_kses_post($content) ?>
                </div>
            </div>
        </div>
        <?php ob_start();
        $opt = $H->unload_opt();
        $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false'; ?>
        jQuery(document).ready(function ($) {
        "use strict";
        var loop = '';
        var carousalLen = $(".checkCar<?php echo self::$counter ?> div").length;

        if (carousalLen > 1) {
        loop = true;
        } else {
        loop = false;
        }

        $("#modern-services-carousel<?php echo esc_js(self::$counter) ?>").owlCarousel({
        rtl: <?php echo esc_js($rtl) ?>,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 2000,
        loop: loop,
        dots: false,
        nav: true,
        margin: 30,
        items: 3,
        responsiveClass: true,
        responsive: {
        1200: {items: 3},
        980: {items: 2},
        480: {items: 2},
        0: {items: 1}
        }
        });
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-owl', $jsOutput);

        self::$counter++;
        $output = ob_get_contents();
        ob_clean();

        return do_shortcode($output);
    }

}
