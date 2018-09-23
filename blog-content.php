<?php
$opt = (new unload_Helper())->unload_opt();
$h = new unload_Helper();
$tp = '';
if (is_archive()) {
    $tp = 'Archive';
}
if (is_author()) {
    $tp = 'Author';
}
if (is_category()) {
    $tp = 'Category';
}
if (is_tag()) {
    $tp = 'Tag';
}
if (is_search()) {
    $tp = 'Search';
}
$img = $h->unload_set($opt, 'opt' . $tp . 'Img');
$date = $h->unload_set($opt, 'opt' . $tp . 'Date');
$title = $h->unload_set($opt, 'opt' . $tp . 'Title');
$content = $h->unload_set($opt, 'opt' . $tp . 'Content');
$comment = $h->unload_set($opt, 'opt' . $tp . 'Comment');
$author = $h->unload_set($opt, 'opt' . $tp . 'Author');
$theme = $h->unload_set($opt, 'opt' . $tp . 'Theme');

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
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" itemprop="url">
                        <?php the_post_thumbnail('unload_570x423') ?>
                    </a>
                <?php endif; ?>
                <?php if ($date == '1'): ?>
                    <div class="date">
                        <strong><?php echo get_the_date('d') ?></strong>
                        <span><?php echo get_the_date('F') ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ($title == '1' || $content == '1' || $comment == '1' || $author == '1'): ?>
            <div class="news-detail">
                <?php if ($title == '1'): ?>
                    <h2 itemprop="headline">
                        <a itemprop="url" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                            <?php the_title() ?>
                        </a>
                    </h2>
                <?php endif; ?>
                <?php if ($content == '1'): ?>
                    <p itemprop="description"><?php echo get_the_excerpt() ?></p>
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
                                <a itemprop="url" title="" href="<?php $h->unload_authorLink() ?>">
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