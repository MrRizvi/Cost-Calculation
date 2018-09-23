<?php

class unload_fun_fact_block_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_fun_fact_block($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Fun Fact Block", 'unload'),
                "base" => "unload_fun_fact_block_output",
                "icon" => 'fun_fact_block.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_fun_fact_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Fun Fact title:", 'unload'),
                        "param_name" => "funt",
                        "description" => esc_html__("Enter the fun factor title.", 'unload')
                    ),
                    array(
                        "type" => "iconpicker",
                        "heading" => esc_html__("Fun Fact icon:", 'unload'),
                        "param_name" => "funicon",
                        "description" => esc_html__("Select the icon from the library.", 'unload')
                    ),
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__("Fun Fact Number:", 'unload'),
                        "param_name" => "funnub",
                        'min' => '1',
                        'max' => '10000000',
                        'step' => '1',
                        "description" => esc_html__("Enter the fun factor number.", 'unload')
                    )
                )
            );
            return apply_filters('unload_fun_fact_block_shortcode', $return);
        }
    }

    public static function unload_fun_fact_block_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="col-md-3">
            <div class="simple-services1">
                <div class="service-box1">
                    <i class="<?php echo esc_attr($funicon) ?>"></i>
                    <h5 class="counter"><?php echo esc_attr($funnub) ?></h5>
                    <span><?php echo esc_attr($funt) ?></span>
                </div>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
