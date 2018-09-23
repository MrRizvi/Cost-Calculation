<?php
// Template Name:	Service List Style 1
$h = new unload_Helper();
$bookingUrl = $h->unloadTpl('tpl-order-list.php');
$h->unload_header();
$opt = $h->unload_opt();
$h->unload_headerTop(get_the_ID());
$column = $h->unload_column(get_the_ID());
$inner = ($column == 'col-md-8') ? 'col-md-4' : 'col-md-3';
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
                    <div class="top-margin services-page">
                        <div class="row">
                            <?php
                            while ($query->have_posts()):
                                $query->the_post();
                                $icon = $h->unload_m('metaServiceIcon');
                                $company = $h->unload_m('metacompanyName');
                                $name = $h->unload_m('metaShippingName');
                                ?>
                                <div class="<?php echo esc_attr($inner) ?>">
                                    <div class="fancy-service">
                                        <?php
                                        if (has_post_thumbnail()):
                                            the_post_thumbnail('unload_285x361');
                                        endif;
                                        ?>
                                        <div class="service-detail">
                                            <?php if (!empty($icon)): ?><i
                                                class="<?php echo esc_attr($icon) ?>"></i><?php endif; ?>
                                            <?php if (!empty($company)): ?>
                                                <span><?php echo esc_html($company) ?></span><?php endif; ?>
                                            <?php if (!empty($name)): ?>
                                                <h3><?php echo esc_html($name) ?></h3>
                                                <h5><?php esc_html_e('SHIPPING', 'unload') ?></h5>
                                            <?php endif; ?>
                                            <a title="" href="<?php the_permalink() ?>" itemprop="url"
                                               class="theme-btn"><i
                                                    class="fa fa-paper-plane"></i><?php esc_html_e('View', 'unload') ?>
                                            </a>
                                        </div>
                                    </div><!-- Fancy Services -->
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
