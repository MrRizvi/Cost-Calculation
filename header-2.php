<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    $opt = (new unload_Helper())->unload_opt();
    $logo = (new unload_Helper())->unload_set($opt, 'optHeaderTwoLogo');
    $sticky = ((new unload_Helper())->unload_set($opt, 'optHeaderTwoSticky') === '1') ? 'stick' : '';
    $getSuport = (new unload_Helper)->unload_tpl('tpl-contact.php');
    $support = (!empty($getSuport)) ? get_page_link($getSuport->ID) : '';
    wp_head();
    ?>
</head>

<body itemscope="" <?php body_class(); ?>>
<div class="preloader">
    <div class="preloader-container">
        <span class="animated-preloader"></span>
    </div>
</div>
<div class="theme-layout">
    <header class="simple-header <?php echo esc_attr($sticky) ?>">
        <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBar') == 1): ?>
            <div class="top-bar">
                <div class="container">
                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarTiming') == 1): ?>
                        <span class="cargo-time"><i
                                class="fa fa-clock-o"></i><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarTimingText')) ?></span>
                    <?php endif; ?>
                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderSearch') == 1): ?>
                        
                                        <div class="widget-data header2-search">
                                            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                                <input type="text" placeholder="<?php esc_attr_e('SEARCH', 'unload'); ?>" name="s"
                                                       value="<?php echo get_search_query(); ?>">
                                                <button type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                   
                                <?php endif; ?>
                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarSocialMedia') == 1): ?>
                        <div class="connect-us">
                            <ul class="social-btn">
                                <?php
                                $social = (new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarSocialicons');
                                if (!empty($social) && count($social) > 0):
                                    foreach ($social as $s):
                                        $data = json_decode(urldecode((new unload_Helper())->unload_set($s, 'data')));
                                        if ($data->enable == 'true'):
                                            ?>
                                            <li>
                                                <a itemprop="url" href="<?php echo esc_url($data->url) ?>">
                                                    <i class="fa <?php echo esc_attr($data->icon) ?>"></i>
                                                </a>
                                            </li>
                                            <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarSignin') == 1 || (new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarFormLink') == 1): ?>
                        <div class="extra-links">
                            <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarFormLink') == 1): ?>
                                <a itemprop="url" href="<?php echo esc_url($support) ?>"
                                   title=""><?php esc_html_e('Support', 'unload') ?></a>
                            <?php endif; ?>
                            <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarSignin') == 1 && (new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarFormLink') == 1): ?>
                                /
                            <?php endif; ?>
                            <?php
                            if ((new unload_Helper())->unload_set($opt, 'optHeaderTwoTopBarSignin') == 1):
                                if (is_user_logged_in()) {
                                    ?>
                                    <a itemprop="url" href="<?php echo esc_url(wp_logout_url(home_url('/'))) ?>"
                                       title=""><?php esc_html_e('Sign Out', 'unload') ?></a>
                                    <?php
                                } else {
                                    ?>
                                    <a itemprop="url" href="javascript:void(0)" title=""
                                       class="popup1"><?php esc_html_e('Sign In', 'unload') ?></a>
                                    <?php
                                }
                            endif;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div><!-- Top Sec -->
        <?php endif; ?>
        <div class="menubar">
            <div class="container">
                <div class="logo">
                    <a itemprop="url" href="<?php echo esc_url(home_url('/')) ?>" title="">
                        <img itemprop="image"
                             src="<?php echo esc_url((new unload_Helper())->unload_set($logo, 'url')) ?>" alt=""/>
                    </a>
                </div>
                <nav>
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'container' => ''));
                    }
                    ?>
                </nav>
            </div><!--Logo Menu Sec -->
        </div>
    </header>
    <?php (new unload_Helper)->unload_resHader(); ?>
    <?php (new unload_Helper)->unload_regPopup(); ?>

    <div class="modal fade" id="submission-message" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="submission-data">
                        <span><img src="<?php echo unload_Uri ?>partial/images/submission.png" alt=""/></span>
                        <h1><?php esc_html_e('SUBMISSION SUCCESSFUL', 'unload') ?></h1>
                        <p><?php esc_html_e('Thank You For Your Booking With Unload. We Have Sent you a Message Shortly.', 'unload') ?></p>
                        <a href="javascript:void(0)" title="" class="theme-btn" data-dismiss="modal" aria-label="Close"><i
                                class="fa fa-paper-plane"></i><?php esc_html_e('DONE', 'unload') ?></a>
                    </div><!-- Submission-data -->
                </div>
            </div>
        </div>
    </div>