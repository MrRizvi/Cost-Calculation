<?php

class unload_Widgets
{

    static protected $_widgets = array(
        'recent_news',
        'gallery',
        'recent_posts',
        'video',
        'about',
        'newsletter'
    );

    static public function register()
    {
        $widgets_ = array();
        foreach (self::$_widgets as $widget) {
            $widgets_[unload_Root . 'app/lib/widget/' . strtolower($widget) . '.php'] = $widget;
        }

        $widgets_ = apply_filters('unload_extend_widgets_', $widgets_);
        foreach ($widgets_ as $path => $register) {
            require_once($path);
            $widget_class = 'unload_' . $register . '_Widget';
            register_widget($widget_class);
        }
    }

}
