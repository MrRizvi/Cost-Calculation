<?php

class unload_Shortcodes
{

    static protected $_shortcodes = array(
        'pictorial_services',
        'about_company',
        'about_shipment',
        'packages_with_big_thumb',
        'company_projects',
        'shipment_calculator',
        'extra_features',
        'company_events_with_carousal',
        'suponser_company_carousal',
        'cargo_services_detailed',
        'custom_page_links',
        'pages_block',
        'simple_services',
        'simple_services2',
        'shipment_guide',
        'shipment_services',
        'news_with_big_thumb',
        'customer_reviews_in_carousal',
        'fixed_text_slider',
        'request_a_quote',
        'about_with_features',
        'our_employe_toggle_style',
        'statistics',
        'statistics_block',
        'tabs',
        'tabs_block',
        'progress_bars',
        'progress_bars_block',
        'social_media',
        'message_box_simple',
        'message_box_creative',
        'message_box_fancy',
        'toggles',
        'toggles_block',
        'isotop_gallery',
        'horizontal_gallery',
        'gallery_with_even_thumb',
        'horizontal_gallery2',
        'tabed_gallery',
        'simple_gallery',
        'call_action',
        'drop_cap',
        'buttons',
        'region',
        'fun_fact',
        'fun_fact_block',
        'parallax_video',
        'order_tracking',
        'verticle_order_tracking',
        'price_table',
    );

    static public function init()
    {
        define('unload_JS_COMPOSER_PATH', unload_Root . 'app/lib/shortcodes');
        require_once unload_JS_COMPOSER_PATH . "/shortcode.php";
        self::_init_shortcodes();
        self::unload_nested_shortcodes();
    }

    static protected function _init_shortcodes()
    {
        if (function_exists('vc_map') && function_exists('unload_shortcode_setup')) {
            asort(self::$_shortcodes);
            foreach (self::$_shortcodes as $shortcodes) {
                require_once unload_JS_COMPOSER_PATH . '/' . $shortcodes . '.php';
                $class = 'unload_' . ucfirst($shortcodes) . '_VC_ShortCode';
                $unload_name = strtolower('unload_' . $shortcodes);
                $class_methods = get_class_methods($class);
                if (isset($class_methods)) {
                    foreach ($class_methods as $shortcode) {
                        if ($shortcode[0] != '_' && $shortcode != $unload_name) {
                            unload_shortcode_setup($shortcode, array($class, $shortcode));
                            if (is_admin()) {
                                if (function_exists('vc_map')) {
                                    vc_map(call_user_func(array($class, '_options'), $unload_name));
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    static public function unload_nested_shortcodes()
    {
        require_once unload_JS_COMPOSER_PATH . "/nested_shortcodes.php";
    }

}
