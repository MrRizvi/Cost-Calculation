<?php

class unload_toggles_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_toggles($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Toggles", 'unload'),
                "base" => "unload_toggles_output",
                "icon" => 'unload_toggles_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_toggles_block_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style:", 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            __('Style 1', 'unload') => 'toggle',
                            __('Dark & Gray Style 1', 'unload') => 'toggle toggle-style2',
                            __('Dark & Gray Style 2', 'unload') => 'toggle toggle-style3',
                            __('Coloured & Light Gray Strip', 'unload') => 'toggle toggle-style4',
                            __('Coloured & Dark Gray Strip', 'unload') => 'toggle toggle-style4 toggle-style5',
                            __('Simple White With Coloured Buttons', 'unload') => 'toggle toggle-style4 toggle-style6',
                            __('Simple White With Coloured Border', 'unload') => 'toggle toggle-style7',
                            __('Fully Coloured with dark Strip', 'unload') => 'toggle toggle-style8',
                            __('Fully Coloured with Gray Strip', 'unload') => 'toggle toggle-style8 toggle-style9',
                        ),
                        "description" => esc_html__("Select the style for this toggle.", 'unload')
                    )
                )
            );
            return apply_filters('unload_toggles_output', $return);
        }
    }

    public static function unload_toggles_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        global $toggles;
        $toggles = array();
        do_shortcode($content);
        $count = count($toggles);
        ?>
        <div class="<?php echo esc_attr($style) ?>" id="toggle<?php echo esc_attr(self::$counter) ?>">
            <?php
            if ($count > 0) {
                $counter = 0;
                foreach ($toggles as $toggle) {
                    $active = ($counter == 0) ? 'active' : '';
                    ?>
                    <div class="toggle-item <?php echo esc_attr($active) ?>">
                        <h3 class="<?php echo esc_attr($active) ?>">
                            <i class="<?php echo esc_attr($H->unload_set($toggle, 'icon')) ?>"></i>
                            <?php echo esc_html($H->unload_set($toggle, 'title')) ?>
                            <?php if ($style == 'toggle' || $style == 'toggle toggle-style2' || $style == 'toggle toggle-style3'): ?>
                                <span><i class="fa fa-angle-up"></i></span>
                            <?php endif; ?>
                        </h3>
                        <div class="content">
                            <div class="simple-text">
                                <p><?php echo esc_html($H->unload_set($toggle, 'content')) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $counter++;
                }
            }
            ?>
        </div>
        <?php ob_start(); ?>
        jQuery(document).ready(function ($) {
        'use strict';

        $('#toggle<?php echo esc_js(self::$counter) ?> .content').hide();
        $('#toggle<?php echo esc_js(self::$counter) ?> h3:first').addClass('active').next().slideDown(500).parent().addClass("activate");
        $('#toggle<?php echo esc_js(self::$counter) ?> h3').on("click", function () {
        if ($(this).next().is(':hidden')) {
        $('#toggle<?php echo esc_js(self::$counter) ?> h3').removeClass('active').next().slideUp(500).removeClass('animated zoomIn').parent().removeClass("activate");
        $(this).toggleClass('active').next().slideDown(500).addClass('animated zoomIn').parent().toggleClass("activate");
        return false;
        }
        });
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-script', $jsOutput);
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
