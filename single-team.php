<?php
(new unload_Helper())->unload_header();
while (have_posts()) {
    the_post();
    $opt = (new unload_Helper())->unload_opt();
    (new unload_Helper())->unload_headerTop(get_the_ID());
    $h = new unload_Helper();
    $column = $h->unload_column(get_the_ID());
    $col = ($h->unload_set($opt, 'optOfficeInfo') == '1') ? 'col-md-8' : 'col-md-12';
    $bg = $h->unload_set($opt, 'optOfficeInfoBg');
    $isOffice = $h->unload_m('metaOffice');

    if ($col == 'col-md-8' && $column == 'col-md-12') {
        $ofcInfo = 'col-md-4';
        $content = 'col-md-8';
    } else if ($col == 'col-md-8' && $column == 'col-md-8') {
        $ofcInfo = 'col-md-6';
        $content = 'col-md-6';
    }
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <?php $h->unload_themeLeftSidebar(get_the_ID()) ?>
                <div class="<?php echo esc_attr($column) ?>">
                    <div class="">
                        <div class="team-detail-thumb">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full');
                            }
                            ?>
                        </div>
                        <div class="row">
                            <?php if ($col == 'col-md-8' && $isOffice == 'on'): ?>
                                <div class="<?php echo esc_attr($ofcInfo) ?>">
                                    <div class="region-contact-info team-detail-info"
                                         style="background: url(<?php echo esc_url($h->unload_set($bg, 'url')) ?>)">
                                        <div class="heading2">
                                            <span><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoSubTitle')) ?></span>
                                            <h3><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoTitle')) ?></h3>
                                        </div>
                                        <?php if ($h->unload_set($opt, 'optOfficeInfoAddress') != ''): ?>
                                            <p><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoAddress')) ?></p>
                                        <?php endif; ?>
                                        <div class="contact-detail">
                                            <?php if (count($h->unload_set($opt, 'optOfficeInfoAddress')) > 0): ?>
                                                <span class="contact">
													<i class="fa fa-mobile"></i>
													<strong><?php esc_html_e('Phone No', 'unload') ?></strong>
                                                    <?php
                                                    foreach ($h->unload_set($opt, 'optOfficeInfoContact') as $c):
                                                        echo '<span>' . $c . '</span>';
                                                        ?>
                                                    <?php endforeach; ?>
												</span>
                                            <?php endif; ?>
                                            <?php if ($h->unload_set($opt, 'optOfficeInfoEmail') != ''): ?>
                                                <span class="contact">
													<i class="fa fa-envelope"></i>
													<strong><?php esc_html_e('Email Address', 'unload') ?></strong>
													<span><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoEmail')) ?></span>
												</span>
                                            <?php endif; ?>
                                            <?php if ($h->unload_set($opt, 'optOfficeInfoTiming') != ''): ?>
                                                <span class="contact">
													<i class="fa fa-clock-o"></i>
													<strong><?php esc_html_e('Office Timing', 'unload') ?></strong>
													<span><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoTiming')) ?></span>
												</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="<?php echo esc_attr(($isOffice != 'on') ? 'col-md-12' : $content) ?>">
                                <div class="team-detail-content">
                                    <?php the_content() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $h->unload_themeRightSidebar(get_the_ID()) ?>
            </div>
        </div>
    </section>
    <?php
}

get_footer();
