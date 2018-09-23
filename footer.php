<?php
$h = new unload_Helper();
$opt = $h->unload_opt();
$bg = ($h->unload_set($opt, 'optFooterBg') != '') ? $h->unload_set($opt, 'optFooterBg') : '';
$isFooter = $h->unload_set($opt, 'optFooter');
if ($isFooter == '1'):
    ?>
    <div class="modal fade region2" id="region" tabindex="-1" role="dialog"></div>
    <footer>
        <section class="block">
            <div class="fixed-bg dark"
                 style="background: rgba(0, 0, 0, 0) url(<?php echo esc_url($h->unload_set($bg, 'url')) ?>) no-repeat center center;"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            $footer_builder = $h->unload_set($opt, 'optFooterBuilder');
                            if (!empty($footer_builder) && count($footer_builder) > 0) {
                                if ($h->unload_set($h->unload_set($footer_builder, '0'), 'input_field') != '') {
                                    foreach ($footer_builder as $f_side) {
                                        if ($h->unload_set($f_side, 'input_field') != '') {
                                            $widget = str_replace(' ', '-', strtolower($h->unload_set($f_side, 'input_field')));
                                            if (is_active_sidebar($widget)) {
                                                dynamic_sidebar($widget);
                                            }
                                        }
                                    }
                                } else if (is_active_sidebar('footer-widget-area')) {
                                    dynamic_sidebar('footer-widget-area');
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php if ($h->unload_set($opt, 'optFooterCopyright') != '' || $h->unload_set($opt, 'optFooterNav') == true): ?>
            <div class="bottom-line" style="<?php echo unload_set($opt, 'footer_css');?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 column">
                            <?php if ($h->unload_set($opt, 'optFooterCopyright') != ''): ?>
                                <span><?php echo balanceTags($h->unload_set($opt, 'optFooterCopyright')) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 column">
                            <?php
                            if ($h->unload_set($opt, 'optFooterNav') == true):
                                if (has_nav_menu('footer')) {
                                    wp_nav_menu(array('depth' => '1', 'theme_location' => 'footer', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'container' => ''));
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="blank"></div>
    </footer>
<?php endif; ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
