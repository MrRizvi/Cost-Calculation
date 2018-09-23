<?php

class unload_about_shipment_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_about_shipment($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("About Shipment", 'unload'),
                "base" => "unload_about_shipment_output",
                "icon" => 'about_shipment.png',
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
                        "heading" => esc_html__("1st Shipment Name:", 'unload'),
                        "param_name" => "name1",
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('1st Shipment Icon', 'unload'),
                        'param_name' => 'icon1',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("2nd Shipment Name:", 'unload'),
                        "param_name" => "name2",
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('2nd Shipment Icon', 'unload'),
                        'param_name' => 'icon2',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("3rd Shipment Name:", 'unload'),
                        "param_name" => "name3",
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('3rd Shipment Icon', 'unload'),
                        'param_name' => 'icon3',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("4th Shipment Name:", 'unload'),
                        "param_name" => "name4",
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('4th Shipment Icon', 'unload'),
                        'param_name' => 'icon4',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "un_toggle",
                        "heading" => esc_html__("About Button", 'unload'),
                        "param_name" => "about",
                        'value' => 'off',
                        'default_set' => false,
                        'options' => array(
                            'on' => array(
                                'on' => __('Yes', 'unload'),
                                'off' => __('No', 'unload'),
                            ),
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Select Page:", 'unload'),
                        "param_name" => "aboutpage",
                        "description" => esc_html__("Select the page that you want to link.", 'unload'),
                        "value" => array_flip((new unload_Helper)->unload_posts('page')),
                        'dependency' => array(
                            'element' => 'about',
                            'value' => array('on')
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Title:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the title of the button.", 'unload'),
                        'dependency' => array(
                            'element' => 'about',
                            'value' => array('on')
                        ),
                    ),
                )
            );
            return apply_filters('unload_about_shipment_shortcode', $return);
        }
    }

    public static function unload_about_shipment_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="shipment-guide">
            <div class="dark-title light">
                <?php if (!empty($subtitle)): ?>
                    <span><i class="fa fa-steam"></i><?php echo esc_attr($subtitle) ?></span>
                <?php endif; ?>
                <h3><?php echo esc_attr($title) ?></h3>
            </div>
            <p><?php echo $desc ?></p>
            <div class="shipment-list">
                <div class="row">
                    <?php if (!empty($name1)): ?>
                        <div class="col-md-6">
                            <div class="shipment-name">
                                <span><i
                                        class="<?php echo esc_attr($icon1) ?>"></i></span><?php echo esc_html($name1) ?>
                            </div><!-- Shipment Name -->
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($name2)): ?>
                        <div class="col-md-6">
                            <div class="shipment-name">
                                <span><i
                                        class="<?php echo esc_attr($icon4) ?>"></i></span><?php echo esc_html($name2) ?>
                            </div><!-- Shipment Name -->
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($name3)): ?>
                        <div class="col-md-6">
                            <div class="shipment-name">
                                <span><i
                                        class="<?php echo esc_attr($icon3) ?>"></i></span><?php echo esc_html($name3) ?>
                            </div><!-- Shipment Name -->
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($name4)): ?>
                        <div class="col-md-6">
                            <div class="shipment-name">
                                <span><i
                                        class="<?php echo esc_attr($icon2) ?>"></i></span><?php echo esc_html($name4) ?>
                            </div><!-- Shipment Name -->
                        </div>
                    <?php endif; ?>
                </div>
            </div><!-- Shipment List -->
            <?php if ($about == 'on'): ?>
                <a class="theme-btn" href="<?php echo esc_url(get_page_link($aboutpage)) ?>" title="">
                    <i class="fa fa-paper-plane"></i> <?php echo esc_html($btn) ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
