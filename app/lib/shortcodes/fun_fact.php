<?php

class unload_fun_fact_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_fun_fact($atts = NULL)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Fun Fact", 'unload'),
                "base" => "unload_fun_fact_output",
                "icon" => 'fun_fact.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_fun_fact_block_output'),
                "content_element" => TRUE,
                "show_settings_on_create" => FALSE,
                "is_container" => TRUE,
                "params" => array()
            );

            return apply_filters('unload_fun_fact_shortcode', $return);
        }
    }

    public static function unload_fun_fact_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        unload_Media::unload_singleton()->unload_eq(array('counter', 'waypoints'));
        ob_start();
        ?>
        <div class="services1" id="counter<?php echo esc_js(self::$counter) ?>">
            <div class="row">
                <?php echo balanceTags($content) ?>
            </div>
        </div>
        <?php ob_start(); ?>
        jQuery(document).ready(function ($) {
        "use strict";
        $('div#counter<?php echo esc_js(self::$counter) ?> .counter').counterUp({
        delay: 10,
        time: 1000
        });
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-waypoints', $jsOutput);
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();

        return do_shortcode($output);
    }

}
