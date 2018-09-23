<?php

class unload_progress_bars_block_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_progress_bars_block($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Progress Bar Block", 'unload'),
                "base" => "unload_progress_bars_block_output",
                "icon" => 'unload_progress_bars_block.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_progress_bars_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__("Number:", 'unload'),
                        "param_name" => "number",
                        "description" => esc_html__("Enter the number of this section.", 'unload')
                    )
                )
            );
            return apply_filters('unload_progress_bars_block_shortcode', $return);
        }
    }

    public static function unload_progress_bars_block_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        global $progress_bar;
        $progress_bar[] = array('title' => $title, 'number' => $number);
    }

}
