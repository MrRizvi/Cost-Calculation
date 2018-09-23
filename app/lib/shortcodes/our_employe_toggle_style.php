<?php

class unload_our_employe_toggle_style_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_our_employe_toggle_style($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Our Employee Toggle Style", 'unload'),
                "base" => "unload_our_employe_toggle_style_output",
                "icon" => 'our_employe_toggle_style.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__('Number of Posts', 'unload'),
                        "param_name" => "number",
                        'min' => '1',
                        'max' => '3',
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
            return apply_filters('unload_our_employe_toggle_style_shortcode', $return);
        }
    }

    public static function unload_our_employe_toggle_style_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'team',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $counter = 0;
            ?>
            <div class="members-area top-margin">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    $social = $H->unload_m('metaSocialProfiler');
                    $des = $H->unload_m('metaDesignation');
                    $active = ($counter == 0) ? 'clicked' : '';
                    ?>
                    <div class="member <?php echo esc_attr($active) ?>">
                        <div class="member-thumb">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('unload_580x634');
                            }
                            ?>
                            <div class="member-info">
                                <?php if (!empty($des)): ?><span
                                    itemprop="jobTitle"><?php echo esc_html($des) ?></span><?php endif; ?>
                                <h4 itemprop="name"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                                                       itemprop="url"><?php the_title() ?></a></h4>
                            </div>
                        </div>
                        <div class="member-detail">
                            <div class="member-info">
                                <?php if (!empty($des)): ?><span
                                    itemprop="jobTitle"><?php echo esc_html($des) ?></span><?php endif; ?>
                                <h4 itemprop="name"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                                                       itemprop="url"><?php the_title() ?></a></h4>
                            </div>
                            <p itemprop="description"><?php echo wp_trim_words(get_the_excerpt(get_the_ID()), 15, Null); ?></p>
                            <?php if (!empty($social) && count($social) > 0): ?>
                                <ul class="social-btns">
                                    <?php
                                    foreach ($social as $s) {
                                        echo '<li><a href="' . esc_url($H->unload_set($s, 'metaProfileLink')) . '" title="" itemprop="url"><i class="fa ' . esc_attr($H->unload_set($s, 'metaProfileIcon')) . '"></i></a></li>';
                                    }
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $counter++;
                }
                wp_reset_postdata();
                ?>
            </div>
            <?php ob_start(); ?>
            jQuery(document).ready(function ($) {
            'use strict';

            $('div.members-area').each(function () {
            $(this).children().eq(0).addClass('clicked');
            var testimo = $(this).find(".member");
            $(testimo).on("click", function () {
            $(testimo).removeClass("clicked");
            $(this).addClass("clicked");
            });
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-script', $jsOutput);
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
