<?php

class unload_buttons_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_buttons($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Buttons", 'unload'),
                "base" => "unload_buttons_output",
                "icon" => 'buttons.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button link:", 'unload'),
                        "param_name" => "btnLink",
                        "description" => esc_html__("Enter the button link.", 'unload')
                    ),
                    array(
                        "type" => "iconpicker",
                        "heading" => esc_html__("Icon:", 'unload'),
                        "param_name" => "icon",
                        "description" => esc_html__("Select the icon from the library.", 'unload')
                    ),
                    array(
                        "type" => "dropdown",

                        "heading" => esc_html__('Style', 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Squared with Blug BG', 'unload') => 'btns blu-skin sml-radius',
                            esc_html__('Squared with Dark BG', 'unload') => 'btns drk-skin sml-radius',
                            esc_html__('Squared with Mono BG', 'unload') => 'btns thm-skin sml-radius',
                            esc_html__('Squared with Dark Border', 'unload') => 'btns drk-bor-skin sml-radius',
                            esc_html__('Squared with Mono Border', 'unload') => 'btns thm-bor-skin sml-radius',
                            esc_html__('Fancy with Blug BG', 'unload') => 'btns btn2 blu-skin sml-radius',
                            esc_html__('Fancy with Dark BG', 'unload') => 'btns btn2 drk-skin sml-radius',
                            esc_html__('Fancy with Mono BG', 'unload') => 'btns btn2 thm-skin sml-radius',
                            esc_html__('Fancy with Gray BG', 'unload') => 'btns btn2 lgt-skin sml-radius',
                            esc_html__('Fancy with Dark Border', 'unload') => 'btns btn2 drk-bor-skin sml-radius',
                            esc_html__('Half Rounded with Blug BG', 'unload') => 'btns blu-skin hlf-radius',
                            esc_html__('Half Rounded with Dark BG', 'unload') => 'btns drk-skin hlf-radius',
                            esc_html__('Half Rounded with Mono BG', 'unload') => 'btns thm-skin hlf-radius',
                            esc_html__('Half Rounded with Dark Border', 'unload') => 'btns drk-bor-skin hlf-radius',
                            esc_html__('Half Rounded with Mono Border', 'unload') => 'btns thm-bor-skin hlf-radius',
                            esc_html__('Rounded with Blug BG', 'unload') => 'btns blu-skin ful-radius',
                            esc_html__('Rounded with Dark BG', 'unload') => 'btns drk-skin ful-radius',
                            esc_html__('Rounded with Mono BG', 'unload') => 'btns thm-skin ful-radius',
                            esc_html__('Rounded with Dark Border', 'unload') => 'btns drk-bor-skin ful-radius',
                            esc_html__('Rounded with Mono Border', 'unload') => 'btns thm-bor-skin ful-radius',
                        ),
                        "description" => esc_html__("Select style of this section", 'unload')
                    ),
                    array(
                        "type" => "dropdown",

                        "heading" => esc_html__('Size', 'unload'),
                        "param_name" => "size",
                        "value" => array(
                            esc_html__('Small', 'unload') => 'sml-btn',
                            esc_html__('Medium', 'unload') => 'mid-btn',
                            esc_html__('Large', 'unload') => 'nth-lrg-btn',
                            esc_html__('X Large', 'unload') => 'lrg-btn',
                        ),
                        "description" => esc_html__("Select button size", 'unload')
                    ),
                )
            );
            return apply_filters('unload_buttons_shortcode', $return);
        }
    }

    public static function unload_buttons_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $not = array(
            'btns btn2 blu-skin sml-radius',
            'btns btn2 drk-skin sml-radius',
            'btns btn2 thm-skin sml-radius',
            'btns btn2 lgt-skin sml-radius',
            'btns btn2 drk-bor-skin sml-radius'
        );
        ?>
        <a href="<?php echo esc_url($btnLink) ?>" title="" class="<?php echo esc_attr($style . ' ' . $size) ?>">
            <?php if (!in_array($style, $not)): ?>
                <i class="<?php echo esc_attr($icon) ?>"></i>
            <?php endif; ?>
            <?php echo esc_html($title) ?>
        </a>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
