<?php

class unload_company_projects_VC_ShortCode extends unload_VC_ShortCode
{

    static public $counter = 12;

    public static function unload_company_projects($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Company Projects", 'unload'),
                "base" => "unload_company_projects_output",
                "icon" => 'company_projects.png',
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
            return apply_filters('unload_company_projects_shortcode', $return);
        }
    }

    public static function unload_company_projects_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'project',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $counter = 0;
            ?>
            <div class="company-projects">
                <div class="company-projects-list" id="PAD<?php echo esc_attr(self::$counter) ?>">
                    <ul>
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $time = $H->unload_m('metaDeliveryTime');
                            $active = ($counter == 0) ? 'class=start' : '';
                            ?>
                            <li <?php echo esc_attr($active) ?>>
                                <div class="company-project">
                                    <?php
                                    if (has_post_thumbnail()):
                                        the_post_thumbnail('unload_580x634');
                                    endif;
                                    ?>
                                    <div class="project-detail">
                                        <?php if (!empty($time)): ?><span>
                                            <i><?php esc_html_e('Delivery ', 'unload') ?><?php echo esc_html($time) ?></i>
                                            </span><?php endif; ?>
                                        <h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                                               itemprop="url"><?php the_title() ?></a></h4>
                                    </div>
                                </div>
                            </li>
                            <?php
                            $counter++;
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>
            <?php
            if ($viewall == 'on'):
                ?>
                <div class="view-all">
                    <a title="" href="<?php echo esc_url(get_page_link($aboutpage)) ?>" class="theme-btn">
                        <i class="fa fa-paper-plane"></i> <?php echo esc_html($btn) ?></a>
                </div>
                <?php
            endif;
            ob_start();
            ?>
            jQuery(document).ready(function ($) {
            'use strict';

            $("#PAD<?php echo esc_js(self::$counter) ?>").addClass("loaded");
            var l = $("#PAD<?php echo esc_js(self::$counter) ?> > ul li").length;
            for (var i = 0; i <= l; i++) {
            var room_list = $("#PAD<?php echo esc_js(self::$counter) ?> > ul li").eq(i);
            var room_img_height = $(room_list).find(".company-project > img").innerHeight();

            $(room_list).find(".company-project > img").css({
            "width": "100%"
            });
            }
            $("#PAD<?php echo esc_js(self::$counter) ?> > ul li.start").addClass("active");
            $("#PAD<?php echo esc_js(self::$counter) ?> > ul li").on("mouseenter", function () {
            $("#PAD<?php echo esc_js(self::$counter) ?> > ul li").removeClass("active");
            $(this).addClass("active");
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-script', $jsOutput);
        }
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
