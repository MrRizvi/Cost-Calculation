<?php

class unload_region_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_region($atts = NULL)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Region", 'unload'),
                "base" => "unload_region_output",
                "icon" => 'unload_region_output.png',
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
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
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
                        "value" => array_flip(array(
                            'date' => esc_html__('Date', 'unload'),
                            'title' => esc_html__('Title', 'unload'),
                            'name' => esc_html__('Name', 'unload'),
                            'author' => esc_html__('Author', 'unload'),
                            'comment_count' => esc_html__('Comment Count', 'unload'),
                            'random' => esc_html__('Random', 'unload')
                        )),
                        "description" => esc_html__("Select order by method for posts listing", 'unload')
                    ),
                )
            );

            return apply_filters('unload_region_output', $return);
        }
    }

    public static function unload_region_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'region',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'order' => $order,
            'orderby' => $orderby,
        );
        $query = new WP_Query($args);
        ?>
        <div class="region-information">
            <div class="row">
                <div class="col-md-5">
                    <div class="region">
                        <div class="title2 title3">
                            <strong><?php echo esc_html($subtitle) ?></strong>
                            <h2><?php echo esc_html($title) ?></h2>
                        </div>
                        <p><?php echo esc_html($desc) ?></p>
                    </div>
                </div>
                <?php
                if ($query->have_posts()) {
                    $counter = 0;
                    ?>
                    <div class="col-md-7">
                        <div class="region">
                            <div class="cities-carousel" id="cities-carousel<?php echo esc_attr(self::$counter) ?>">
                                <?php
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    if (has_post_thumbnail()) {
                                        ?>
                                        <div class="cities-detail">
                                            <div class="city-thumb">
                                                <?php the_post_thumbnail('thumbnail', array('itemprop' => 'image')) ?>
                                            </div>
                                            <h4><a class="data-region" href="javascript:void(0)" title="" itemprop="url"
                                                   data-toggle="modal"
                                                   data-region="<?php echo esc_attr(get_the_ID()) ?>"
                                                   data-target="#region">
                                                    <?php the_title() ?>
                                                </a>
                                            </h4>
                                        </div>
                                        <?php
                                        $counter++;
                                    }
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div><!-- Region Information -->
        <?php
        unload_Media::unload_singleton()->unload_eq(array('owl', 'bootstrap', 'map', 'recaptcha'));
        $loop = ($counter > 0) ? TRUE : FALSE;
        ?>
        <?php ob_start();
        $opt = $H->unload_opt();
        $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false'; ?>
        jQuery(document).ready(function ($) {
        'use strict';

        $('a.data-region').on('click', function () {
        var id = $(this).data('region');
        var data = 'id=' + id + '&action=regionBlock';
        $.ajax({
        type: "post",
        url: unload.ajaxurl,
        data: data,
        dataType: 'json',
        beforeSend: function () {
        $('div.preloader').fadeIn('slow');
        },
        success: function (res) {
        $('div.preloader').fadeOut('slow');
        if (res.status === true) {
        $('div#region').empty();
        $('div#region').html(res.msg);
        $('div#region').modal({
        show: 'true'
        });
        } else if (res.status === false) {
        alert(res.msg);
        }
        }
        });
        return false;
        });

        $("#cities-carousel<?php echo esc_js(self::$counter) ?>").owlCarousel({
        rtl: <?php echo esc_js($rtl) ?>,
        autoplay: false,
        autoplayTimeout: 3000,
        smartSpeed: 2000,
        loop: <?php echo esc_js($loop) ?>,
        dots: false,
        nav: true,
        margin: 20,
        items: 1,
        singleItem: true,
        responsiveClass: true,
        responsive: {
        0: {
        items: 1
        },
        600: {
        items: 3
        },
        1200: {
        items: 3
        }
        }
        });
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-script', $jsOutput);
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();

        return $output;
    }

}
