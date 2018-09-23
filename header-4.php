<?php $opt = (new unload_Helper())->unload_opt(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    $logo = (new unload_Helper())->unload_set($opt, 'optHeaderFourLogo');
    $theme = ((new unload_Helper())->unload_set($opt, 'optHeaderFourtheme') == '1') ? 'light' : '';
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
    <header class="fancy-header center-logo <?php echo esc_attr($theme) ?>">
        <div class="container">
            <div class="logo-menu">
                <div class="quick-contact">
                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderFourShowContactNo') == 1 || (new unload_Helper())->unload_set($opt, 'optHeaderFourShowContactEmail') == 1 || (new unload_Helper())->unload_set($opt, 'optHeaderFourShippingButton') == 1): ?>
                        <ul>
                            <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderFourShowContactNo') == 1): ?>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderFourContactNo')) ?></span>
                                    <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderFourContactNoBottom')) ?></p>
                                </li>
                            <?php endif; ?>
                            <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderFourShowContactEmail') == 1): ?>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderFourContactEmail')) ?></span>
                                    <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderFourContactEmailBottom')) ?></p>
                                </li>
                            <?php endif; ?>
                            <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderFourShippingButton') == 1): ?>
                                <li>
                                    <input type="hidden" id="request_a_rate" value="<?php echo wp_create_nonce(Unload_KEY); ?>">
                                    <a id="shipping_calc" href="javascript:void(0)" title="" itemprop="url"
                                       class="theme-btn popup2">
                                        <?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderFourShippingButtonText')) ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="logo">
                    <a itemprop="url" href="<?php echo esc_url(home_url('/')) ?>" title="">
                        <img itemprop="image"
                             src="<?php echo esc_url((new unload_Helper())->unload_set($logo, 'url')) ?>" alt=""/>
                    </a>
                </div>
                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderFourTopBarSocialMedia') == 1): ?>
                    <div class="centerlogo-socialmedia">
                        <ul class="social-btns2">
                            <?php
                            $social = (new unload_Helper())->unload_set($opt, 'optHeaderFourTopBarSocialicons');
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
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <nav class="menu-curve">
                <?php
                wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'container' => ''));
                ?>
            </nav>
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