<?php

class unload_admin
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

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;

        return FALSE;
    }

    public function init()
    {
        add_action('admin_enqueue_scripts', array(unload_Media::unload_singleton(), 'unload_RenderAdminStyles'));
        add_action('widgets_init', array(unload_sidebar::unload_singleton(), 'init'));
        require_once unload_Root . 'app/lib/widgets.php';
        add_action('widgets_init', array('unload_Widgets', 'register'));
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        add_action('admin_footer', array( __CLASS__, 'unload_demo_importer_box'));
        if (is_plugin_active('unload/unload.php')) {
            $path = ABSPATH . 'wp-content/plugins/unload/panel/';
            if (file_exists($path . 'panel-init.php')) {
                require_once $path . 'panel-init.php';
            }
        }
        require_once unload_Root . 'app/lib/metabox.php';
        require_once unload_Root . 'app/lib/3rdparty/tgm/tgm.php';
        self::unload_dummy();
    }
    static public function unload_demo_importer_box() {
        global $pagenow;

        if ($pagenow == 'themes.php') {
            $output = '<div class="preloader-wrapper" style="display:none;"><div class="importer-box"><h2>' . esc_html__('Demo Importer Settings', 'unload') . '</h2><span class="close">x</span><div class="box-content">';
            $output .= '<div id="progressbar"></div>';
            $output .= '<div class="demo-option-form">

                                <label><input type="radio" value="images" name="demo_type">' . esc_html__('Demo content with demo images', 'unload') . '</label><br>
                                <label><input type="radio" value="placehold" name="demo_type">' . esc_html__('Demo content with demo placehold images', 'unload') . '</label><br>
                                <input data-uri="" class="demo-importer" type="submit" name="demo-submit" value="' . esc_html__('Import Demo', 'unload') . '" />

                        </div>';
            $output .= '</div></div></div>';
            echo balanceTags($output);
        }
    }
    public static function unload_dummy()
    {
        $h = new unload_Helper;
        if ($h->unload_set($_GET, 'page') == 'themeOptions' && $h->unload_set($_GET, 'dummy_data_export') == TRUE) {
            $filePath = ABSPATH . 'wp-content/plugins/unload/';
            require_once $filePath . 'import_export.php';
            $obj = new unload_import_export();
            $obj->export();
        }
    }
    
    public function __clone()
    {
        trigger_error(esc_html__('Cloning the registry is not permitted', 'unload'), E_USER_ERROR);
    }

}
