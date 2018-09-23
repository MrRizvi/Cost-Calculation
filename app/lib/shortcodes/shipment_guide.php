<?php

class unload_shipment_guide_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_shipment_guide($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Shipment Guide", 'unload'),
                "base" => "unload_shipment_guide_output",
                "icon" => 'shipment_guide.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_shipment_services_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
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
                        "heading" => esc_html__("Background Text:", 'unload'),
                        "param_name" => "bgtxt",
                        "description" => esc_html__("Enter the background text.", 'unload')
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
                        "param_name" => "aboutPage",
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
            return apply_filters('unload_shipment_guide_shortcode', $return);
        }
    }

    public static function unload_shipment_guide_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="award-winning-shippment">
            <div class="award-winning">
                <div class="title2">
                    <?php if (!empty($subtitle)): ?>
                        <strong><?php echo esc_attr($subtitle) ?></strong>
                    <?php endif; ?>
                    <h2><?php echo esc_attr($title) ?></h2>
                </div>
            </div>
            <?php if (!empty($bgtxt)): ?>
                <span class="big-bg-text"><?php echo esc_html($bgtxt) ?></span>
                <?php
            endif;
            if (!empty($desc)):
                ?>
                <p><?php echo esc_html($desc) ?></p>
            <?php endif; ?>
            <div class="cargo-packages-list">
                <ul class="cargo-packages-list">
                    <?php echo balanceTags($content) ?>
                </ul>
            </div><!-- Shipment List -->
            <?php if ($about == 'on'): ?>
                <a class="view-all-vertical" href="<?php echo esc_url(get_page_link($aboutPage)) ?>" title="">
                    <?php echo esc_html($btn) ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
