<?php

class unload_drop_cap_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_drop_cap($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Drop Cap", 'unload'),
                "base" => "unload_drop_cap_output",
                "icon" => 'drop_cap.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Drop Cap Word:", 'unload'),
                        "param_name" => "dp",
                        "description" => esc_html__("Enter the Drop Cap Word.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
                    array(
                        "type" => "dropdown",

                        "heading" => esc_html__('Style', 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Dark Border', 'unload') => 'dropcaps-style dropcap-style1',
                            esc_html__('Mono Border', 'unload') => 'dropcaps-style dropcap-style2',
                            esc_html__('Mono Background', 'unload') => 'dropcaps-style dropcap-style3',
                            esc_html__('Dark Background', 'unload') => 'dropcaps-style dropcap-style4',
                            esc_html__('Verticle Dark Border', 'unload') => 'dropcaps-style dropcap-style5',
                            esc_html__('Verticle Mono Border', 'unload') => 'dropcaps-style dropcap-style6',
                            esc_html__('Dark', 'unload') => 'dropcaps-style dropcap-style7',
                            esc_html__('Mono', 'unload') => 'dropcaps-style dropcap-style8',
                            esc_html__('Gray Parallax', 'unload') => 'dropcaps-style bg-layer dropcap-style9',
                            esc_html__('Dark Parallax', 'unload') => 'dropcaps-style bg-layer dropcap-style10',
                            esc_html__('Mono Parallax', 'unload') => 'dropcaps-style bg-layer dropcap-style11',
                            esc_html__('White with Dark Border', 'unload') => 'dropcaps-style dropcap-style12',
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
                            'value' => array('dropcaps-style bg-layer dropcap-style9', 'dropcaps-style bg-layer dropcap-style10', 'dropcaps-style bg-layer dropcap-style11')
                        ),
                    ),
                )
            );
            return apply_filters('unload_drop_cap_shortcode', $return);
        }
    }

    public static function unload_drop_cap_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="callus-toaction">
        <?php
    if ($style == 'dropcaps-style bg-layer dropcap-style9' || $style == 'dropcaps-style bg-layer dropcap-style10' || $style == 'dropcaps-style bg-layer dropcap-style11'):
        $bg = wp_get_attachment_image_src($imgage, 'full');
        ?>
        <div class="<?php echo esc_attr($style) ?>"
             style="background: url(<?php echo esc_url($H->unload_set($bg, '0')) ?>)  no-repeat scroll center / cover">
        <?php else: ?>
        <div class="<?php echo esc_attr($style) ?>">
    <?php endif; ?>
        <p><strong><?php echo esc_html($dp) ?></strong><?php echo esc_html($desc) ?></p>
        </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
	