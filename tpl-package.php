<?php
// Template Name:	Package List
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column(get_the_ID());
$inner = ($column == 'col-md-8') ? 'col-md-4' : 'col-md-3';
$h = new unload_Helper();
$args = array(
    'post_type' => 'un_package',
    'post_status' => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
    'ignore_sticky_posts' => FALSE,
    'paged' => (isset($wp_query->query['paged'])) ? $wp_query->query['paged'] : 1,
);
$query = new WP_Query($args);
$column = $h->unload_column(get_the_ID());
$inner = ($column == 'col-md-8') ? 'col-md-6' : 'col-md-4';
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                <div class="<?php echo esc_attr($column) ?>">
                    <div class="top-margin our-packages2">
                        <div class="row">
                            <?php
                            while ($query->have_posts()):
                                $query->the_post();
                                $time = $h->unload_m('metaDeliveryTime');
                                $icon = $h->unload_m('metaIcon');
                                $gallery = (is_array($h->unload_m('metaGallery'))) ? array_keys($h->unload_m('metaGallery')) : array();
                                $keyFeatures = $h->unload_m('metaKeyFeatures');
                                ?>
                                <div class="<?php echo esc_attr($inner) ?>">
                                    <div class="our-packages">
                                        <div class="packages-thumb">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('unload_570x423');
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
                                                    <span><?php //esc_html_e( 'Delivery ', 'unload' ) ?><?php echo esc_html($time) ?></span><?php endif; ?>
                                                <?php
                                                if (!empty($keyFeatures) && count($keyFeatures) > 0):
                                                    $counter = 0;
                                                    ?>
                                                    <ul class="features">
                                                        <?php
                                                        foreach ($keyFeatures as $k):
                                                            if ($counter == 3) {
                                                                break;
                                                            }
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
