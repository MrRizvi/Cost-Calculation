<?php

class unload_shipment_services_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_shipment_services($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Shipment Services", 'unload'),
                "base" => "unload_shipment_services_output",
                "icon" => 'shipment_services.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_child" => array('only' => 'unload_shipment_guide_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Servie", 'unload'),
                        "param_name" => "sevice",
                        "value" => array_flip((new unload_Helper)->unload_posts('service')),
                        "description" => esc_html__("Select the service.", 'unload')
                    ),
                    array(
                        "type" => "iconpicker",
                        "heading" => esc_html__("Icon:", 'unload'),
                        "param_name" => "icon",
                        "description" => esc_html__("Select the icon from the library.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Sub Title", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the subtitle.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Description", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the one line desctiption.", 'unload')
                    ),
                )
            );
            return apply_filters('unload_shipment_services_shortcode', $return);
        }
    }

    public static function unload_shipment_services_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'service',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'p' => $sevice,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <li>
                    <span><i class="<?php echo esc_attr($icon) ?>"></i></span>
                    <?php if (!empty($subtitle)): ?><i><?php echo esc_html($subtitle) ?></i><?php endif; ?>
                    <h3><a href="<?php the_permalink() ?>" title="" itemprop="url"><?php the_title() ?></a></h3>
                    <?php if (!empty($desc)): ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
                </li>
                <?php
            }
            wp_reset_postdata();
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
