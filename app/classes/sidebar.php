<?php

class unload_sidebar
{

    private static $instance;

    public static function unload_singleton()
    {
        if (!isset(self::$instance)) {
            $obj = __CLASS__;
            self::$instance = new $obj;
        }

        return self::$instance;
    }

    public function init()
    {
        $h = new unload_Helper();
        $opt = (new unload_Helper())->unload_opt();
        $sidebars = array(
            'primary-widget-area' => array(
                'name' => esc_html__('Primary Widget Area', 'unload'),
                'desc' => esc_html__('The primary widget area', 'unload'),
                'before_widget' => '<div id="%1$s" class="%2$s widget">',
                'after_widget' => '</div>',
                'before_title' => '<div class="heading7">',
                'after_title' => '</div>',
            ),
            
        );

        $sidebars = apply_filters('unload_extendSidebar', $sidebars);
        unload_ThemeInit::unload_singleton()->unload_storeSetting(array_keys($sidebars), 'wp_registered_sidebars');
        foreach ($sidebars as $type => $sidebar) {
            if ((new unload_Helper())->unload_set($sidebar, 'name') != '') {
                register_sidebar(
                    array(
                        'name' => (new unload_Helper())->unload_set($sidebar, 'name'),
                        'id' => $type,
                        'description' => (new unload_Helper())->unload_set($sidebar, 'desc'),
                        'before_widget' => (new unload_Helper())->unload_set($sidebar, 'before_widget'),
                        'after_widget' => (new unload_Helper())->unload_set($sidebar, 'after_widget'),
                        'before_title' => (new unload_Helper())->unload_set($sidebar, 'before_title'),
                        'after_title' => (new unload_Helper())->unload_set($sidebar, 'after_title'),
                    )
                );
            }
        }

        // dynamic sidebar generator
        $dynamicSidebar = (new unload_Helper())->unload_set($opt, 'optDynamicSidebar');
        if (!empty($dynamicSidebar) && count($dynamicSidebar) > 0) {
            foreach ($dynamicSidebar as $s) {
                if ($s != '') {
                    register_sidebar(
                        array(
                            'name' => sprintf(esc_html__('%s', 'unload'), $s),
                            'id' => str_replace(' ', '-', strtolower($s)),
                            'description' => sprintf(esc_html__('%s', 'unload'), $s),
                            'before_widget' => '<div id="%1$s" class="%2$s widget">',
                            'after_widget' => '</div>',
                            'before_title' => '<div class="heading2">',
                            'after_title' => '</div>',
                        )
                    );
                }
            }
        }

        // footer builder
        $dynamicSidebar = $h->unload_set($opt, 'optFooterBuilder');
        if (!empty($dynamicSidebar) && count($dynamicSidebar) > 0) {
            foreach ($dynamicSidebar as $s) {
                if ($h->unload_set($s, 'input_field') != '') {
                    register_sidebar(
                        array(
                            'name' => sprintf(esc_html__('%s', 'unload'), $h->unload_set($s, 'input_field')),
                            'id' => str_replace(' ', '-', strtolower($h->unload_set($s, 'input_field'))),
                            'description' => sprintf(esc_html__('%s', 'unload'), $h->unload_set($s, 'input_field')),
                            'before_widget' => '<div id="%1$s" class="' . $h->unload_set($s, 'grid_builder') . ' %2$s"><div class="widget">',
                            'after_widget' => '</div></div>',
                            'before_title' => '<div class="heading2">',
                            'after_title' => '</div>',
                        )
                    );
                }
            }
        }
    }

}
