<?php

require_once unload_Root . 'app/lib/3rdparty/tgm/activation.php';

add_action('tgmpa_register', 'unload_register_required_plugins');

function unload_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => esc_html__('Visual Composer', 'unload'),
            'slug' => 'js_composer',
            'source' => unload_Root . 'app/lib/3rdparty/tgm/plugins/js_composer.zip',
            'required' => true,
            'version' => '5.4.7',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => 'http://wpbakery.com/',
        ),
        array(
            'name' => esc_html__('Layer Slider', 'unload'),
            'slug' => 'layerslider',
            'source' => unload_Root . 'app/lib/3rdparty/tgm/plugins/layerslider.zip',
            'required' => true,
            'version' => '6.1.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => 'http://codecanyon.net/user/kreatura/',
        ),
        array(
	        'name' => esc_html__('Envato Market Plugin', 'unload'),
	        'slug' => 'envato-market',
	        'source' => unload_Root . 'app/lib/3rdparty/tgm/plugins/envato-market.zip',
	        'required' => true,
	        'version' => '1.0',
	        'force_activation' => true,
	        'force_deactivation' => true,
	        'external_url' => 'http://www.webinane.com',
        ),
        array(
            'name' => esc_html__('Unload', 'unload'),
            'slug' => 'unload',
            'source' => unload_Root . 'app/lib/3rdparty/tgm/plugins/unload.zip',
            'required' => true,
            'version' => '1.4',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => 'http://www.webinane.com',
        ),
    );

    $config = array(
        'id' => 'unload',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
    );

    tgmpa($plugins, $config);
}
