<?php
// Template Name:	Team List Style 1
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column(get_the_ID());
$inner = ($column == 'col-md-8') ? 'col-md-6' : 'col-md-4';
$h = new unload_Helper();
$args = array(
    'post_type' => 'team',
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
                <div class="col-md-12">
                    <div class="top-margin team-page">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <div class="row">
                                    <?php
                                    while ($query->have_posts()):
                                        $query->the_post();
                                        $social = $h->unload_m('metaSocialProfiler');
                                        $des = $h->unload_m('metaDesignation');
                                        ?>
                                        <div class="<?php echo esc_attr($inner) ?>">

                                            <div class="team-member">
                                                <div class="member-img">
                                                    <?php
                                                    if (has_post_thumbnail()) {
                                                        the_post_thumbnail('unload_580x634');
                                                    }
                                                    ?>
                                                    <div class="member-social">
                                                        <p itemprop="description"><?php echo wp_trim_words(get_the_excerpt(get_the_ID()), 10, NULL); ?></p>
                                                        <?php if (!empty($social) && count($social) > 0): ?>
                                                            <ul class="social-links">
                                                                <?php
                                                                foreach ($social as $s) {
                                                                    echo '<li><a href="' . esc_url($h->unload_set($s, 'metaProfileLink')) . '" title="" itemprop="url"><i class="fa ' . esc_attr($h->unload_set($s, 'metaProfileIcon')) . '"></i></a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="team-cap">
                                                    <h4 itemprop="name"><a href="<?php the_permalink() ?>"
                                                                           title="<?php the_title() ?>"
                                                                           itemprop="url"><?php the_title() ?></a></h4>
                                                    <?php if (!empty($des)): ?><span
                                                        itemprop="jobTitle"><?php echo esc_html($des) ?></span><?php endif; ?>
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
                            <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
