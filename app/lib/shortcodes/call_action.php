<?php

class unload_call_action_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_call_action($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("CALL TO ACTION", 'unload'),
                "base" => "unload_call_action_output",
                "icon" => 'call_action.png',
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
                        "heading" => esc_html__("Sub Title:", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btntxt",
                        "description" => esc_html__("Enter the button text.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Link:", 'unload'),
                        "param_name" => "btnLink",
                        "description" => esc_html__("Enter the Button link.", 'unload')
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
                            esc_html__('Gray BG', 'unload') => 'callus1 callus-action',
                            esc_html__('Dark BG', 'unload') => 'callus2 callus-action',
                            esc_html__('Mono BG', 'unload') => 'callus3 callus-action',
                            esc_html__('White BG', 'unload') => 'callus4 callus-action',
                            esc_html__('Parallax', 'unload') => 'callus5 callus-action',
                        ),
                        "description" => esc_html__("Select style of this section", 'unload')
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Image:", 'unload'),
                        "param_name" => "imgage",
                        "description" => esc_html__("Upload background image.", 'unload'),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => array('callus5 callus-action')
                        ),
                    ),
                )
            );
            return apply_filters('unload_call_action_shortcode', $return);
        }
    }

    public static function unload_call_action_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="callus-toaction">
        <?php
    if ($style == 'callus5 callus-action'):
        $bg = wp_get_attachment_image_src($imgage, 'full');
        ?>
        <div class="<?php echo esc_attr($style) ?>"
             style="background:url(<?php echo esc_url($H->unload_set($bg, '0')) ?>)">
        <?php else: ?>
        <div class="<?php echo esc_attr($style) ?>">
    <?php endif; ?>
        <div class="callus-content">
            <i class="<?php echo esc_attr($icon) ?>"></i>
            <h2><?php echo esc_html($title)
                ?></h2>
            <span><?php echo esc_html($desc) ?></span>
        </div>
        <a href="<?php echo esc_url($btnLink) ?>" title="">
            <i class="fa fa-paper-plane"></i>
            <?php echo esc_html($btntxt) ?>
        </a>
        </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
	