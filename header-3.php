<?php $opt = (new unload_Helper())->unload_opt(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    $logo = (new unload_Helper())->unload_set($opt, 'optHeaderThreeLogo');
    $sticky = ((new unload_Helper())->unload_set($opt, 'optHeaderThreeSticky') === '1') ? 'stick' : '';
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
    <header class="fancy-header header3 transparent <?php echo esc_attr($sticky) ?>">
        <div class="full-width-nav">
            <div class="container">
                <nav class="menu-curve">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'container' => ''));
                    }
                    ?>
                </nav>
            </div>
        </div>
        <div class="logo-menu-sec">
            <div class="container">
                <div class="logo-menu">
                    <div class="logo">
                        <a itemprop="url" href="<?php echo esc_url(home_url('/')) ?>" title="">
                            <img itemprop="image"
                                 src="<?php echo esc_url((new unload_Helper())->unload_set($logo, 'url')) ?>" alt=""/>
                        </a>
                    </div>
                    
                    <div class="quick-contact">
                        <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderThreeShowContactNo') == '1' || (new unload_Helper())->unload_set($opt, 'optHeaderThreeContactEmail') == '1' || (new unload_Helper())->unload_set($opt, 'optHeaderOneShippingButton') == '1'): ?>
                            <ul>
                                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderThreeShowContactNo') == '1'): ?>
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderThreeContactNo')) ?></span>
                                        <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderThreeContactNoBottom')) ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderThreeShowContactEmail') == '1'): ?>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderThreeContactEmail')) ?></span>
                                        <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderThreeContactEmailBottom')) ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderThreeShippingButton') == '1'): ?>
                                    <li>
                                        <a id="shipping_calc" href="javascript:void(0)" title="" itemprop="url"
                                           class="theme-btn popup2">
                                            <?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderThreeShippingButtonText')) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderSearch') == 1): ?>
                        
                                        <div class="widget-data header3-search">
                                            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                                <input type="text" placeholder="<?php esc_attr_e('SEARCH', 'unload'); ?>" name="s"
                                                       value="<?php echo get_search_query(); ?>">
                                                <button type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                   
                                <?php endif; ?>
                </div>
            </div>
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