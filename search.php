<?php
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$column = (new unload_Helper())->unload_column('', 'optSearchLayout', 'optSearchSidebar');
$h = new unload_Helper();
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-found">
                        <?php if (have_posts()): ?>
                            <div class="search-bar">
                                <label><?php esc_html__('Refine Your Search', 'unload') ?>:</label>
                                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input name="s" type="text"
                                                   placeholder="<?php esc_html_e('Enter your Keyword', 'unload') ?>"/>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="theme-btn"><i
                                                    class="fa fa-paper-plane"></i> <?php esc_html_e('SEARCH NOW', 'unload') ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <h4><?php esc_html_e('Search Results Found', 'unload') ?>:
                                    <span>"<?php echo get_search_query(); ?>"</span></h4>
                            </div>
                        <?php endif; ?>
                        <div class="top-margin">
                            <div class="row">
                                <?php
                                if (have_posts()) {
                                    $h->unload_themeLeftSidebar('', 'optSearchLayout', 'optSearchSidebar');
                                }
                                if (have_posts()) {
                                    $column = $column;
                                } else {
                                    $column = 'col-md-12';
                                }
                                ?>
                                <div class="<?php echo esc_attr($column) ?>">
                                    <?php
                                    if (have_posts()) {
                                        get_template_part('blog-content');
                                    } else {
                                        ?>
                                        <div class="not-found">
                                            <div class="notfound-content">
                                                <h3><?php esc_html_e('S', 'unload') ?><img
                                                        src="<?php echo esc_url(unload_Uri . 'partial/images/not-found.png') ?>"
                                                        alt=""/>rry</h3>
                                                <strong><?php esc_html_e('No Record Found', 'unload') ?></strong>
                                                <span><?php esc_html_e('The Link Might Be Corrupted ', 'unload') ?>
                                                    <strong><?php esc_html_e('OR', 'unload') ?></strong> <i><?php esc_html_e(' The Page May Have Been Removed', 'unload') ?></i></span>
                                                <a href="<?php echo esc_url(home_url('/')); ?>" title=""
                                                   class="theme-btn"><i
                                                        class="fa fa-paper-plane"></i> <?php esc_html_e('GO BACK HOME', 'unload') ?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if (have_posts()) {
                                    $h->unload_themeRightSidebar('', 'optSearchLayout', 'optSearchSidebar');
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
get_footer();
