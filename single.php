<?php
(new unload_Helper())->unload_header();
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $column = (new unload_Helper())->unload_column(get_the_ID(), 'optBlogSingleLayout', 'optBlogSingleSidebar');
    $h = new unload_Helper();
    $share = $h->unload_set($opt, 'optBlogSingleSocialShare');
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin blog-detail-main">
                        <div class="row">
                            <?php $h->unload_themeLeftSidebar(get_the_ID(), 'optBlogSingleLayout', 'optBlogSingleSidebar') ?>
                            <div class="<?php echo esc_attr($column) ?>">
                                <div class="news-box blog-detail">
                                    <?php if (has_post_thumbnail() && $h->unload_set($opt, 'optBlogSingleImg') == '1'): ?>
                                        <div class="news-thumb">
                                            <?php the_post_thumbnail('unload_1170x593') ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="news-detail">
                                        <?php if ($h->unload_set($opt, 'optBlogSingleTitle') == '1'): ?>
                                            <!--											<h3 itemprop="headline"><?php the_title() ?></h3>-->
                                        <?php endif; ?>
                                        <?php if ($h->unload_set($opt, 'optBlogSingleCat') == '1'): ?>
                                            <div class="cat-list">
                                                <span><i class="fa fa-random"></i></span>
                                                <ul>
                                                    <?php $h->unload_get_terms('category', 1000, 'li', true, '') ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($h->unload_set($opt, 'optBlogSingleShare') == '1' || $h->unload_set($opt, 'optBlogSingleDate') == '1' || $h->unload_set($opt, 'optBlogSingleAuthor') == '1' || $h->unload_set($opt, 'optBlogSingleComment') == '1'): ?>
                                            <div class="detail-info">
                                                <?php if ($h->unload_set($opt, 'optBlogSingleDate') == '1' || $h->unload_set($opt, 'optBlogSingleAuthor') == '1' || $h->unload_set($opt, 'optBlogSingleComment') == '1'): ?>
                                                    <ul class="post-meta2">
                                                        <?php if ($h->unload_set($opt, 'optBlogSingleDate') == '1'): ?>
                                                            <li><i class="fa fa-calendar-o"></i><a
                                                                content="<?php esc_html($h->unload_date()) ?>"
                                                                itemprop="datePublished" title=""
                                                                href="<?php esc_url($h->unload_dateLink()) ?>"><?php esc_html($h->unload_date()) ?></a>
                                                            </li><?php endif; ?>
                                                        <?php if ($h->unload_set($opt, 'optBlogSingleAuthor') == '1'): ?>
                                                            <li><i
                                                                class="fa fa-user"></i><?php esc_html_e('By ', 'unload') ?>
                                                            <a itemprop="url" title=""
                                                               href="<?php esc_url($h->unload_authorLink()) ?>"><?php ucfirst(the_author()) ?></a>
                                                            </li><?php endif; ?>
                                                        <?php if ($h->unload_set($opt, 'optBlogSingleComment') == '1'): ?>
                                                            <li><i class="fa fa-comment-o"></i><a itemprop="url"
                                                                                                  title=""
                                                                                                  href="javascript:void(0)"><?php echo esc_html($h->unload_comments(get_the_ID())) ?></a>
                                                            </li><?php endif; ?>
                                                    </ul>
                                                <?php endif; ?>
                                                <?php if ($h->unload_set($opt, 'optBlogSingleShare') == '1' && !empty($share)): ?>
                                                    <div class="share-it">
                                                        <span><?php esc_html_e('Share This Post', 'unload') ?>:</span>
                                                        <?php if (!empty($share) && count($share) > 0): ?>
                                                            <ul>
                                                                <?php $h->unlod_socialShare($share, false, false, true) ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php the_content() ?>
                                    <?php wp_link_pages(); ?>

                                    <?php if ($h->unload_set($opt, 'optBlogSingleTag') == '1' && has_tag()): ?>
                                        <div class="tags-div">
                                            <strong><?php esc_html_e('Tags Cloud', 'unload') ?>:</strong>
                                            <div class="cargo-tags">
                                                <?php $h->unload_getTags() ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php
                                if (comments_open() || get_comments_number(get_the_ID())) :
                                    comments_template();
                                endif;
                                ?>
                            </div>
                            <?php $h->unload_themeRightSidebar(get_the_ID(), 'optBlogSingleLayout', 'optBlogSingleSidebar') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
}
get_footer();
