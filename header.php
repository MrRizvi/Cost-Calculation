<?php $opt = (new unload_Helper())->unload_opt(); ?>
<!DOCTYPE>
<html <?php language_attributes(); ?>>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php
        $logo = (new unload_Helper())->unload_set($opt, 'optHeaderOneLogo');
        $headercolor = (new unload_Helper())->unload_set($opt, 'optHeaderColor');
        $theme = ((new unload_Helper())->unload_set($opt, 'optHeaderOnetheme') == '1') ? 'header2' : '';
        $sticky = ((new unload_Helper())->unload_set($opt, 'optHeaderOneSticky') === '1') ? 'stick' : '';
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
            <header class="fancy-header scrollup <?php echo esc_attr($sticky) ?> <?php echo esc_attr($theme) ?>">
                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBar') == 1): ?>
                    <div class="top-sec" style="<?php echo unload_set($opt, 'header_code');?>">
                        <div class="top-bar">
                            <div class="container">
                                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarTiming') == 1): ?>
                                    <span class="cargo-time"><i
                                            class="fa fa-clock-o"></i><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarTimingText')) ?></span>
                                    <?php endif; ?>
                                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderSearch') == 1): ?>
                        
                                        <div class="widget-data header1-search">
                                            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                                <input type="text" placeholder="<?php esc_attr_e('SEARCH', 'unload'); ?>" name="s"
                                                       value="<?php echo get_search_query(); ?>">
                                                <button type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                   
                                <?php endif; ?>
                                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarSocialMedia') == 1): ?>
                                    <div class="connect-us">
                                        <ul class="social-btn">
                                            <?php
                                            $social = (new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarSocialicons');
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
                                <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarSignin') == 1 || (new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarFormLink') == 1): ?>
                                    <div class="extra-links">
                                        <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarFormLink') == 1): ?>
                                            <a itemprop="url" href="<?php echo esc_url($support) ?>"
                                               title=""><?php esc_html_e('Support', 'unload') ?></a>
                                           <?php endif; ?>
                                           <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarSignin') == 1 && (new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarFormLink') == 1): ?>
                                            /
                                        <?php endif; ?>
                                        <?php
                                        if ((new unload_Helper())->unload_set($opt, 'optHeaderOneTopBarSignin') == 1):
                                            if (is_user_logged_in() === TRUE) {
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
                        </div>
                    </div><!-- Top Sec -->
                <?php endif; ?>
                <div class="logo-menu-sec">
                    <div class="logo-menu" <?php if($headercolor != ''){?>
                        <?php echo 'style="background-color:' .$headercolor.'"'; } ?>
                        >
                        <div class="logo">

                            <?php
                            if ((new unload_Helper())->unload_set($logo, 'url') == ''):
                                if (is_front_page() && is_home()) :
                                    ?>
                                    <h1><a href="<?php echo esc_url(home_url('/')); ?>"
                                           rel="home"><?php bloginfo('name'); ?></a></h1>
                                    <?php else : ?>
                                    <p><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                    </p>
                                <?php
                                endif;
                            else:
                                ?>
                                <a itemprop="url" href="<?php echo esc_url(home_url('/')) ?>" title="">
                                    <img itemprop="image"
                                         src="<?php echo esc_url((new unload_Helper())->unload_set($logo, 'url')) ?>" alt=""/>
                                </a>
                            <?php endif; ?>

                        </div>
                        <div class="quick-contact">
                            <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneShowContactNo') == 1 || (new unload_Helper())->unload_set($opt, 'optHeaderOneShowContactEmail') == 1 || (new unload_Helper())->unload_set($opt, 'optHeaderOneShippingButton') == 1): ?>
                                <ul>
                                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneShowContactNo') == 1): ?>
                                        <li>
                                            <i class="fa fa-phone"></i>
                                            <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderOneContactNo')) ?></span>
                                            <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderOneContactNoBottom')) ?></p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneShowContactEmail') == 1): ?>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderOneContactEmail')) ?></span>
                                            <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderOneContactEmailBottom')) ?></p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ((new unload_Helper())->unload_set($opt, 'optHeaderOneShippingButton') == 1): ?>
                                        <li>
                                            <input type="hidden" id="request_a_rate" value="<?php echo wp_create_nonce(Unload_KEY); ?>">
                                            <a id="shipping_calc" href="javascript:void(0)" title="" itemprop="url"
                                               class="theme-btn popup2">
                                                   <?php echo esc_html((new unload_Helper())->unload_set($opt, 'optHeaderOneShippingButtonText')) ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <nav class="menu-curve">
                        <?php
                        wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'container' => ''));
                        ?>
                    </nav>
                </div><!--Logo Menu Sec -->
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