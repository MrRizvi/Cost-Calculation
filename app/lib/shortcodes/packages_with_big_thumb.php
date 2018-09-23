<?php

class unload_packages_with_big_thumb_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_packages_with_big_thumb($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Packages With Big Thumb", 'unload'),
                "base" => "unload_packages_with_big_thumb_output",
                "icon" => 'packages_with_big_thumb.png',
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
                    )
                )
            );
            return apply_filters('unload_packages_with_big_thumb_shortcode', $return);
        }
    }

    public static function unload_packages_with_big_thumb_output($atts = null, $content = null)
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
            ?>
            <div class="what-make-us-different">
                <div class="top-margin">
                    <div class="row">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $icon = get_post_meta(get_the_ID(), 'metaIcon', true);
                            $subTitle = get_post_meta(get_the_ID(), 'metaSubTitle', true);
                            ?>
                            <div class="col-md-4">
                                <div class="post-style2">
                                    <span><?php the_post_thumbnail('unload_570x423') ?></span>
                                    <div class="post-info2">
                                        <i class="<?php echo esc_attr($icon) ?>"></i>
                                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                                               itemprop="url"><?php the_title() ?></a></h4>
                                        <span><?php echo esc_html($subTitle) ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
