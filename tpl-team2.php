<?php
// Template Name:	Team List Style 2
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$counter = 0;
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
                    <div id="members-sec">
                        <div class="members-area top-margin">
                            <?php
                            while ($query->have_posts()):
                                $query->the_post();
                                $social = $h->unload_m('metaSocialProfiler');
                                $des = $h->unload_m('metaDesignation');
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
                                            <h4 itemprop="name"><a href="<?php the_permalink() ?>"
                                                                   title="<?php the_title() ?>"
                                                                   itemprop="url"><?php the_title() ?></a></h4>
                                        </div>
                                    </div>
                                    <div class="member-detail">
                                        <div class="member-info">
                                            <?php if (!empty($des)): ?><span
                                                itemprop="jobTitle"><?php echo esc_html($des) ?></span><?php endif; ?>
                                            <h4 itemprop="name"><a href="<?php the_permalink() ?>"
                                                                   title="<?php the_title() ?>"
                                                                   itemprop="url"><?php the_title() ?></a></h4>
                                        </div>
                                        <p itemprop="description"><?php echo wp_trim_words(get_the_excerpt(get_the_ID()), 15, NULL); ?></p>
                                        <?php if (!empty($social) && count($social) > 0): ?>
                                            <ul class="social-btns">
                                                <?php
                                                foreach ($social as $s) {
                                                    echo '<li><a href="' . esc_url($h->unload_set($s, 'metaProfileLink')) . '" title="" itemprop="url"><i class="fa ' . esc_attr($h->unload_set($s, 'metaProfileIcon')) . '"></i></a></li>';
                                                }
                                                ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php
                                $counter++;
                                if ($counter == 3) {
                                    echo '</div><div class="members-area">';
                                    $counter = 0;
                                }
                            endwhile;
                            wp_reset_postdata();
                            $h->unload_pagi(array('total' => $query->max_num_pages));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
get_footer();
