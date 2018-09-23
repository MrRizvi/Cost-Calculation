<?php

class unload_pictorial_services_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_pictorial_services($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Pictorial Services", 'unload'),
                "base" => "unload_pictorial_services_output",
                "icon" => 'pictorial_services.png',
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
                        "heading" => esc_html__('Number of Columns', 'unload'),
                        "param_name" => "cols",
                        "value" => array('One' => 12, 'Two' => 6, 'Three' => 4, 'Four' => 3, 'Six' => 2, 'Twelve' => 1),
                        "description" => esc_html__('Enter the number of columns', 'unload')
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
                        "param_name" => "btn2",
                        "description" => esc_html__("Enter the button text.", 'unload')
                    ),
                    array(
                        "type" => "un_toggle",

                        "heading" => esc_html__("View All", 'unload'),
                        "param_name" => "viewall",
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
                            'element' => 'viewall',
                            'value' => array('on')
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Title:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the title of the button.", 'unload'),
                        'dependency' => array(
                            'element' => 'viewall',
                            'value' => array('on')
                        ),
                    ),
                )
            );
            return apply_filters('unload_pictorial_services_shortcode', $return);
        }
    }

    public static function unload_pictorial_services_output($atts = null, $content = null)
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
                        <div class="col-md-<?php echo esc_attr($cols) ?>">
                            <div class="fancy-service">
                                <?php the_post_thumbnail('unload_285x361') ?>
                                <div class="service-detail">
                                    <i class="<?php echo esc_attr($icon) ?>"></i>
                                    <span><?php echo esc_html($company) ?></span>
                                    <h3><?php echo esc_html($shipping) ?></h3>
                                    <h5><?php esc_html_e('SHIPPING', 'unload') ?></h5>
                                    <?php if (!empty($btn2)): ?>
                                        <a class="theme-btn" itemprop="url" href="<?php the_permalink() ?>"
                                           title="<?php the_title() ?>"><i
                                                class="fa fa-paper-plane"></i><?php echo esc_html($btn2) ?></a>
                                    <?php endif; ?>
                                </div>
                            </div><!-- Fancy Services -->
                        </div>

                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
            if ($viewall == 'on'):
                ?>
                <div class="view-all">
                    <a title="" href="<?php echo get_page_link($aboutpage) ?>" class="theme-btn">
                        <i class="fa fa-paper-plane"></i> <?php echo esc_html($btn) ?></a>
                </div>
            <?php endif; ?>
            <?php
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
