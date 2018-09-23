<?php

class unload_pictorial_services_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_pictorial_services($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Pictorial Services", 'unload'),
                "base" => "unload_pictorial_services_output",
                "icon" => 'pictorial_services.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => $H->unload_vcArray(array('number', 'order', 'order_by', 'button'), array(
                    'h' => esc_html('Select Service', 'unload'),
                    'n' => 'services',
                    'v' => $H->unload_posts('service'),
                    'd' => esc_html__('Select multiple services that you want to show', 'unload')
                )),
            );
            return apply_filters('unload_pictorial_services_shortcode', $return);
        }
    }

    public static function unload_pictorial_services_output($atts = null, $content = null)
    {
        include_once(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'service',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            ?>
            <div class="top-margin">
                <div class="row merge">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        $icon = get_post_meta(get_the_ID(), 'metaServiceIcon', true);
                        $company = get_post_meta(get_the_ID(), 'metacompanyName', true);
                        $shipping = get_post_meta(get_the_ID(), 'metaShippingName', true);
                        ?>
                        <div class="col-md-3">
                            <div class="fancy-service">
                                <?php the_post_thumbnail('full') ?>
                                <div class="service-detail">
                                    <i class="<?php echo esc_attr($icon) ?>"></i>
                                    <span><?php echo esc_html($company) ?></span>
                                    <h3><?php echo esc_html($shipping) ?></h3>
                                    <h5><?php esc_html_e('SHIPPING', 'unload') ?></h5>
                                    <?php if (!empty($btn)): ?>
                                        <a class="theme-btn" itemprop="url" href="<?php the_permalink() ?>"
                                           title="<?php the_title() ?>"><i
                                                class="fa fa-paper-plane"></i><?php echo esc_html($btn) ?></a>
                                    <?php endif; ?>
                                </div>
                            </div><!-- Fancy Services -->
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
