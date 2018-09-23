<?php

class unload_Metabox
{

    public $meta = array(
        'post',
        'service',
        'project',
        'project2',
        'package',
        'team',
        'event',
        'pricetable',
        'region',
        'un_order',
    );

    public function __construct()
    {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        if (is_plugin_active('unload/unload.php')) {
            $path = WP_PLUGIN_DIR . '/unload/metaboxs';
            asort($this->meta);
            foreach ($this->meta as $m) {
                if (file_exists($path . '/' . $m . '.php')) {
                    require_once $path . '/' . $m . '.php';
                    $class = 'unload_' . ucfirst($m) . 'Fields';
                    new $class();
                }

            }
        }
    }

}

new unload_Metabox();
