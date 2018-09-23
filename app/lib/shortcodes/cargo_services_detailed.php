<?php

class unload_cargo_services_detailed_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_cargo_services_detailed($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Cargo Services Detailed", 'unload'),
                "base" => "unload_cargo_services_detailed_output",
                "icon" => 'cargo_services_detailed.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__('Number of Posts', 'unload'),
                        "param_name" => "number",
                        'min' => '1',
                        'max' => '4',
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
                    )
                )
            );
            return apply_filters('unload_cargo_services_detailed_shortcode', $return);
        }
    }

    public static function unload_cargo_services_detailed_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'un_package',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $counter = 0;
            ?>
            <div class="top-margin packages">
                <div class="row">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        $time = $H->unload_m('metaDeliveryTime');
                        $icon = $H->unload_m('metaIcon');
                        $gallery = array_keys($H->unload_m('metaGallery'));
                        $keyFeatures = $H->unload_m('metaKeyFeatures');
                        ?>
                        <div class="col-md-4">
                            <div class="our-packages">
                                <div class="packages-thumb">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('unload_370x333');
                                    } else {
                                        if (count($gallery) > 0) {
                                            $src = wp_get_attachment_image_src(array_shift($gallery), 'unload_370x370');
                                        }
                                    }
                                    ?>

                                    <div class="packages-info">
                                        <?php if (!empty($icon)): ?><i
                                            class="<?php echo esc_attr($icon) ?>"></i><?php endif; ?>
                                        <h2 itemprop="name">
                                            <a itemprop="url" href="<?php the_permalink() ?>"
                                               title="<?php the_title() ?>"><?php the_title() ?></a>
                                        </h2>
                                        <?php if (!empty($time)): ?>
                                            <span><?php esc_html_e('Delivery ', 'unload') ?><?php echo esc_html($time) ?></span><?php endif; ?>
                                        <?php
                                        if (count($keyFeatures) > 0):
                                            $counter = 0;
                                            ?>
                                            <ul>
                                                <?php
                                                foreach ($keyFeatures as $k):
                                                    if ($counter == 3)
                                                        break;
                                                    ?>
                                                    <li><?php echo esc_html($k) ?></li>
                                                    <?php
                                                    $counter++;
                                                endforeach;
                                                ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                    wp_reset_postdata();
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
