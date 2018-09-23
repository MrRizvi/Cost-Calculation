<?php

class unload_news_with_big_thumb_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_news_with_big_thumb($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("News With Big Thumb", 'unload'),
                "base" => "unload_news_with_big_thumb_output",
                "icon" => 'news_with_big_thumb.png',
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
                        "type" => "multiselect",
                        "heading" => esc_html__('Select Categories', 'unload'),
                        "param_name" => "cat",
                        "value" => (new unload_helper)->unload_cat(array('taxonomy' => 'category', 'hide_empty' => true), true),
                        "description" => esc_html__('Choose posts categories for which posts you want to show', 'unload')
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
                        "type" => "dropdown",
                        "heading" => esc_html__("Columns", 'unload'),
                        "param_name" => "cols",
                        "value" => array_flip(
                            array(
                                'col-md-6' => esc_html__('2 Column', 'unload'),
                                'col-md-4' => esc_html__('3 Column', 'unload'),
                                'col-md-3' => esc_html__('4 Column', 'unload')
                            )
                        ),
                        "description" => esc_html__("Select the column", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__('Content Limit', 'unload'),
                        "param_name" => "limit",
                        "description" => esc_html__('Enter the number of show content words', 'unload')
                    ),
                )
            );
            return apply_filters('unload_news_with_big_thumb_shortcode', $return);
        }
    }

    public static function unload_news_with_big_thumb_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('isotop'));
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
            'category_name' => $cat,
        );
        $gridManage = ($cols == 'col-md-3') ? 'grids4' : '';
        $cats = explode(',', $cat);
        $firstCat = array_shift($cats);
        if (!empty($cat) && $firstCat != 'all') {
            $args['category_name'] = $cat;
        }
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            ?>
            <div class="top-margin <?php echo esc_attr($gridManage) ?>">
                <div class="row">
                    <div id="masonary<?php echo esc_attr(self::$counter) ?>">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="<?php echo esc_attr($cols) ?>">
                                <div class="news-box">
                                    <div class="news-thumb">
                                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" itemprop="url">
                                            <?php the_post_thumbnail('unload_570x423') ?>
                                        </a>
                                        <div class="date">
                                            <strong><?php echo get_the_date('d') ?></strong>
                                            <span><?php echo get_the_date('F') ?></span>
                                        </div>
                                    </div>
                                    <div class="news-detail">
                                        <h2 itemprop="headline">
                                            <a itemprop="url" href="<?php the_permalink() ?>"
                                               title="<?php the_title() ?>">
                                                <?php the_title() ?>
                                            </a>
                                        </h2>
                                        <ul class="post-meta2">
                                            <li>
                                                <i class="fa fa-comments"></i>
                                                <a title="" href="<?php the_permalink() ?>">
                                                    <?php $H->unload_comments(get_the_ID()) ?>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-user"></i>
                                                <?php esc_html_e('By ', 'unload') ?>
                                                <a itemprop="url" title="" href="<?php $H->unload_authorLink() ?>">
                                                    <?php echo ucfirst(get_the_author()) ?>
                                                </a>
                                            </li>
                                        </ul>
                                        <p itemprop="description">
                                            <?php
                                            if (!empty($limit)) {
                                                echo wp_trim_words(get_the_content(), $limit, '');
                                            } else {
                                                echo the_excerpt();
                                            }
                                            ?>
                                        </p>
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
            <?php ob_start(); ?>
            jQuery(window).load(function () {
            "use strict";
            jQuery(function () {
            var $portfolio = jQuery('#masonary<?php echo esc_js(self::$counter) ?>');
            $portfolio.isotope({
            masonry: {
            columnWidth: 0.5
            }
            });
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-isotop', $jsOutput);
        }
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
