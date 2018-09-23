<?php

class unload_statistics_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_statistics($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Statistics", 'unload'),
                "base" => "unload_statistics_output",
                "icon" => 'unload_statistics_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_statistics_block_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style:", 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Dark', 'unload') => 'zero-counters blackish',
                            esc_html__('Gray', 'unload') => 'services1 zero-counters2',
                            esc_html__('Simple', 'unload') => 'zero-counters3',
                            esc_html__('Fancy', 'unload') => 'zero-counters4',
                        ),
                        "description" => esc_html__("Select the style of the statistics.", 'unload')
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Parrallax Image:", 'unload'),
                        "param_name" => "bgImg",
                        "description" => esc_html__("Upload image for this style.", 'unload'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('zero-counters blackish'),
                        ),
                    )
                )
            );
            return apply_filters('unload_statistics_output', $return);
        }
    }

    public static function unload_statistics_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('counter', 'waypoints'));
        ?>
        <div class="<?php echo esc_attr($style) ?>">
            <?php
            if ($style == 'zero-counters blackish'):
                $src = wp_get_attachment_url($bgImg);
                ?>
                <div class="parallax" data-velocity="-.2"
                     style="background: url(<?php echo esc_url($src) ?>) no-repeat scroll center / cover;"></div>
            <?php endif; ?>
            <div class="row">
                <?php echo balanceTags($content); ?>
            </div>
        </div>
        <?php ob_start(); ?>
        jQuery(document).ready(function ($) {
        "use strict";

        $('.counter').counterUp({
        delay: 10,
        time: 1000
        });
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-waypoints', $jsOutput);
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
