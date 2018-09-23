<?php
(new unload_Helper())->unload_header();
global $wp_query;
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$h = new unload_Helper();
$tp = 'Blog';
$img = $h->unload_set($opt, 'opt' . $tp . 'Img');
$date = $h->unload_set($opt, 'opt' . $tp . 'Date');
$titleSec = $h->unload_set($opt, 'opt' . $tp . 'Title');
$content = $h->unload_set($opt, 'opt' . $tp . 'Content');
$comment = $h->unload_set($opt, 'opt' . $tp . 'Comment');
$author = $h->unload_set($opt, 'opt' . $tp . 'Author');
$theme = $h->unload_set($opt, 'opt' . $tp . 'Theme');

$queried_object = get_queried_object();
if ($h->unload_set($queried_object, 'ID')) {
    $id = $h->unload_set($queried_object, 'ID');
    $status = (get_post_meta($id, 'metaHeader', true)) ? get_post_meta($id, 'metaHeader', true) : $h->unload_set($opt, 'optBlogHeader');
    $title = (get_post_meta($id, 'metaHeaderTitle', true)) ? get_post_meta($id, 'metaHeaderTitle', true) : $h->unload_set($opt, 'optBlogHeaderTitle');
    $subtitle = get_post_meta($id, 'metaHeaderSubTitle', true);
    $sidebar = (get_post_meta($id, 'metaSidebar', true)) ? get_post_meta($id, 'metaSidebar', true) : "";
    $layout = (get_post_meta($id, 'metaSidebarLayout')) ? get_post_meta($id, 'metaSidebarLayout', true) : "";
    $column = ($layout == "full" || $layout == "none") ? "col-md-12" : 'col-md-8';
    $bg = get_post_meta($id, 'metaHeaderBg', true);
    $bg = (get_post_meta($id, 'metaHeaderBg', true)) ? get_post_meta($id, 'metaHeaderBg', true) : $h->unload_set($h->unload_set($opt, 'optBlogHeaderBg'), 'url');
} else {
    $status = ($h->unload_set($opt, 'optBlogHeader')) ? $h->unload_set($opt, 'optBlogHeader') : 'on';
    $title = ($h->unload_set($opt, 'optBlogHeaderTitle')) ? $h->unload_set($opt, 'optBlogHeaderTitle') : esc_html__("Blog Posts", 'unload');
    $subtitle = ($h->unload_set($opt, 'optBlogHeaderSubTitle')) ? $h->unload_set($opt, 'optBlogHeaderSubTitle') : '';
    $sidebar = ($h->unload_set($opt, 'optBlogSidebar')) ? $h->unload_set($opt, 'optBlogSidebar') : "primary-widget-area";
    $layout = ($h->unload_set($opt, 'optBlogLayout')) ? $h->unload_set($opt, 'optBlogLayout') : "right";
    $column = ($layout == "full" || $layout == "none") ? "col-md-12" : 'col-md-8';
    $bg = ($h->unload_set($h->unload_set($opt, 'optBlogHeaderBg'), 'url')) ? $h->unload_set($h->unload_set($opt, 'optBlogHeaderBg'), 'url') : '';
}
$sizeMange = ($theme == '1col') ? 'unload_1170x593' : 'unload_570x423';
if ($status == 'on' || $status == '1'):
    ?>
    <div class="page-top blackish overlape">
        <div class="parallax" data-velocity="-.1"
             style="background: url(<?php echo esc_url($bg) ?>) repeat scroll 0 0"></div>
        <div class="container">
            <div class="page-title">
                <?php if (!empty($subtitle)): ?>
                    <span><?php echo esc_html($subtitle) ?></span>
                <?php endif; ?>
                <?php if (!empty($title)): ?>
                    <h3><?php echo esc_html($title) ?></h3>
                <?php endif; ?>
            </div><!-- Page Title -->
        </div>
    </div>
    <?php
endif;
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin <?php echo esc_attr(($theme == '1col') ? 'blog-list-main' : '') ?>">
                        <div class="row">
                            <?php
                            if ($layout == 'left' && !empty($sidebar) && is_active_sidebar($sidebar)) {
                                echo '<div class="col-md-4">';
                                dynamic_sidebar($sidebar);
                                echo '</div>';
                            }
                            ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <?php
                                while (have_posts()) {
                                    the_post();
                                    if ($theme != '1col') {
                                        echo '<div class="' . $theme . '">';
                                    }
                                    if (has_post_thumbnail()) {
                                        $colClass = ($theme != '1col') ? 'news-box blog-list' : 'news-box';
                                    } else {
                                        $colClass = ($theme != '1col') ? 'news-box blog-list no-img' : 'news-box';
                                    }
                                    ?>
                                    <div <?php post_class($colClass) ?>>
                                        <?php if ($img == '1' || $date == '1'): ?>
                                            <div class="news-thumb">
                                                <?php if (has_post_thumbnail() && $img == '1'): ?>
                                                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"
                                                       itemprop="url">
                                                        <?php the_post_thumbnail($sizeMange) ?>
                                                    </a>
                                                <?php endif; ?>
                                                <?php
                                                if ($date == '1'):
                                                    if (get_the_title() == '') {
                                                        echo '<a href="' . get_the_permalink() . '">';
                                                    }
                                                    ?>
                                                    <div class="date">
                                                        <strong><?php echo get_the_date('d') ?></strong>
                                                        <span><?php echo get_the_date('F') ?></span>
                                                    </div>
                                                    <?php
                                                    if (get_the_title() == '') {
                                                        echo '</a>';
                                                    }
                                                endif;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($titleSec == '1' || $content == '1' || $comment == '1' || $author == '1'): ?>
                                            <div class="news-detail">
                                                <?php if ($titleSec == '1'): ?>
                                                    <h2 itemprop="headline">
                                                        <a itemprop="url" href="<?php the_permalink() ?>"
                                                           title="<?php the_title() ?>">
                                                            <?php the_title() ?>
                                                        </a>
                                                    </h2>
                                                <?php endif; ?>
                                                <?php if ($content == '1'): ?>
                                                    <p itemprop="description"><?php echo get_the_excerpt(get_the_ID()) ?></p>
                                                <?php endif; ?>
                                                <?php if ($comment == '1' || $author == '1'): ?>
                                                    <ul class="post-meta2">
                                                        <?php if ($comment == '1'): ?>
                                                            <li>
                                                                <i class="fa fa-comments"></i>
                                                                <a title="" href="<?php the_permalink() ?>">
                                                                    <?php $h->unload_comments(get_the_ID()) ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if ($author == '1'): ?>
                                                            <li>
                                                                <i class="fa fa-user"></i>
                                                                <?php esc_html_e('By ', 'unload') ?>
                                                                <a itemprop="url" title=""
                                                                   href="<?php $h->unload_authorLink() ?>">
                                                                    <?php echo ucfirst(get_the_author()) ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    if ($theme != '1col') {
                                        echo '</div>';
                                    }
                                }
                                $h->unload_pagi(array('total' => $wp_query->max_num_pages));
                                ?>
                            </div>
                            <?php
                            if ($layout == 'right' && !empty($sidebar) && is_active_sidebar($sidebar)) {
                                echo '<div class="col-md-4">';
                                dynamic_sidebar($sidebar);
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
