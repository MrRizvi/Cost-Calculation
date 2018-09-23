<?php

class unload_about_with_features_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_about_with_features($atts = NULL)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("About With Features", 'unload'),
                "base" => "unload_about_with_features_output",
                "icon" => 'about_with_features.png',
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
                        "type" => "textfield",
                        "heading" => esc_html__("BG Text:", 'unload'),
                        "param_name" => "bgtxt",
                        "description" => esc_html__("Enter the background text for this section.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
                    array(
                        "type" => "multiselect",
                        "heading" => esc_html__("Cargo Services:", 'unload'),
                        "param_name" => "services",
                        "description" => esc_html__("Select services to show.", 'unload'),
                        "value" => (new unload_Helper)->unload_posts('testimonial')
                    ),
                    array(
                        "type" => "un_toggle",

                        "heading" => esc_html__("View All", 'unload'),
                        "param_name" => "viewAll",
                        'value' => 'off',
                        'default_set' => FALSE,
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
                            'element' => 'viewAll',
                            'value' => array('on')
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Title:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the title of the button.", 'unload'),
                        'dependency' => array(
                            'element' => 'viewAll',
                            'value' => array('on')
                        ),
                    ),
                )
            );

            return apply_filters('unload_about_with_features_shortcode', $return);
        }
    }

    public static function unload_about_with_features_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        unload_Media::unload_singleton()->unload_eq(array('counter', 'waypoints'));
        ob_start();
        $args = array(
            'post_type' => 'service',
            'post_status' => 'publish',
            'showposts' => -1,
            'post__in' => explode(',', $services)
        );
        $query = new WP_Query($args);
        ?>
        <div class="award-winning-shippment">
            <div class="row">
                <div class="col-md-8">
                    <div class="award-winning">
                        <div class="title2">
                            <strong><?php echo esc_html($substitle) ?></strong>
                            <h2><?php echo esc_html($title) ?></h2>
                        </div>
                        <span class="big-bg-text"><?php echo esc_html($bgtxt) ?></span>
                        <p><?php echo esc_html($desc) ?></p>
                        <?php
                        if ($query->have_posts()) {
                            echo '<ul class="cargo-packages-list">';
                            while ($query->have_posts()) {
                                $query->the_post();
                                $icon = get_post_meta(get_the_ID(), 'metaServiceIcon', TRUE);
                                $company = get_post_meta(get_the_ID(), 'metacompanyName', TRUE);
                                $shipping = get_post_meta(get_the_ID(), 'metaShippingName', TRUE);
                                ?>
                                <li>
                                    <span><i class="<?php echo esc_attr($icon) ?>"></i></span>
                                    <i><?php echo esc_html($company) ?></i>
                                    <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                                           itemprop="url"><?php the_title() ?></a></h3>
                                    <p><?php echo esc_html($shipping) ?></p>
                                </li>
                                <?php
                            }
                            wp_reset_postdata();
                            echo '</ul>';
                        }
                        ?>
                        <?php if ($viewAll == 'on'): ?>
                            <a class="view-all-vertical" href="<?php echo esc_url(get_page_link($aboutPage)) ?>"
                               title=""><?php echo esc_html($btn) ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

}
