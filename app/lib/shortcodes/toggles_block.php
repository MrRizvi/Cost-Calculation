<?php

class unload_toggles_block_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_toggles_block($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Toggles Block", 'unload'),
                "base" => "unload_toggles_block_output",
                "icon" => 'unload_toggles_block_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_toggles_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'unload'),
                        'param_name' => 'icon',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "content",
                        "description" => esc_html__("Enter the description.", 'unload')
                    )
                )
            );
            return apply_filters('unload_toggles_block_output', $return);
        }
    }

    public static function unload_toggles_block_output($atts = null, $content = null)
    {
        $icon = $title = '';
        extract(shortcode_atts(array(
            'icon' => '',
            'title' => ''
        ), $atts));
        global $toggles;
        $toggles[] = array('icon' => $icon, 'title' => $title, 'content' => trim(do_shortcode($content)));
    }

}
