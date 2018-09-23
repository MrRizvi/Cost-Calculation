<?php

class unload_Media
{

    static private $styles = array();
    static private $adminStyles = array();
    static private $scripts = array();
    private static $instance;
    public $runTimeStyles = array();
    public $loadStyles = array();

    static public function unload_RenderScript()
    {
        $opt = (new unload_Helper())->unload_opt();
        $h = new unload_Helper();
        self::$scripts = unload_ThemeInit::unload_singleton()->unload_getSetting('themeScript');
        foreach (self::$scripts as $name => $file) {
            $handle = 'unload-' . $name;
            wp_register_script($handle, (new unload_Helper())->unload_url($file), array(), unload_V, TRUE);
        }
        $translation_array = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'url' => unload_Uri,
            'captchSiteKey' => $h->unload_set($opt, 'optGoogleCaptchSiteKey'),
            'ordrTitle' => esc_html('Oreder Received', 'unload'),
            'term' => esc_html('Please accept Term\'s & Condition', 'unload'),
            'ordrTitle' => esc_html('Order Info', 'unload'),
            'rtl' => ($h->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false'
        );
        wp_localize_script('unload-script', 'unload', $translation_array);
        wp_localize_script('unload-scrolltopcontrol', 'unload', $translation_array);
        wp_enqueue_script(array('jquery', 'unload-scroll-up-bar', 'unload-bootstrap', 'unload-select2', 'unload-countries', 'unload-icheck', 'unload-perfect-scrollbar', 'unload-scrolly', 'unload-scrolltopcontrol', 'unload-script'));
    }

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

    public function unload_RenderMedia($medias = array())
    {
        (new unload_Helper())->unload_check($medias);
        $this->loadStyles = $medias;
        add_action('wp_enqueue_scripts', array($this, 'unload_runtimeRenderStyle'));
    }

    public function unload_RenderStyle()
    {
        $h = new unload_Helper;
        $opt = $h->unload_opt();
        $google_typo_fonts = $this->unload_typographyFonts();
        if (!empty($google_typo_fonts)):
            wp_enqueue_style('unload-theme-typo', $google_typo_fonts, array(), '', 'all');
        endif;
        $google_theme_fonts = $this->unload_theme_google_fonts();
        if (!empty($google_theme_fonts)):
            wp_enqueue_style('unload-theme-fonts', $google_theme_fonts, array(), '', 'all');
        endif;
        self::$styles = unload_ThemeInit::unload_singleton()->unload_getSetting('themeStyles');
        foreach (self::$styles as $name => $file) {
            $handle = 'unload-' . $name;
            wp_enqueue_style($handle, (new unload_Helper())->unload_url($file), array(), unload_V, 'all');
        }
        if ($h->unload_set($opt, 'optThemeRtl')) {
            wp_enqueue_style('unload-rtl', (new unload_Helper())->unload_url('css/rtl.css'), array(), unload_V, 'all');
        }
        $this->unload_typography();
    }

    public function unload_typographyFonts()
    {
        $h = new unload_Helper;
        $opt = $h->unload_opt();
        $render = '';
        $fonts = array();
        $subset = array();
        $style = array('body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        foreach ($style as $s) {
            $isTypo = $h->unload_set($opt, 'opt' . ucfirst($s) . 'Typo');
            if ($isTypo == '1') {
                $styleArray = $h->unload_set($opt, 'opt' . ucfirst($s) . 'Typography');
                $key = str_replace(' ', '_', $h->unload_set($styleArray, 'font-family'));
                $fountName = str_replace(' ', '+', $h->unload_set($styleArray, 'font-family'));
                $fonts[$key] = $fountName . ':' . $h->unload_set($styleArray, 'font-weight');
                if ($h->unload_set($styleArray, 'subsets') != '') {
                    $subset[$h->unload_set($styleArray, 'subsets')] = '';
                }
            }
        }

        if (!empty($subset) && count($subset) > 0) {
            $getSubset = array_keys($subset);
            $subsets = implode(',', $getSubset);
        } else {
            $subsets = 'latin';
        }

        if ($fonts) {
            $font_families = array();
            foreach ($fonts as $name => $font) {
                $string = sprintf(_x('on', '%s font: on or off', 'unload'), $name);
                if ('off' !== $string) {
                    $font_families[] = $font;
                }
            }
            $query_args = array(
                'family' => implode('|', $font_families),
                'subset' => urlencode($subsets),
            );
            $protocol = (is_ssl()) ? 'https' : 'http';
            $fonts_url = add_query_arg($query_args, $protocol . '://fonts.googleapis.com/css');
        }
        if (!empty($fonts_url)) {
            return esc_url_raw($fonts_url);
        } else {
            return;
        }
    }

    public function unload_theme_google_fonts()
    {
        $fonts_url = '';

        $fonts = array(
            'Raleway' => 'Raleway:400,100,200,300,500,600,700,800,900',
            'Lato' => 'Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic',
        );

        if ($fonts) {
            $font_families = array();
            foreach ($fonts as $name => $font) {
                $string = sprintf(_x('on', '%s font: on or off', 'unload'), $name);
                if ('off' !== $string) {
                    $font_families[] = $font;
                }
            }
            $query_args = array(
                'family' => implode('|', $font_families),
                'subset' => urlencode('latin,latin-ext'),
            );
            $protocol = (is_ssl()) ? 'https' : 'http';
            $fonts_url = add_query_arg($query_args, $protocol . '://fonts.googleapis.com/css');
        }

        return esc_url_raw($fonts_url);
    }

    public function unload_typography()
    {
        $h = new unload_Helper;
        $opt = $h->unload_opt();
        $render = '';
        $style = array('body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        foreach ($style as $s) {
            $isTypo = $h->unload_set($opt, 'opt' . ucfirst($s) . 'Typo');
            if ($isTypo == '1') {
                $styleArray = $h->unload_set($opt, 'opt' . ucfirst($s) . 'Typography');
                unset($styleArray['font-options']);
                unset($styleArray['google']);
                unset($styleArray['font-style']);
                unset($styleArray['subsets']);
                if (!empty($styleArray) && count($styleArray) > 0) {
                    $render .= $s . '{' . PHP_EOL;
                    foreach ($styleArray as $k => $v) {
                        if (!empty($v)) {
                            $render .= $k . ':' . $v . ';' . PHP_EOL;
                        }
                    }
                    $render .= '}' . PHP_EOL;
                }
            }
        }
        wp_add_inline_style('unload-style', $render);
    }

    public function unload_runtimeRenderStyle()
    {
        foreach ($this->loadStyles as $style) {
            $handle = 'unload-' . $style;
            if (!wp_style_is($handle, $list = 'enqueued ')) {
                wp_enqueue_style($handle);
            }
        }
    }

    public function unload_RenderAdminStyles()
    {
        self::$adminStyles = unload_ThemeInit::unload_singleton()->unload_getSetting('adminStyles');
        foreach (self::$adminStyles as $name => $file) {
            $handle = 'unload-' . $name;
            wp_enqueue_style($handle, unload_Uri . 'partial/' . $file, array(), unload_V, 'all');
        }
        global $pagenow;
        if ($pagenow == 'themes.php'){
                    wp_enqueue_script('jquery-ui-progressbar');
                }
    }

    public function unload_eq($scripts = array())
    {
        foreach ($scripts as $script) {
            $handle = 'unload-' . $script;
            wp_enqueue_script($handle);
        }
    }

    public function unload_head()
    {
        $opt = (new unload_Helper())->unload_opt();
        (new unload_Helper())->unload_colorScheme((new unload_Helper())->unload_set($opt, 'optThemeColor'));
        if (is_singular()) {
            wp_enqueue_script("comment-reply");
        }
    }

}
