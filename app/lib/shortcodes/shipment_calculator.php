<?php

class unload_shipment_calculator_VC_ShortCode extends unload_VC_ShortCode
{

    static public $counter = 0;

    public static function unload_shipment_calculator($atts = NULL)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Shipment Calculator", 'unload'),
                "base" => "unload_shipment_calc_output",
                "icon" => 'shipment_calculator.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_extra_features_output'),
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
                        "param_name" => "sub_title",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btntext",
                        "description" => esc_html__("Enter the button text.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Receiving Mail ID:", 'unload'),
                        "param_name" => "mailid",
                        "description" => esc_html__("Enter the email id that you want to receive email\'s fromt this form.", 'unload')
                    ),
                    array(
	                    "type" => "textfield",
	                    "heading" => esc_html__("Price per square cm:", 'unload'),
	                    "param_name" => "pricecm",
	                    "description" => esc_html__("Enter the price that you want to assign per square cm.", 'unload')
                    ),
                    array(
	                    "type" => "textfield",
	                    "heading" => esc_html__("Price per KG:", 'unload'),
	                    "param_name" => "pricekg",
	                    "description" => esc_html__("Enter the price that you want to assign per kg.", 'unload')
                    )
                )
            );

            return apply_filters('unload_shipment_calculator_shortcode', $return);
        }
    }

    public static function unload_shipment_calc_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        (new unload_Media)->unload_eq(array('select2', 'countries', 'icheck'));

        global $extra_features;
        $extra_features = array();
        do_shortcode($content);
        $features_count = count($extra_features);
        include unload_Root . 'calc.php';
        $jsOutput = "jQuery(document).ready(function($){
			'use strict';
			$('div.cargo-shipment select').select2();
			print_country('shiping_from_country');
			print_country('shiping_to_country');
			$('div.cargo-shipment .extra-services input').iCheck({
				checkboxClass: 'icheckbox_futurico2',
				increaseArea: '20%' // optional
			});
		});";
        wp_add_inline_script('unload-countries', $jsOutput);

        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

}
