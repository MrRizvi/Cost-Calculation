<?php
// Template Name:	Project List
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column(get_the_ID());
$inner = ($column == 'col-md-8') ? 'col-md-4' : 'col-md-3';
$h = new unload_Helper();
$args = array(
    'post_type' => 'project',
    'post_status' => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
    'ignore_sticky_posts' => FALSE,
    'paged' => (isset($wp_query->query['paged'])) ? $wp_query->query['paged'] : 1,
);
$query = new WP_Query($args);
$column = $h->unload_column(get_the_ID());
$counter = 0;
$break = ($column == 'col-md-8') ? '3' : '4';
$counter2 = 0;
?>
    <section class="block">
        <?php
        if ($break == 'col-md-8'):
            echo '<div class="container">';
        endif;
        ?>
        <div class="row">
            <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
            <div class="<?php echo esc_attr($column) ?>">
                <div class="company-projects-list" id="PAD">
                    <ul>
                        <?php
                        while ($query->have_posts()):
                            $query->the_post();
                            $time = $h->unload_m('metaDeliveryTime');
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
                            if ($counter == $break) {
                                echo '</ul></div>';
                                ob_start();
                                ?>
                                jQuery(document).ready(function () {
                                'use strict';
                                unload_list('<?php echo esc_js($counter2) ?>');
                                });
                                <?php
                                $jsOutput = ob_get_contents();
                                ob_end_clean();
                                wp_add_inline_script('unload-waypoints', $jsOutput);
                                echo '<div class="company-projects-list" id="PAD"><ul>';
                                $counter = 0;
                                $counter2++;
                            }
                        endwhile;
                        wp_reset_postdata();
                        $h->unload_pagi(array('total' => $query->max_num_pages));
                        ?>
                    </ul>
                </div>
            </div>
            <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
        </div>
        <?php
        if ($break == 'col-md-8'):
            echo '</div>';
        endif;
        ?>
    </section>
<?php ob_start(); ?>
    jQuery(document).ready(function ($) {
    'use strict';

    $("#PAD").addClass("loaded");
    var l = $("#PAD > ul li").length;
    for (var i = 0; i <= l; i++) {
    var room_list = $("#PAD > ul li").eq(i);
    var room_img_height = $(room_list).find(".company-project > img").innerHeight();
    $(room_list).css({
    "height": room_img_height
    });
    $(room_list).find(".company-project > img").css({
    "width": "100%"
    });
    }
    $("#PAD > ul li.start").addClass("active");
    $("#PAD > ul li").on("mouseenter", function () {
    $("#PAD > ul li").removeClass("active");
    $(this).addClass("active");
    });
    });
<?php
$jsOutput2 = ob_get_contents();
ob_end_clean();
wp_add_inline_script('unload-script', $jsOutput2);
get_footer();
