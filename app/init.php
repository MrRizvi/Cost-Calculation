<?php

class unload_ThemeInit
{

    private static $settings = array();
    private static $instance;

    static public function init()
    {
        self::unload_singleton()->unload_constant();
        load_textdomain('unload', unload_Root . 'languages/' . get_locale() . '.mo');
        add_filter('locale', array(__CLASS__, 'unload_themeLocalized'), 10);
        self::unload_singleton()->unload_autoLoader();
        self::unload_singleton()->unload_InitSettings();
        self::unload_singleton()->unload_front();
        new unload_ajax();
        include(unload_Root . 'app/classes/vcsettings.php');
        include(unload_Root . 'app/lib/shortcodes.php');
        include(unload_Root . 'app/lib/widgets.php');
        //add_action( 'init', array( __CLASS__, 'unload_doOutputBuffer' ) );

        add_action('widgets_init', array('unload_Widgets', 'register'));
        add_filter('post_row_actions', array(__CLASS__, 'unload_remove_link_faq'), 10, 1);
        add_filter('get_sample_permalink_html', array(__CLASS__, 'unload_permalink'), 10, 5);
        add_filter('language_attributes', function ($attr) {
            $h = new unload_Helper;
            $opt = $h->unload_opt();
            if ($h->unload_set($opt, 'optThemeRtl') && !is_admin()) {
                return "{$attr} dir=\"rtl\"";
            } else {
                return "{$attr}";
            }
        });
        add_filter('login_redirect', array(__CLASS__, 'unload_customerList'), 10, 3);

        if (is_admin()) {
            unload_admin::unload_singleton()->init();
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            if (is_plugin_active('unload/unload.php')) {
                $path = ABSPATH . 'wp-content/plugins/unload/vc-addon/';
                if (file_exists($path . 'toggle.php')) {
                    include_once $path . 'toggle.php';
                    new unload_toggle();
                }
                if (file_exists($path . 'multiselect.php')) {
                    include_once $path . 'multiselect.php';
                    new unload_multiselect();
                }
                if (file_exists($path . 'number.php')) {
                    include_once $path . 'number.php';
                    new unload_number();
                }
                if (file_exists($path . 'heading.php')) {
                    include_once $path . 'heading.php';
                    new unload_heading();
                }
            }
        }
        unload_Media::unload_singleton()->unload_RenderMedia(array('style'));
        add_action('widgets_init', array(unload_sidebar::unload_singleton(), 'init'));
    }

    public static function unload_singleton()
    {
        if (!isset(self::$instance)) {
            $obj = __CLASS__;
            self::$instance = new $obj;
        }

        return self::$instance;
    }

    public static function unload_remove_link_faq($action)
    {
        global $post;
        $h = new unload_Helper;
        if ($h->unload_set($post, 'post_type') == 'un_order') {
            unset($action['view']);

            return $action;
        } else {
            return $action;
        }
    }

    public static function unload_permalink($return, $id, $new_title, $new_slug)
    {
        $h = new unload_Helper;
        $post = get_post($id);
        if ($h->unload_set($post, 'post_type') == 'un_order') {
            return '';
        } else {
            return $return;
        }
    }

    public static function unload_updateOptions()
    {
        if (get_option('theme_options') == "") {
            if (file_exists(unload_Root . 'app/lib/default.txt')) {
                $file = wp_remote_get(unload_Uri . 'app/lib/default.txt');
                $response = wp_remote_retrieve_body($file);
                if (!empty($response)) {
                    update_option('theme_options', maybe_unserialize($response));
                    unlink(unload_Root . 'app/lib/default.txt');
                }
            }
        }
    }

    static public function unload_doOutputBuffer()
    {
        ob_start();
    }

    static public function unload_customerList($redirect_to, $request, $user)
    {
        $h = new unload_Helper;
        if (isset($user->roles) && is_array($user->roles)) {
            if (in_array('un_customer', $user->roles)) {
                $url = $h->unloadTpl('tpl-order-list.php');

                return $url;
            } else {
                return home_url();
            }
        } else {
            return $redirect_to;
        }
    }

    static public function unload_themeLocalized($locale)
    {
        $h = new unload_Helper();
        $opt = $h->unload_opt();
        $lang = $h->unload_set($opt, 'optLanguage');
        if (isset($_GET['l'])) {
            return esc_attr($_GET['l']);
        }

        return (!empty($lang)) ? $lang : $locale;

    }

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;

        return FALSE;
    }

    public function unload_setup()
    {
        add_editor_style('editor-style.css');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'unload'),
            'footer' => esc_html__('Footer', 'unload'),
        ));
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        add_theme_support('custom-background', apply_filters('unload_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
        add_theme_support('jetpack-responsive-videos');

        $images = array('unload_380x333', 'unload_285x361', 'unload_1170x593', 'unload_370x370', 'unload_570x423', 'unload_370x160', 'unload_640x378', 'unload_589x357', 'unload_580x634', 'unload_775x417', 'unload_775x336', 'unload_628x461');
        foreach ($images as $img) {
            $siplit = explode('x', $img);
            add_image_size($img, str_replace('unload_', '', $siplit['0']), $siplit['1'], TRUE);
        }
    }

    public function unload_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('unload_content_width', 640);
    }

    public function unload_custom_header_setup()
    {
        add_theme_support('custom-header', apply_filters('unload_custom_header_args', array(
            'default-image' => '',
            'default-text-color' => '000000',
            'width' => 1000,
            'height' => 250,
            'flex-height' => TRUE,
            'wp-head-callback' => array($this, 'unload_header_style'),
        )));
    }

    public function unload_header_style()
    {
        if (get_header_image()) :
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>"
                     height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="">
            </a>
            <?php
        endif;

        $header_text_color = get_header_textcolor();
        if (HEADER_TEXTCOLOR === $header_text_color) {
            return;
        }
        ?>
        <style type="text/css">
            <?php
            if ( !display_header_text() ) :
                ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }

            <?php
        else :
            ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            <?php endif; ?>
        </style>
        <?php
    }

    public function unload_constant()
    {
        define('unload_Root', get_template_directory() . '/');
        define('unload_Uri', get_template_directory_uri() . '/');
        define('unload_EXT', unload_Root . 'app/panel/redux-extensions/extensions/');
        define('unload_EXTU', unload_Uri . 'app/panel/redux-extensions/extensions/');
        define('unload_V', '1.0');
        define('Unload_KEY', '!@#unload');
    }

    public function unload_front()
    {
        add_action('after_setup_theme', array(self::unload_singleton(), 'unload_updateOptions'));
        add_action('after_setup_theme', array(self::unload_singleton(), 'unload_setup'));
        add_action('after_setup_theme', array(self::unload_singleton(), 'unload_content_width'), 0);
        add_action('after_setup_theme', array(self::unload_singleton(), 'unload_custom_header_setup'));
        add_action('wp_enqueue_scripts', array(unload_Media::unload_singleton(), 'unload_RenderStyle'));
        add_action('wp_enqueue_scripts', array(unload_Media::unload_singleton(), 'unload_RenderScript'));
        add_action('wp_head', array(unload_Media::unload_singleton(), 'unload_head'));
        add_action('init', array('unload_Shortcodes', 'init'));
        add_filter('excerpt_length', array(self::unload_singleton(), 'unload_excerpt_length'), 999);
        add_filter('excerpt_more', array(self::unload_singleton(), 'unload_excerpt_more'), 999);
        add_action('admin_init', array($this, 'unload_createCaps'));
    }

    public function unload_storeSetting($data, $key)
    {
        self::$settings[$key] = $data;
    }

    public function unload_getSetting($key)
    {
        return self::$settings[$key];
    }

    public function unload_autoLoader()
    {
        require_once unload_Root . 'app/lib/autoloader.php';
        Autoload::register();
        Autoload::directories(array(
            unload_Root . 'app/classes/',
        ));
        if (is_admin()) {
            Autoload::directories(array(
                unload_Root . 'app/lib/3rdparty/vc-addon/',
            ));
        }
    }

    public function unload_InitSettings()
    {
        require_once unload_Root . 'app/lib/settings.php';
    }

    public function unload_excerpt_length($length)
    {
        return 15;
    }

    public function unload_excerpt_more($more)
    {
        return '...';
    }

    public function unload_createCaps()
    {
        $cap = array(
            'read' => TRUE,
        );
        add_role('un_customer', esc_html__('Unload Customer', 'unload'), $cap);

        $roleClient = get_role('un_customer');
        $roleClient->add_cap('read');
    }

    public function __clone()
    {
        trigger_error(esc_html__('Cloning the registry is not permitted', 'unload'), E_USER_ERROR);
    }

}
