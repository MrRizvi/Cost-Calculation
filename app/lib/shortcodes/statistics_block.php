<?php

class unload_statistics_block_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_statistics_block($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Statistics Block", 'unload'),
                "base" => "unload_statistics_block_output",
                "icon" => 'unload_statistics_block.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_statistics_output'),
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
                        "description" => esc_html__("Enter the title statistics.", 'unload')
                    ),
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__("Number:", 'unload'),
                        "param_name" => "num",
                        "description" => esc_html__("Enter the statistics number.", 'unload')
                    )
                )
            );
            return apply_filters('unload_statistics_block_shortcode', $return);
        }
    }

    public static function unload_statistics_block_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="col-md-3">
            <div class="counter-styles">
                <i class="<?php echo esc_attr($icon) ?>"></i>
                <h5 class="counter"><?php echo esc_attr($num) ?></h5>
                <span><?php echo esc_attr($title) ?></span>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
