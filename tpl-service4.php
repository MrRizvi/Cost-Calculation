<?php
// Template Name:	Service List Style 4
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column(get_the_ID());
$inner = ($column == 'col-md-8') ? 'col-md-6' : 'col-md-4';
$h = new unload_Helper();
$args = array(
    'post_type' => 'service',
    'post_status' => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
    'ignore_sticky_posts' => FALSE,
    'paged' => (isset($wp_query->query['paged'])) ? $wp_query->query['paged'] : 1,
);
$query = new WP_Query($args);
$column = $h->unload_column(get_the_ID());
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                <div class="<?php echo esc_attr($column) ?>">
                    <div class="top-margin">
                        <div class="row">
                            <?php
                            while ($query->have_posts()):
                                $query->the_post();
                                $icon = $h->unload_m('metaServiceIcon');
                                $subTitle = $h->unload_m('metaServiceSubTitle');
                                ?>
                                <div class="<?php echo esc_attr($inner) ?>">
                                    <div class="simple-services2">
                                        <div class="service-box2">
                                            <?php if (!empty($icon)): ?><i
                                                class="<?php echo esc_attr($icon) ?>"></i><?php endif; ?>
                                            <h5><a href="<?php the_permalink() ?>"
                                                   title="<?php the_title() ?>"><?php the_title() ?></a></h5>
                                            <span><?php echo esc_html($subTitle) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            $h->unload_pagi(array('total' => $query->max_num_pages));
                            ?>
                        </div>
                    </div>
                </div>
                <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
            </div>
        </div>
    </section>
<?php
get_footer();
