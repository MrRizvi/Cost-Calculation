<?php

$opt = (new unload_Helper())->unload_opt();
$h = new unload_Helper();

$style = array(
    'bootstrap' => 'css/bootstrap.css',
    'owl-carousel' => 'css/owl.carousel.css',
    'icons' => 'css/font-awesome.min.css',
    'Source-Sans-Pro' => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic',
    'select2' => 'css/select2.min.css',
    'circliful' => 'css/jquery.circliful.css',
    'scrollbar' => 'css/perfect-scrollbar.css',
    'animate' => 'css/animate.min.css',
    'style' => 'css/style.css',
    'responsive' => 'css/responsive.css'
);
unload_ThemeInit::unload_singleton()->unload_storeSetting($style, 'themeStyles');
$mapKey = $h->unload_set($opt, 'optGoogleMapApiKey');
$scripts = array(
    'modernizr' => 'js/modernizr-2.0.6.js',
    'bootstrap' => 'js/bootstrap.min.js',
    'scrolltopcontrol' => 'js/scrolltopcontrol.js',
    'scroll-up-bar' => 'js/scroll-up-bar.js',
    'scrolly' => 'js/jquery.scrolly.js',
    'owl' => 'js/owl.carousel.min.js',
    'icheck' => 'js/icheck.js',
    'counter' => 'js/jquery.counterup.min.js',
    'datepick' => 'js/jquery.datepick.js',
    'jplugin' => 'js/jquery.plugin.js',
    'poptrox' => 'js/jquery.poptrox.min.js',
    'isotop' => 'js/jquery.isotope.js',
    'waypoints' => 'js/waypoints.js',
    'select2' => 'js/select2.full.js',
    'circliful' => 'js/jquery.circliful.min.js',
    'perfect-scrollbar' => 'js/perfect-scrollbar.js',
    'perfect-scrollbar-js' => 'js/perfect-scrollbar.jquery.js',
    'map' => 'https://maps.googleapis.com/maps/api/js?key=' . $mapKey . '&v=3.exp',
    'recaptcha' => 'https://www.google.com/recaptcha/api.js',
    'countries' => 'js/countries.js',
    'imagesloaded' => 'js/imagesloaded.js',
    'sticky-kit' => 'js/jquery.sticky-kit.min.js',
    'script' => 'js/script.js'
);
unload_ThemeInit::unload_singleton()->unload_storeSetting($scripts, 'themeScript');

$adminStyles = array(
    'admin-style' => 'css/admin/style.css',
    'dashicons' => 'css/admin/dashicons.css',
    'vc-toggle' => 'css/admin/toggle.css',
    'jquery-ui' => 'css/admin/jquery-ui.css',
);
unload_ThemeInit::unload_singleton()->unload_storeSetting($adminStyles, 'adminStyles');

$fileArray = array(
    'general_settings' => array(
        'header_settings',
        'headerres_settings',
        'footer_settings',
        'signup_settings',
        'newsletter_settings',
        'script_settings'
    ),
    'template_settings' => array(
        'blog_settings',
        'blogsingle_settings',
        'archive_settings',
        'author_settings',
        'category_settings',
        'tag_settings',
        'search_settings',
        '404_settings',
    ),
    'booking_settings' => array(),
    'shippingcalc_settings' => array(),
    'footerbuilder_settings' => array(),
    'contact_settings' => array(),
    'sidebar_settings' => array(),
    'language_settings' => array(),
    'typography_settings' => array(
        'bodytypography_settings',
        'h1typography_settings',
        'h2typography_settings',
        'h3typography_settings',
        'h4typography_settings',
        'h5typography_settings',
        'h6typography_settings'
    ),
);
unload_ThemeInit::unload_singleton()->unload_storeSetting($fileArray, 'optionsArray');

$socialProfiler = array(
    'adn' => 'fa-adn',
    'android' => 'fa-android',
    'apple' => 'fa-apple',
    'behance' => 'fa-behance',
    'behance_square' => 'fa-behance-square',
    'bitbucket' => 'fa-bitbucket',
    'bitcoin' => 'fa-btc',
    'css3' => 'fa-css3',
    'delicious' => 'fa-delicious',
    'deviantart' => 'fa-deviantart',
    'dribbble' => 'fa-dribbble',
    'dropbox' => 'fa-dropbox',
    'drupal' => 'fa-drupal',
    'empire' => 'fa-empire',
    'facebook' => 'fa-facebook',
    'four_square' => 'fa-foursquare',
    'git_square' => 'fa-git-square',
    'github' => 'fa-github',
    'github_alt' => 'fa-github',
    'github_square' => 'fa-github-square',
    'git_tip' => 'fa-gittip',
    'google' => 'fa-google',
    'google_plus' => 'fa-google-plus',
    'google_plus_square' => 'fa-google-plus-square',
    'hacker_news' => 'fa-hacker-news',
    'html5' => 'fa-html5',
    'instagram' => 'fa-instagram',
    'joomla' => 'fa-joomla',
    'js_fiddle' => 'fa-jsfiddle',
    'linkedIn' => 'fa-linkedin',
    'linkedIn_square' => 'fa-linkedin-square',
    'linux' => 'fa-linux',
    'MaxCDN' => 'fa-maxcdn',
    'OpenID' => 'fa-openid',
    'page_lines' => 'fa-pagelines',
    'pied_piper' => 'fa-pied-piper',
    'pinterest' => 'fa-pinterest',
    'pinterest_square' => 'fa-pinterest-square',
    'QQ' => 'fa-qq',
    'rebel' => 'fa-rebel',
    'reddit' => 'fa-reddit',
    'reddit_square' => 'fa-reddit-square',
    'ren-ren' => 'fa-renren',
    'share_alt' => 'fa-share-alt',
    'share_square' => 'fa-share-alt-square',
    'skype' => 'fa-skype',
    'slack' => 'fa-slack',
    'sound_cloud' => 'fa-soundcloud',
    'spotify' => 'fa-spotify',
    'stack_exchange' => 'fa-stack-exchange',
    'stack_overflow' => 'fa-stack-overflow',
    'steam' => 'fa-steam',
    'steam_square' => 'fa-steam-square',
    'stumble_upon' => 'fa-stumbleupon',
    'stumble_upon_circle' => 'fa-stumbleupon-circle',
    'tencent_weibo' => 'fa-tencent-weibo',
    'trello' => 'fa-trello',
    'tumblr' => 'fa-tumblr',
    'tumblr_square' => 'fa-tumblr-square',
    'twitter' => 'fa-twitter',
    'twitter_square' => 'fa-twitter-square',
    'vimeo_square' => 'fa-vimeo-square',
    'vine' => 'fa-vine',
    'vK' => 'fa-vk',
    'weibo' => 'fa-weibo',
    'weixin' => 'fa-weixin',
    'windows' => 'fa-windows',
    'wordPress' => 'fa-wordpress',
    'xing' => 'fa-xing',
    'xing_square' => 'fa-xing-square',
    'yahoo' => 'fa-yahoo',
    'yelp' => 'fa-yelp',
    'youTube' => 'fa-youtube',
    'youTube_play' => 'fa-youtube-play',
    'youTube_square' => 'fa-youtube-square',
);
unload_ThemeInit::unload_singleton()->unload_storeSetting($socialProfiler, 'socialProfiler');


add_filter('widget_title', 'unloadOverwriteTitle', 10, 3);

function unloadOverwriteTitle($title, $instance, $id_base)
{
    $opt = (new unload_Helper())->unload_opt();
    $H = new unload_Helper;
    $default = array(
        'archives',
        'calendar',
        'categories',
        'nav_menu',
        'meta',
        'pages',
        'recent-comments',
        'recent-posts',
        'tag_cloud',
        'text',
        'search'
    );
    $unload = array(
        'unload-recent-news',
        'unload-recent-posts',
        'unload-video',
        'unload-gallery',
        'unload-newsletter'
    );
    if (in_array($id_base, $default)) {
        $subTitle = (new unload_Helper())->unload_set($opt, 'optSidebarWidget' . $id_base);

        return '<span>' . $subTitle . '</span><h3>' . $title . '</h3>';
    } else if (in_array($id_base, $unload)) {
        return '<span>' . $H->unload_set($instance, 'subtitle') . '</span><h3>' . $title . '</h3>';
    } else {
        if ($id_base == 'rss') {
            return $title;
        } else {
            return balanceTags('<span></span><h3>' . $title . '</h3>');
        }
    }
}

add_filter('get_avatar', 'unload_AvatarCss');

function unload_AvatarCss($class)
{
    $class = str_replace("class='avatar", "class='  ", $class);

    return $class;
}

add_filter('comment_reply_link', 'unload_replyLinkClass');

function unload_replyLinkClass($class)
{
    $class = str_replace("class='comment-reply-link", "class='theme-btn", $class);

    return $class;
}
