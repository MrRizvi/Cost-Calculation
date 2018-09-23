<?php
global $wp_query;
$h = new unload_Helper;
$h->unload_header();
$opt = $h->unload_opt();
$h->unload_headerTop(get_the_ID());
?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 column">
                    <div class="not-found error-page">
                        <div class="notfound-content">
                            <h3>4<img src="<?php echo esc_url(unload_Uri . 'partial/images/error-img.png') ?>" alt=""/>4
                            </h3>
                            <strong><?php echo esc_html($h->unload_set($opt, 'opt404Text')) ?></strong>
                            <?php echo balanceTags($h->unload_set($opt, 'opt404SubText')) ?>
                            <?php if ($h->unload_set($opt, 'opt404Button') == '1'): ?>
                                <a href="<?php echo esc_url(home_url('/')) ?>" title="" class="theme-btn"><i
                                        class="fa fa-paper-plane"></i> <?php echo esc_html($h->unload_set($opt, 'opt404BtnText')) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
