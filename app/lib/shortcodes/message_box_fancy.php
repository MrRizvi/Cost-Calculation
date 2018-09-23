<?php

class unload_message_box_fancy_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_message_box_fancy($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Message Box Fancy", 'unload'),
                "base" => "unload_message_box_fancy_output",
                "icon" => 'unload_message_box_fancy_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style:", 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Message Box Simple White', 'unload') => 'messageboxes-style messagebox-style3 messagebox-style3-1',
                            esc_html__('Message Box Gray BG', 'unload') => 'messageboxes-style messagebox-style3 messagebox-style3-2',
                            esc_html__('Message Box Dark BG', 'unload') => 'messageboxes-style messagebox-style3 messagebox-style3-3',
                            esc_html__('Message Box Coloured BG', 'unload') => 'messageboxes-style messagebox-style3 messagebox-style3-4',
                        ),
                        "description" => esc_html__("Select the style of the message box.", 'unload')
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', 'unload'),
                        'param_name' => 'icon',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Sub Title:", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description.", 'unload')
                    )
                )
            );
            return apply_filters('unload_message_box_fancy_output', $return);
        }
    }

    public static function unload_message_box_fancy_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="<?php echo esc_attr($style) ?>">
            <div class="messagebox">
                <i class="<?php echo esc_attr($icon) ?>"></i>
                <span><?php echo esc_html($subtitle) ?></span>
                <h3><?php echo esc_html($title) ?></h3>
                <p><?php echo esc_html($desc) ?></p>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
