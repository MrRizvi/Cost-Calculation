<?php

class unload_simple_services_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_simple_services($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Simple Services", 'unload'),
                "base" => "unload_simple_services_output",
                "icon" => 'simple_services.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__('Number of Posts', 'unload'),
                        "param_name" => "number",
                        'min' => '1',
                        'max' => '50',
                        'step' => '1',
                        "description" => esc_html__('Enter the number of posts to show', 'unload')
                    ),
                    array(
                        "type" => "dropdown",

                        "heading" => esc_html__('Order', 'unload'),
                        "param_name" => "order",
                        "value" => array(
                            esc_html__('Ascending', 'unload') => 'ASC',
                            esc_html__('Descending', 'unload') => 'DESC'
                        ),
                        "description" => esc_html__("Select sorting order ascending or descending for posts listing", 'unload')
                    ),
                    array(
                        "type" => "dropdown",

                        "heading" => esc_html__("Order By", 'unload'),
                        "param_name" => "orderby",
                        "value" => array_flip(
                            array(
                                'date' => esc_html__('Date', 'unload'),
                                'title' => esc_html__('Title', 'unload'),
                                'name' => esc_html__('Name', 'unload'),
                                'author' => esc_html__('Author', 'unload'),
                                'comment_count' => esc_html__('Comment Count', 'unload'),
                                'random' => esc_html__('Random', 'unload')
                            )
                        ),
                        "description" => esc_html__("Select order by method for posts listing", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the button text.", 'unload')
                    )
                )
            );
            return apply_filters('unload_simple_services_shortcode', $return);
        }
    }

    public static function unload_simple_services_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
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
            while ($query->have_posts()) {
                $query->the_post();
                $icon = get_post_meta(get_the_ID(), 'metaServiceIcon', true);
                $company = get_post_meta(get_the_ID(), 'metacompanyName', true);
                $shipping = get_post_meta(get_the_ID(), 'metaShippingName', true);
                ?>
                <div class="col-md-3">
                    <div class="modern-service">
                        <div class="mod-service-inner">
                            <span><i class="<?php echo esc_attr($icon) ?>"></i></span>
                            <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
                            </h3>
                            <i><?php echo esc_html($shipping) ?></i>
                            <p><?php echo wp_trim_words(get_the_excerpt(get_the_ID()), 15, null) ?></p>
                        </div>
                    </div><!-- Modern Service -->
                </div>
                <?php
            }
            wp_reset_postdata();
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
