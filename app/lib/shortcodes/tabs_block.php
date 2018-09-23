<?php

class unload_tabs_block_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_tabs_block($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Tabs Block", 'unload'),
                "base" => "unload_tabs_block_output",
                "icon" => 'unload_tabs_block.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_tabs_output'),
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
                        "description" => esc_html__("Enter the title statistics.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Content:", 'unload'),
                        "param_name" => "content",
                        "description" => esc_html__("Enter the Content.", 'unload')
                    )
                )
            );
            return apply_filters('unload_tabs_block_shortcode', $return);
        }
    }

    public static function unload_tabs_block_output($atts = null, $content = null)
    {
        $icon = $title = '';
        extract(shortcode_atts(array(
            'icon' => '',
            'title' => ''
        ), $atts));
        global $shortcode_tabs;
        $shortcode_tabs[] = array('icon' => $icon, 'title' => $title, 'content' => trim(do_shortcode($content)));
    }

}
