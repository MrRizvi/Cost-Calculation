<?php

$nested = array(
    'unload_custom_page_links_output' => 'unload_pages_block_output',
    'unload_statistics_output' => 'unload_statistics_block_output',
    'unload_tabs_output' => 'unload_tabs_block_output',
    'unload_progress_bars_output' => 'unload_progress_bars_block_output',
    'unload_toggles_output' => 'unload_toggles_block_output',
    'unload_fun_fact_output' => 'unload_fun_fact_block_output',
    'unload_shipment_guide_output' => 'unload_shipment_services_output',
    'unload_shipment_calc_output' => 'unload_extra_features_output',
);

if ($nested) {
    foreach ($nested as $parent => $child) {
        if (class_exists('WPBakeryShortCodesContainer')) {
            if (function_exists('unload_nested_shortcode')) {
                unload_nested_shortcode("class WPBakeryShortCode_{$parent} extends WPBakeryShortCodesContainer{}");
            }
        }
        if (class_exists('WPBakeryShortCode')) {
            if (function_exists('unload_nested_shortcode')) {
                unload_nested_shortcode("class WPBakeryShortCode_{$child} extends WPBakeryShortCode{}");
            }
        }
    }
}




