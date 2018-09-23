<?php

class unload_Helper
{

    public static function unload_singleton()
    {
        if (!isset(self::$instance)) {
            $obj = __CLASS__;
            self::$instance = new $obj;
        }

        return self::$instance;
    }

    static public function unload_posts($post_type)
    {
        $result = array();
        $args = array('post_type' => $post_type, 'post_status' => 'publish', 'posts_per_page' => -1,);
        $posts = get_posts($args);
        if ($posts) {
            foreach ($posts as $post) {
                $result[$post->ID] = $post->post_title;
            }
        }

        return $result;
    }

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;

        return FALSE;
    }

    public function unload_r($data)
    {
        echo '<pre>';
        print_r($data);
        exit;
    }

    public function unload_m($key, $id = '')
    {
        if (empty($id)) {
            $id = get_the_ID();
        }

        return (get_post_meta($id, $key, TRUE)) ? get_post_meta($id, $key, TRUE) : '';
    }

    public function unload_url($url = '')
    {
        if (strpos($url, 'http') === 0) {
            return $url;
        }

        return unload_Uri . 'partial/' . ltrim($url, '/');
    }

    public function unload_cat($arg = FALSE, $slug = FALSE, $vp = FALSE, $all = FALSE)
    {
        global $wp_taxonomies;
        $categories = get_categories($arg);
        $cats = array();
        if (self::unload_set($arg, 'show_all') && $vp) {
            $cats[] = array('value' => 'all', 'label' => esc_html__('All Categories', 'unload'));
        } elseif (self::unload_set($arg, 'show_all')) {
            $cats['all'] = esc_html__('All Categories', 'unload');
        }
        if (!self::unload_set($categories, 'errors')) {
            foreach ($categories as $category) {
                if ($vp) {
                    $key = ($slug) ? $category->slug : $category->term_id;
                    $cats[] = array('value' => $key, 'label' => $category->name);
                } else {
                    $key = ($slug) ? $category->slug : $category->term_id;
                    $cats[$key] = $category->name;
                }
            }
        }

        return $cats;
    }

    public function unload_set($var, $key, $def = '')
    {
        if (!$var) {
            return FALSE;
        }
        if (is_object($var) && isset($var->$key)) {
            return $var->$key;
        } elseif (is_array($var) && isset($var[$key])) {
            return $var[$key];
        } elseif ($def) {
            return $def;
        } else {
            return FALSE;
        }
    }

    public function unload_colorScheme($value)
    {
        ob_start();
        include(unload_Root . 'partial/css/colors/color.css');
        $content = ob_get_contents();
        ob_end_clean();
        if (empty($value)) {
            echo '<style type="text/css">' . $content . '</style>';
        } else {
            echo '<style type="text/css">' . str_replace('#ffb400', $value, $content) . '</style>';
        }
    }

    public function unload_sidebar()
    {
        $registerSidebar = get_option('sidebars_widgets');
        $this->unload_check($registerSidebar);
        array_pop($registerSidebar);
        array_shift($registerSidebar);
        $result = array();
        $keys = array_keys($registerSidebar);
        foreach ($keys as $key) {
            $remove = str_replace('-', ' ', $key);
            $result[$key] = ucwords($remove);
        }

        return $result;
    }

    public function unload_check($check)
    {
        if (!empty($check) && count($check) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function unload_header()
    {
        $opt = (new unload_Helper())->unload_opt();
        $header = ((new unload_Helper())->unload_set($opt, 'optHeaderStyle')) ? (new unload_Helper())->unload_set($opt, 'optHeaderStyle') : '';
        get_header($header);
    }

    public function unload_opt()
    {
        return get_option('theme_options');
    }

    public function unload_headerTop($id)
    {
        $opt = (new unload_Helper())->unload_opt();
        $h = new unload_Helper();
        $status = '';
        if (is_archive()) {
            $status = ($h->unload_set($opt, 'optArchiveHeader') == '1') ? 'on' : '';
            $title = ($h->unload_set($opt, 'optArchiveHeaderTitle') != '') ? $h->unload_set($opt, 'optArchiveHeaderTitle') : get_the_archive_title();
            $subtitle = $h->unload_set($opt, 'optArchiveHeaderSubTitle');
            $hasBg = $h->unload_set($opt, 'optArchiveHeaderBg');
            $bg = $h->unload_set($hasBg, 'url');
        }
        if (is_author()) {
            $status = ($h->unload_set($opt, 'optAuthorHeader') == '1') ? 'on' : '';
            $title = ($h->unload_set($opt, 'optAuthorHeaderTitle') != '') ? $h->unload_set($opt, 'optAuthorHeaderTitle') : '';
            $subtitle = $h->unload_set($opt, 'optAuthorHeaderSubTitle');
            $hasBg = $h->unload_set($opt, 'optAuthorHeaderBg');
            $bg = $h->unload_set($hasBg, 'url');
        }
        if (is_category()) {
            $status = ($h->unload_set($opt, 'optCategoryHeader') == '1') ? 'on' : '';
            $title = ($h->unload_set($opt, 'optCategoryHeaderTitle') != '') ? $h->unload_set($opt, 'optCategoryHeaderTitle') : '';
            $subtitle = $h->unload_set($opt, 'optCategoryHeaderSubTitle');
            $hasBg = $h->unload_set($opt, 'optCategoryHeaderBg');
            $bg = $h->unload_set($hasBg, 'url');
        }
        if (is_tag()) {
            $status = ($h->unload_set($opt, 'optTagHeader') == '1') ? 'on' : '';
            $title = ($h->unload_set($opt, 'optTagHeaderTitle') != '') ? $h->unload_set($opt, 'optTagHeaderTitle') : '';
            $subtitle = $h->unload_set($opt, 'optTagHeaderSubTitle');
            $hasBg = $h->unload_set($opt, 'optTagHeaderBg');
            $bg = $h->unload_set($hasBg, 'url');
        }
        if (is_search()) {
            $status = ($h->unload_set($opt, 'optSearchHeader') == '1') ? 'on' : '';
            $title = ($h->unload_set($opt, 'optSearchHeaderTitle') != '') ? $h->unload_set($opt, 'optSearchHeaderTitle') : '';
            $subtitle = $h->unload_set($opt, 'optSearchHeaderSubTitle');
            $hasBg = $h->unload_set($opt, 'optSearchHeaderBg');
            $bg = $h->unload_set($hasBg, 'url');
        }
        if (is_single() || is_page()) {
            $status = get_post_meta($id, 'metaHeader', TRUE);
            $title = (get_post_meta($id, 'metaHeaderTitle', TRUE)) ? get_post_meta($id, 'metaHeaderTitle', TRUE) : get_the_title($id);
            $subtitle = get_post_meta($id, 'metaHeaderSubTitle', TRUE);
            $bg = get_post_meta($id, 'metaHeaderBg', TRUE);
        }
        if (is_404()) {
            $status = ($h->unload_set($opt, 'opt404Header') == '1') ? 'on' : '';
            $title = ($h->unload_set($opt, 'opt404HeaderTitle') != '') ? $h->unload_set($opt, 'opt404HeaderTitle') : '';
            $subtitle = $h->unload_set($opt, 'opt404HeaderSubTitle');
            $hasBg = $h->unload_set($opt, 'opt404HeaderBg');
            $bg = $h->unload_set($hasBg, 'url');
        }
        if ($status == 'on'):
            ?>
            <div class="page-top blackish overlape">
                <div class="parallax" data-velocity="-.1"
                     style="background: url(<?php echo esc_url($bg) ?>) repeat scroll 0 0"></div>
                <div class="container">
                    <div class="page-title">
                        <?php if (!empty($subtitle)): ?>
                            <span><?php echo esc_html($subtitle) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($title)): ?>
                            <h1><?php echo esc_html($title) ?></h1>
                        <?php endif; ?>
                    </div><!-- Page Title -->
                </div>
            </div>
            <?php
        endif;
    }

    public function unload_themeLeftSidebar($id = '', $optlayout = '', $optsidebar = '')
    {
        if (get_post_meta($id, 'metaSidebarLayout', TRUE) != 'full' && get_post_meta($id, 'metaSidebar', TRUE) != '') {
            $layout = get_post_meta($id, 'metaSidebarLayout', TRUE);
            $sidebar = get_post_meta($id, 'metaSidebar', TRUE);
            if ($layout == 'left' && !empty($sidebar) && is_active_sidebar($sidebar)) {
                echo '<div class="col-md-4">';
                dynamic_sidebar($sidebar);
                echo '</div>';
            }
        } else {
            if (get_post_meta($id, 'metaSidebarLayout', TRUE) != 'none') {
                $opt = (new unload_Helper())->unload_opt();
                $h = new unload_Helper();
                $layout = $h->unload_set($opt, $optlayout);
                $sidebar = $h->unload_set($opt, $optsidebar);
                if ($layout == 'left' && !empty($sidebar) && is_active_sidebar($sidebar)) {
                    echo '<div class="col-md-4">';
                    dynamic_sidebar($sidebar);
                    echo '</div>';
                }
            }
        }
    }

    public function unload_themeRightSidebar($id = '', $optlayout = '', $optsidebar = '')
    {
        if (get_post_meta($id, 'metaSidebarLayout', TRUE) != 'full' && get_post_meta($id, 'metaSidebar', TRUE) != '') {
            $layout = get_post_meta($id, 'metaSidebarLayout', TRUE);
            $sidebar = get_post_meta($id, 'metaSidebar', TRUE);
            if ($layout == 'right' && !empty($sidebar) && is_active_sidebar($sidebar)) {
                echo '<div class="col-md-4">';
                dynamic_sidebar($sidebar);
                echo '</div>';
            }
        } else {
            if (get_post_meta($id, 'metaSidebarLayout', TRUE) != 'none') {
                $opt = (new unload_Helper())->unload_opt();
                $h = new unload_Helper();
                $layout = $h->unload_set($opt, $optlayout);
                $sidebar = $h->unload_set($opt, $optsidebar);
                if ($layout == 'right' && !empty($sidebar) && is_active_sidebar($sidebar)) {
                    echo '<div class="col-md-4">';
                    dynamic_sidebar($sidebar);
                    echo '</div>';
                }
            }
        }
    }

    public function unload_column($id = '', $optlayout = '', $optsidebar = '')
    {
        if (get_post_meta($id, 'metaSidebarLayout', TRUE) != 'full' && get_post_meta($id, 'metaSidebar', TRUE) != '') {
            $layout = get_post_meta($id, 'metaSidebarLayout', TRUE);
            $sidebar = get_post_meta($id, 'metaSidebar', TRUE);
            if (!empty($layout) && $layout != 'full' && !empty($sidebar)) {
                return 'col-md-8';
            } else {
                return 'col-md-12';
            }
        } else {
            if (get_post_meta($id, 'metaSidebarLayout', TRUE) != 'none') {
                $opt = (new unload_Helper())->unload_opt();
                $h = new unload_Helper();
                $layout = $h->unload_set($opt, $optlayout);
                $sidebar = $h->unload_set($opt, $optsidebar);
                if (!empty($layout) && $layout != 'full' && !empty($sidebar)) {
                    return 'col-md-8';
                } else {
                    return 'col-md-12';
                }
            } else {
                return 'col-md-12';
            }
        }
    }

    public function unload_date($echo = TRUE)
    {
        if ($echo === TRUE) {
            echo get_the_date(get_option('post_format'));
        } else {
            return get_the_date(get_option('post_format'));
        }
    }

    public function unload_dateLink($echo = TRUE)
    {
        $year = get_the_time('Y');
        $month = get_the_time('m');
        $day = get_the_time('d');
        if ($echo === TRUE) {
            echo get_day_link($year, $month, $day);
        } else {
            return get_day_link($year, $month, $day);
        }
    }

    public function unload_authorLink($echo = TRUE)
    {
        if ($echo === TRUE) {
            echo get_author_posts_url(get_the_author_meta('ID'));
        } else {
            return get_author_posts_url(get_the_author_meta('ID'));
        }
    }

    public function unload_comments($id, $echo = TRUE)
    {
        if ($echo === TRUE) {
            echo balanceTags($this->unload_restyleText(get_comments_number($id)));
        } else {
            return $this->unload_restyleText(get_comments_number($id));
        }
    }

    function unload_restyleText($n, $precision = 1)
    {
        if ($n < 900) {
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            $n_format = number_format($n / 1000, $precision);
            $suffix = esc_html__('K', 'unload');
        } else if ($n < 900000000) {
            $n_format = number_format($n / 1000000, $precision);
            $suffix = esc_html__('M', 'unload');
        } else if ($n < 900000000000) {
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = esc_html__('B', 'unload');
        } else {
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = esc_html__('T', 'unload');
        }
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return ' ' . $n_format . $suffix;
    }

    public function unload_get_terms($taxonomy, $number = 3, $format = '', $anchor = TRUE, $seprator = ',')
    {
        global $post;
        $counter = 1;
        $terms = get_the_terms($post->ID, $taxonomy);
        if ($terms) {
            foreach ($terms as $term) {
                $sep = ($counter > 1) ? $seprator : '';
                if ($counter == $number) {
                    break;
                }
                if ($anchor == 1) {
                    echo '<' . $format . '><a itemprop="url" href="' . esc_url(get_term_link($term->term_id, $taxonomy)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'unload'), $term->slug)) . '">' . $term->name . '</a>' . $sep . ' </' . $format . '>';
                } else {
                    echo esc_html($term->name) . $sep . ' ';
                }
                $counter++;
            }
        }
    }

    public function unload_getTags()
    {
        $tags = get_the_tags();
        if ($tags):
            foreach ($tags as $tag):
                echo '<a itemprop="url" href="' . esc_url(get_tag_link($this->unload_set($tag, 'term_id'))) . '" title="' . esc_attr($this->unload_set($tag, 'slug')) . '">' . esc_html($this->unload_set($tag, 'name')) . '</a>';
            endforeach;
        endif;
    }

    function unlod_socialShare($shares = array(), $color = FALSE, $show_title = FALSE, $list = FALSE)
    {
        $permalink = get_permalink(get_the_ID());
        $titleget = get_the_title();
        if (in_array('facebook', $shares)) {
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>', 'Facebook', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
                   return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>"
               class="facebook" style="transition-delay: 0ms;">
                <i class="fa fa-facebook"></i><?php echo balanceTags(($show_title) ? "<span>Facebook</span>" : ""); ?>
            </a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>
        <?php
        if (in_array('twitter', $shares)) {
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               onClick="window.open('http://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Twitter share', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
                   return false;"
               href="http://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>"
               class="twitter" style="transition-delay: 50ms;">
                <i class="fa fa-twitter"></i><?php echo balanceTags(($show_title) ? "<span>Twitter</span>" : ""); ?></a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>
        <?php
        if (in_array('google-plus', $shares)) {
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url($permalink); ?>', 'Google plus', 'width=585,height=666,left=' + (screen.availWidth / 2 - 292) + ',top=' + (screen.availHeight / 2 - 333) + '');
                   return false;" href="https://plus.google.com/share?url=<?php echo esc_url($permalink); ?>"
               class="google-plus">
                <i class="fa fa-google-plus"></i><?php echo balanceTags(($show_title) ? "<span>Google Plus</span>" : ""); ?>
            </a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>
        <?php
        if (in_array('reddit', $shares)) {
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               onClick="window.open('http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Reddit', 'width=617,height=514,left=' + (screen.availWidth / 2 - 308) + ',top=' + (screen.availHeight / 2 - 257) + '');
                   return false;"
               href="http://reddit.com/submit?url=<?php echo esc_url($permalink); ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>"
               class="reddit">
                <i class="fa fa-reddit"></i><?php echo balanceTags(($show_title) ? "<span>Reddit</span>" : ""); ?></a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>
        <?php
        if (in_array('linkedin', $shares)) {
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>', 'Linkedin', 'width=863,height=500,left=' + (screen.availWidth / 2 - 431) + ',top=' + (screen.availHeight / 2 - 250) + '');
                   return false;"
               href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>"
               class="linkedin">
                <i class="fa fa-linkedin"></i><?php echo balanceTags(($show_title) ? "<span>Linkedin</span>" : ""); ?>
            </a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>
        <?php
        if (in_array('pinterest', $shares)) {
            echo wp_kses($list === TRUE) ? '<li>' : '';
            ?>
            <a itemprop="url"
               href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'
               class="pinterest" style="transition-delay: 100ms;">
                <i class="fa fa-pinterest"></i><?php echo balanceTags(($show_title) ? "<span>Pinterest</span>" : ""); ?>
            </a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>

        <?php
        if (in_array('tumblr', $shares)) {
            $str = $permalink;
            $str = preg_replace('#^https?://#', '', $str);
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo esc_url($str); ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Tumblr', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
                   return false;"
               href="http://www.tumblr.com/share/link?url=<?php echo esc_url($str); ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>"
               class="tumbler">
                <i class="fa fa-tumblr"></i><?php echo balanceTags(($show_title) ? "<span>Tumblr</span>" : ""); ?></a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
        ?>
        <?php
        if (in_array('envelope-o', $shares)) {
            echo wp_kses(($list === TRUE) ? '<li>' : '', TRUE);
            ?>
            <a itemprop="url"
               href="mailto:?Subject=<?php echo str_replace(" ", "%20", $titleget); ?>&amp;Body=<?php echo esc_url($permalink); ?>"><i
                    class="fa fa-envelope"></i></a>
            <?php
            echo wp_kses(($list === TRUE) ? '</li>' : '', TRUE);
        }
    }

    public function unload_vcArray($list = array(), $multi = array())
    {
        $array = require_once(unload_Root . 'app/lib/shortcodes/arrayset.php');
        $temp = array();
        if (!empty($list)) {
            foreach ($list as $item) {
                $temp[] = $array[$item];
            }
        }
        if (!empty($multi)) {
            $hasMulti[] = array("type" => "multiselect", "heading" => sprintf(esc_html__('%s', 'unload'), self::unload_set($multi, 'h')), "param_name" => self::unload_set($multi, 'n'), "value" => self::unload_set($multi, 'v'), "description" => self::unload_set($multi, 'd'),);
            $temp = array_merge_recursive($temp, $hasMulti);
        }

        return $temp;
    }

    public function unload_pagi($args = array(), $echo = 1)
    {
        global $wp_query, $wp_rewrite;
        $current = max(1, get_query_var('paged'));
        $default = array('base' => str_replace(99999, '%#%', esc_url(get_pagenum_link(99999))), 'format' => '?paged=%#%', 'current' => $current, 'total' => $wp_query->max_num_pages, 'show_all' => FALSE, 'end_size' => 2, 'mid_size' => 2, 'total' => self::unload_set($args, 'total'), 'next_text' => '<i class="fa fa-angle-double-right"></i>', 'prev_text' => '<i class="fa fa-angle-double-left"></i>', 'type' => 'array');
        $pagination = wp_parse_args($args, $default);
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }
        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = array('s' => get_query_var('s'));
        }
        $pages = paginate_links($pagination);
        if (!empty($pages)) {
            echo '<div class="pagination">';
            echo '<ul>';
            if ($current == 1) {
                echo '<li><a class="prev" href="javascript:void(0)" title=""><i class="fa fa-angle-double-left"></i></a></li>';
            }
            $counter = 0;
            foreach ($pages as $page) :
                if ($current > 1 && $counter == 0) {
                    echo '<li>' . $page . '</li>';
                } else {
                    echo '<li>' . $page . '</li>';
                }
                $counter++;
            endforeach;
            if ($current == self::unload_set($args, 'total')) {
                echo '<li><a class="next" href="javascript:void(0)" title=""><i class="fa fa-angle-double-right"></i></a></li>';
            }
            echo '</ul></div>';
        }
    }

    public function unload_regPopup()
    {
        $h = new unload_Helper();
        $opt = (new unload_Helper())->unload_opt();
        $isLogin = $h->unload_set($opt, 'optLoginShow');
        $isReg = $h->unload_set($opt, 'optRegisterShow');
        if ($isLogin == '1' || $isReg == '1'):
            $col = '';
            if ($isLogin != '1' && $isReg == '1') {
                $col = 'col-md-12';
            } else if ($isLogin == '1' && $isReg != '1') {
                $col = 'col-md-12';
            } else if ($isLogin == '1' && $isReg == '1') {
                $col = 'col-md-6';
            }
            $bg = $h->unload_set($opt, 'optLoginRegBg');
            unload_Media::unload_singleton()->unload_eq(array('perfect-scrollbar-js', 'icheck'));

            if (!is_user_logged_in()) {
                ?>
                <div id="signup-popup">
                    <div class="region2" id="signup">
                        <div class="modal-dialog1"
                             style="background:url(<?php echo esc_url($h->unload_set($bg, 'url')) ?>)">
                            <div class="modal-content1">
                                <div class="modal-body1">
                                    <div class="signup-form">
                                        <button type="submit"><img
                                                src="<?php echo unload_Uri ?>partial/images/close1.png" alt=""/>
                                        </button>
                                        <div class="row">
                                            <?php if ($isLogin == '1'): ?>
                                                <div class="<?php echo esc_attr($col) ?>">
                                                    <div class="sign-in banner-detail1">
                                                        <div class="heading2">
                                                            <span><?php echo esc_html($h->unload_set($opt, 'optLoginSubTitle')) ?></span>
                                                            <h3><?php echo esc_html($h->unload_set($opt, 'optLoginTitle')) ?></h3>
                                                        </div>
                                                        <p><?php echo esc_html($h->unload_set($opt, 'optLoginDesc')) ?></p>
                                                        <div class="log"></div>
                                                        <form id="loginForm">
                                                            <label>
                                                                <input id="user" type="text" class="text-field"
                                                                       placeholder="<?php esc_html_e('User Name', 'unload') ?>">
                                                            </label>
                                                            <label>
                                                                <i class="fa fa-anchor"></i>
                                                                <input id="password" type="password" class="text-field"
                                                                       placeholder="<?php esc_html_e('Password', 'unload') ?>:">
                                                            </label>
                                                            <?php if ($h->unload_set($opt, 'optLoginPassRemember') == '1'): ?>
                                                                <div class="terms-services">
																	<span>
																		<input tabindex="23" type="checkbox"
                                                                               id="rempass"/>
																		<label
                                                                            for="rempass"><?php esc_html_e('Remember My Password', 'unload') ?></label>
																	</span>
                                                                </div>
                                                            <?php endif; ?>
                                                            <input id="ajax_login_nonce" type="hidden"
                                                                   name="ajax_login_nonce"
                                                                   value="<?php echo wp_create_nonce('ajax_login_nonce'); ?>"/>
                                                            <ul>

                                                                <li>
                                                                    <a id="login" href="javascript:void(0)" title=""
                                                                       class="theme-btn" itemprop="url">
                                                                        <i class="fa fa-paper-plane"></i>
                                                                        <?php echo ($h->unload_set($opt, 'optLoginBtnTitle') != '') ? esc_html($h->unload_set($opt, 'optLoginBtnTitle')) : esc_html__('SIGN IN NOW', 'unload'); ?>
                                                                    </a>
                                                                </li>
                                                                <?php if ($h->unload_set($opt, 'optLoginForgotPass') == '1'):
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"
                                                                           title=""
                                                                           itemprop="url"><?php esc_html_e('Forgot Password', 'unload') ?></a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </form>
                                                    </div><!-- Sign In -->
                                                </div>
                                                <?php
                                            endif;
                                            if ($isReg == '1'):
                                                ?>
                                                <div class="<?php echo esc_attr($col) ?>">
                                                    <div class="sign-in banner-detail1 si">
                                                        <div class="heading2">
                                                            <span><?php echo esc_html($h->unload_set($opt, 'optRegSubTitle')) ?></span>
                                                            <h3><?php echo esc_html($h->unload_set($opt, 'optRegTitle')) ?></h3>
                                                        </div>
                                                        <p><?php echo esc_html($h->unload_set($opt, 'optRegDesc')) ?></p>
                                                        <div class="log"></div>
                                                        <form id="regForm">
                                                            <label>
                                                                <input id="fname" type="text" class="text-field"
                                                                       placeholder="<?php esc_html_e('First Name', 'unload') ?>">
                                                            </label>
                                                            <label>
                                                                <input id="lname" type="text" class="text-field"
                                                                       placeholder="<?php esc_html_e('Last Name', 'unload') ?>">
                                                            </label>
                                                            <label>
                                                                <input id="reg-user" type="text" class="text-field"
                                                                       placeholder="<?php esc_html_e('User Name', 'unload') ?>">
                                                            </label>
                                                            <label>
                                                                <i class="fa fa-envelope"></i>
                                                                <input id="reg_email" type="email" class="text-field"
                                                                       placeholder="<?php esc_html_e('Email Address', 'unload') ?>">
                                                            </label>
                                                            <label>
                                                                <i class="fa fa-anchor"></i>
                                                                <input id="pass" type="password" class="text-field"
                                                                       placeholder="<?php esc_html_e('New Password', 'unload') ?>:">
                                                            </label>
                                                            <label>
                                                                <i class="fa fa-anchor"></i>
                                                                <input id="repass" type="password" class="text-field"
                                                                       placeholder="<?php esc_html_e('Re-Type Password', 'unload') ?>:">
                                                            </label>
                                                            <input id="ajax_reg_nonce" type="hidden"
                                                                   name="ajax_reg_nonce"
                                                                   value="<?php echo wp_create_nonce('ajax_reg_nonce'); ?>"/>
                                                            <?php if ($h->unload_set($opt, 'optRegTerms') == '1'): ?>
                                                                <div class="terms-services">
																	<span>
																		<input tabindex="23" type="checkbox"
                                                                               id="terms"/>
																		<label for="terms">
																			<?php echo esc_html($h->unload_set($opt, 'optRegTermsText')); ?>
                                                                            <a href="<?php echo esc_url(get_page_link($h->unload_set($opt, 'optRegTermsPage'))) ?>"
                                                                               title=""><?php esc_html_e('Terms of Service', 'unload') ?></a>
																		</label>
																	</span>
                                                                </div>
                                                            <?php endif;
                                                            ?>
                                                            <a id="regUser" href="javascript:void(0)" title=""
                                                               class="theme-btn" itemprop="url">
                                                                <i class="fa fa-paper-plane"></i>
                                                                <?php echo ($h->unload_set($opt, 'optLoginBtnTitle') != '') ? esc_html($h->unload_set($opt, 'optLoginBtnTitle')) : esc_html__('REGISTER', 'unload'); ?>
                                                            </a>

                                                        </form>
                                                    </div><!-- Sign In -->
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div><!-- Signup Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $jsOutput = "
					jQuery(document).ready(function ($) {
						'use strict';
						$('.fragile > span > input').iCheck({
							checkboxClass: 'icheckbox_futurico',
							radioClass: 'iradio_futurico',
							increaseArea: '20%' // optional
						});
						// Input Radio Script
						$('.extra-services > span > input, .terms-services > span > input').iCheck({
							checkboxClass: 'icheckbox_futurico2',
							increaseArea: '20%' // optional
						});
						$('.modal-dialog1').perfectScrollbar();
					});";
                wp_add_inline_script('unload-script', $jsOutput);
            }
        endif;
    }

    public function unload_resHader()
    {
        $h = new unload_Helper();
        $opt = (new unload_Helper())->unload_opt();
        $logo = (new unload_Helper())->unload_set($opt, 'optResHeaderLogo');
        ?>
        <div class="responsive-header">
            <span class="top-sec-btn"><i class="fa fa-angle-double-down"></i></span>
            <div class="responsive-top-sec">
                <?php if ($h->unload_set($opt, 'optResHeaderTopBarTiming') == 1 || $h->unload_set($opt, 'optResHeaderTopBarSocialMedia') == 1): ?>
                    <div class="responsive-top-bar top-bar">
                        <div class="container">
                            <?php if ($h->unload_set($opt, 'optResHeaderTiming') == 1): ?>
                                <span class="cargo-time"><?php esc_html_e('Opening Time', 'unload') ?>
                                    :<i><?php echo esc_html($h->unload_set($opt, 'optResHeaderTopBarTimingText')) ?></i></span>
                            <?php endif; ?>
                            <?php if ((new unload_Helper())->unload_set($opt, 'optResHeaderTopBarSocialMedia') == 1): ?>
                                <div class="connect-us">
                                    <ul class="social-btn">
                                        <?php
                                        $social = (new unload_Helper())->unload_set($opt, 'optResHeaderTopBarSocialicons');
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
                    </div><!-- Responsive Top Bar -->
                <?php endif; ?>
                <div class="responsive-quick-contact">
                    <div class="container">
                        <div class="quick-contact">
                            <?php if ((new unload_Helper())->unload_set($opt, 'optResHeaderShowContactNo') == 1 || (new unload_Helper())->unload_set($opt, 'optResHeaderShowContactEmail') == 1 || (new unload_Helper())->unload_set($opt, 'optResHeaderShippingButton') == 1): ?>
                                <ul>
                                    <?php if ((new unload_Helper())->unload_set($opt, 'optResHeaderShowContactNo') == 1): ?>
                                        <li>
                                            <img src="<?php echo unload_Uri ?>partial/images/phone-dark.png" alt=""/>
                                            <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optResHeaderContactNo')) ?></span>
                                            <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optResHeaderContactNoBottom')) ?></p>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ((new unload_Helper())->unload_set($opt, 'optResHeaderShowContactEmail') == 1): ?>
                                        <li>
                                            <img src="<?php echo unload_Uri ?>partial/images/sms-dark.png" alt=""/>
                                            <span><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optResHeaderContactEmail')) ?></span>
                                            <p><?php echo esc_html((new unload_Helper())->unload_set($opt, 'optResHeaderContactEmailBottom')) ?></p>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- Responsive Quick Contact -->
            </div>
            <div class="responsive-nav">
                <div class="container">
                    <div class="responsive-logo">
                        <div class="logo">
                            <a itemprop="url" href="<?php echo esc_url(home_url('/')) ?>" title="">
                                <img itemprop="image"
                                     src="<?php echo esc_url((new unload_Helper())->unload_set($logo, 'url')) ?>"
                                     alt=""/>
                            </a>
                        </div>
                    </div>
                    <span class="responsive-btn"><i class="fa fa-list"></i></span>
                    <div class="responsive-menu">
                        <span class="close-btn"><i class="fa fa-close"></i></span>
                        <?php if ($h->unload_set($opt, 'optResHeaderSigin') == 1 || $h->unload_set($opt, 'optResHeaderquote') == 1): ?>
                            <ul class="responsive-popup-btns">
                                <?php if ($h->unload_set($opt, 'optResHeaderSigin') == 1): ?>
                                    <li>
                                        <i class="fa fa-user"></i>
                                        <?php
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
                                        ?>
                                    </li>
                                <?php endif;
                                ?>
                                <?php if ($h->unload_set($opt, 'optResHeaderquote') == 1): ?>
                                    <li><i class="fa fa-paper-plane"></i><a itemprop="url" id="shipping_calc"
                                                                            href="javascript:void(0)" title=""
                                                                            class="popup2"><?php echo esc_html($h->unload_set($opt, 'optResHeaderquoteText')) ?></a>
                                    </li><?php endif; ?>
                            </ul>
                        <?php endif; ?>
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'container' => '')); ?>
                    </div><!-- Responsive Menu -->
                </div>
            </div>
        </div><!--Responsive header-->
        <?php
    }

    public function unload_tpl($tpl)
    {
        $page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => $tpl));
        if ($page) {
            return current((array)$page);
        } else {
            return FALSE;
        }
    }

    public function unload_vcTitle($style = '', $title, $subtitle, $desc)
    {
        $titleHtml = '';
        switch ($style) {
            case '1':
                $titleHtml .= '<div class="dark-title">
					<span><i class="fa fa-user"></i>' . esc_html($subtitle) . '</span>
					<h3>' . esc_html($title) . '</h3>
				</div>';
                break;
            case '2':
                $titleHtml .= '<div class="title2">
					<strong>' . esc_html($subtitle) . '</strong>
					<h2>' . esc_html($title) . '</h2>
				</div>';
                break;
            case '3':
                $titleHtml .= '<div class="heading">
					<span>' . esc_html($subtitle) . '</span>
					<h2>' . esc_html($title) . '</h2>
				</div>';
                break;
            case '4':
                $titleHtml .= '<div class="column-title">
					<span>' . esc_html($subtitle) . '</span>
					<h2>' . esc_html($title) . '</h2>
					<p>' . esc_html($desc) . '</p>
				</div>';
                break;
            case '5':
                $titleHtml .= '<div class="heading2 heading4 light">
					<span>' . esc_html($subtitle) . '</span>
					<h3>' . esc_html($title) . '</h3>
				</div>';
                break;
            case '6':
                $titleHtml .= '<div class="heading2 light">
					<span>' . esc_html($subtitle) . '</span>
					<h3>' . esc_html($title) . '</h3>
				</div>';
                break;
            case '7':
                $titleHtml .= '<div class="title2">
					<strong>' . esc_html($subtitle) . '</strong>
					<h2>' . esc_html($title) . '</h2>
				</div>';
                break;
            case '8':
                $titleHtml .= '<div class="heading7">
					<span>' . esc_html($subtitle) . '</span>
					<h3>' . esc_html($title) . '</h3>
				</div>';
                break;
            case '9':
                $titleHtml .= '<div class="heading6">
					<h3>' . esc_html($title) . '</h3>
					<p>' . esc_html($subtitle) . '</p>
				</div>';
                break;
        }

        return $titleHtml;
    }

    public function unloadTpl($TEMPLATE_NAME)
    {
        $url = "";
        $pages = new WP_Query(array('post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => $TEMPLATE_NAME));
        if ($pages->posts):
            $id = $pages->posts[0]->ID;
            $url = NULL;
            if (isset($pages->posts[0])) {
                $url = get_page_link($id);
            }
        endif;
        wp_reset_postdata();

        return $url;
    }

    public function __clone()
    {
        trigger_error(esc_html__('Cloning the registry is not permitted', 'unload'), E_USER_ERROR);
    }

}
