<?php

class unload_fixed_text_slider_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_fixed_text_slider($atts = NULL)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Fixed Text Slider", 'unload'),
                "base" => "unload_fixed_text_slider_output",
                "icon" => 'fixed_text_slider.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Logo:", 'unload'),
                        "param_name" => "logo",
                        "description" => esc_html__("Upload Logo.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for slider.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the button text for slider.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
                    array(
                        "type" => "attach_images",
                        "heading" => esc_html__("Slider Images:", 'unload'),
                        "param_name" => "slider",
                        "description" => esc_html__("Upload slider Images.", 'unload')
                    ),
                )
            );

            return apply_filters('unload_fixed_text_slider_shortcode', $return);
        }
    }

    public static function unload_fixed_text_slider_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('owl'));
        $siplitSlider = explode(',', $slider);
        $loop = (count($siplitSlider) > 1) ? 'true' : 'false';
        if (!empty($siplitSlider) && count($siplitSlider) > 0):
            $logoSrc = (!empty($logo)) ? wp_get_attachment_url($logo) : '';
            ?>
            <div class="main-carousel overlape">
                <div class="main-img-carousel" id="main-img-carousel">
                    <?php
                    foreach ($siplitSlider as $img):
                        $src = wp_get_attachment_image_src($img, 'full');
                        ?>
                        <div class="carousel-img">
                            <img src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt=""/>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="main-carousel-cap">
                    <?php if (!empty($logo)): ?>
                        <span><img src="<?php echo esc_url($logoSrc) ?>" alt=""/></span>
                    <?php endif; ?>
                    <h1><?php echo esc_html($title) ?></h1>
                    <h5><?php echo esc_html($btn) ?></h5>
                    <p><?php echo wp_kses_post($desc) ?></p>
                </div><!-- Main Carousel Cap -->
            </div>
            <?php
            ob_start();
            $opt = $H->unload_opt();
            $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false';
            ?>
            jQuery(document).ready(function ($) {
            "use strict";

            $("#main-img-carousel").owlCarousel({
            rtl: <?php echo esc_js($rtl) ?>,
            autoplay: true,
            autoplayTimeout: 2000,
            smartSpeed: 1500,
            loop: <?php echo esc_js($loop) ?>,
            dots: false,
            nav: false,
            margin: 10,
            items: 1,
            singleItem: true,
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-owl', $jsOutput);
        endif;
        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

}
