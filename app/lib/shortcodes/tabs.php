<?php

class unload_tabs_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_tabs($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Tabs", 'unload'),
                "base" => "unload_tabs_output",
                "icon" => 'unload_tabs_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_tabs_block_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style:", 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Tabs With Coloured Buttons In Center', 'unload') => 'tabs1 tabs-styles',
                            esc_html__('Tabs With Buttons On Left Hand', 'unload') => 'tabs2 tabs-styles',
                            esc_html__('Tabs With Creative Style', 'unload') => 'tabs3 tabs-styles',
                            esc_html__('Tabs Verticle With White BG', 'unload') => 'tabs4 tabs-styles',
                            esc_html__('Tabs Verticle With Gray BG', 'unload') => 'tabs4 gray-bg tabs-styles',
                            esc_html__('Tabs Verticle Dark Coloured', 'unload') => 'tabs4 bg-img tabs-styles',
                        ),
                        "description" => esc_html__("Select the style of the tabs.", 'unload')
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Parrallax Image:", 'unload'),
                        "param_name" => "background",
                        "description" => esc_html__("Upload image for this style.", 'unload'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('tabs4 bg-img tabs-styles'),
                        ),
                    )
                )
            );
            return apply_filters('unload_tabs_output', $return);
        }
    }

    public static function unload_tabs_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('bootstrap'));
        global $shortcode_tabs;
        $shortcode_tabs = array();
        do_shortcode($content);
        $tabs_nav = '';
        $tabs_content = '';
        $tabs_count = count($shortcode_tabs);
        $i = 0;
        $i2 = 0;
        $colone = explode(' ', $style);
        $last = self::$counter;
        if ($style == 'tabs4 bg-img tabs-styles') {
            $bg = wp_get_attachment_url($background, 'full');
            echo '<div class="' . esc_attr($style) . '" style="background: url(' . esc_url($bg) . ') no-repeat scroll center / cover">';
        } else {
            echo ' <div class="' . esc_attr($style) . '">';
        }
        if ($tabs_count > 0) {
            echo '<ul class="nav nav-tabs">';
            foreach ($shortcode_tabs as $tab) {
                $active = ($i == 0) ? 'active' : '';
                ?>
                <li class="<?php echo esc_attr($active) ?>">
                    <a href="#tabs1-tab<?php echo esc_attr($i . $last) ?>" data-toggle="tab">
                        <i class="<?php echo esc_attr($H->unload_set($tab, 'icon')) ?>"></i>
                        <?php echo esc_html($H->unload_set($tab, 'title')) ?>
                    </a>
                </li>
                <?php
                $i++;
            }
            echo '</ul>';
            echo '<div class="tab-content">';
            foreach ($shortcode_tabs as $tab) {
                $active = ($i2 == 0) ? 'in active' : '';
                ?>
                <div class="tab-pane fade <?php echo esc_attr($active) ?>"
                     id="tabs1-tab<?php echo esc_attr($i2 . $last) ?>">
                    <p><?php echo esc_html($H->unload_set($tab, 'content')) ?></p>
                </div>
                <?php
                $i2++;
            }
            echo '</div>';
        }
        echo '</div>';
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
