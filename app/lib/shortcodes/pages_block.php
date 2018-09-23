<?php

class unload_pages_block_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_pages_block($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Pages Block", 'unload'),
                "base" => "unload_pages_block_output",
                "icon" => 'unload_pages_block.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_custom_page_links_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
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
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title Link:", 'unload'),
                        "param_name" => "titlelink",
                        "description" => esc_html__("Enter the title link.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Sub Title:", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Short Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the short description for this section.", 'unload')
                    ),
                )
            );
            return apply_filters('unload_pages_block_shortcode', $return);
        }
    }

    public static function unload_pages_block_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="modern-service">
            <div class="mod-service-inner">
                <span><i class="<?php echo esc_attr($icon) ?>"><?php ?></i></span>
                <h3><a href="<?php echo esc_url($titlelink) ?>" title=""><?php echo esc_html($title) ?></a></h3>
                <i><?php echo esc_html($subtitle) ?></i>
                <p><?php echo esc_html($desc) ?></p>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
