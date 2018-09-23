<?php

class unload_extra_features_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_extra_features($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Extra Features", 'unload'),
                "base" => "unload_extra_features_output",
                "icon" => 'unload_extra_features.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_shipment_calc_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Name:", 'unload'),
                        "param_name" => "feature_name",
                        "description" => esc_html__("Enter the feature name.", 'unload')
                    ),
                     array(
	                     "type" => "textfield",
	                     "heading" => esc_html__("Price:", 'unload'),
	                     "param_name" => "feature_price",
	                     "description" => esc_html__("Enter the feature price.", 'unload')
                     )
                )
            );
            return apply_filters('unload_extra_features_shortcode', $return);
        }
    }

    public static function unload_extra_features_output($atts = null, $content = null)
    {
        $icon = $title = '';
        extract(shortcode_atts(array(
            'feature_name' => '',
            'feature_price' => ''
        ), $atts));
        global $extra_features;
        $extra_features[] = array('feature_name' => $feature_name, 'feature_price' => $feature_price);
    }

}
