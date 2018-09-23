<?php

class unload_price_table_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_price_table($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Price Table", 'unload'),
                "base" => "unload_price_table_output",
                "icon" => 'price_table.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "multiselect",
                        "heading" => esc_html__("Price Table:", 'unload'),
                        "param_name" => "ptable",
                        "value" => (new unload_Helper)->unload_posts('price_table'),
                        "description" => esc_html__("Select the price table.", 'unload')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__('Style', 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Style 1', 'unload') => '',
                            esc_html__('Style 2', 'unload') => 'select-plane2',
                        ),
                        "description" => esc_html__("Select style of this section", 'unload')
                    ),
                )
            );
            return apply_filters('unload_price_table_shortcode', $return);
        }
    }

    public static function unload_price_table_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $args = array(
            'post_type' => 'price_table',
            'post__in' => explode(',', $ptable),
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        ?>
        <div class="your-plan">
            <div class="select-plan <?php echo esc_attr($style) ?> top-margin">
                <div class="row">
                    <?php
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $subTitle = $H->unload_m('metaSubTitle');
                            $getpPrice = $H->unload_m('metaPrice');
                            $img = $H->unload_m('metaimage');
                            $bg = $H->unload_m('metaBbimage');
                            $features = $H->unload_m('metaSocialProfiler');
                            $link = $H->unload_m('metaLink');
                            $currency = $H->unload_m('metaCurrency');
                            $price = explode('.', $getpPrice, 2);
                            $btnTitle = ($H->unload_m('metaBtnTitle')) ? $H->unload_m('metaBtnTitle') : esc_html__('GET THIS PLAN', 'unload');
                            ?>
                            <div class="col-md-4">
                                <div class="plan">
                                    <div class="plan-head">
                                        <img src="<?php echo esc_url($img) ?>" alt="" itemprop="image"/>
                                        <div class="head-data">
                                            <i><?php echo esc_html($subTitle) ?></i>
                                            <h3><?php echo esc_html($currency . $H->unload_set($price, '0')) ?>
                                                <i>.<?php echo esc_html($H->unload_set($price, '1')) ?></i></h3>
                                            <span><?php the_title() ?></span>
                                        </div>
                                    </div>
                                    <div class="plan-body" style="background:url(<?php echo esc_url($bg) ?>)">
                                        <div class="body-data">
                                            <?php if (!empty($features) && count($features) > 0): ?>
                                                <ul>
                                                    <?php
                                                    foreach ($features as $f) {
                                                        echo '<li>' . esc_html($H->unload_set($f, 'metaTableVal')) . '</li>';
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            endif;
                                            if (!empty($link)):
                                                ?>
                                                <a href="<?php echo esc_url($link) ?>" title="" itemprop="url"
                                                   class="theme-btn"><i
                                                        class="fa fa-paper-plane"></i><?php echo esc_html($btnTitle) ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
