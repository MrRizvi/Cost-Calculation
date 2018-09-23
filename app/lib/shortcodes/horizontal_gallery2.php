<?php

class unload_horizontal_gallery2_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_horizontal_gallery2($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Horizontal Gallery Style 2", 'unload'),
                "base" => "unload_horizontal_gallery2_output",
                "icon" => 'horizontal_gallery2.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "attach_images",
                        "heading" => esc_html__('Upload Images', 'unload'),
                        "param_name" => "images",
                        "description" => esc_html__('Upload images for this gallery style', 'unload')
                    )
                )
            );
            return apply_filters('unload_horizontal_gallery2_shortcode', $return);
        }
    }

    public static function unload_horizontal_gallery2_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('isotop', 'poptrox'));
        $siplitImages = explode(',', $images);
        $sizes = array('unload_380x333', 'unload_775x336', 'unload_775x336', 'unload_380x333');
        $cols = array('4', '8', '8', '4');
        if (!empty($siplitImages)) {
            $counter = 0;
            ?>
            <div class="gallery1 gallery4">
                <div class="row masonary" id="horizantal2_masonary<?php echo esc_attr(self::$counter) ?>">
                    <?php
                    foreach ($siplitImages as $img) {
                        $src = wp_get_attachment_image_src($img, $sizes[$counter]);
                        $full = wp_get_attachment_image_src($img, 'full');
                        $title = get_the_title($img);
                        ?>
                        <div class="col-md-<?php echo esc_attr($cols[$counter]) ?>">
                            <div class="gallery-img">
                                <img src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt="" itemprop="image"/>
                                <div class="gallery-detail">
                                    <h3><?php echo esc_html($title) ?></h3>
                                    <a data-lightbox="gallery-set2"
                                       href="<?php echo esc_url($H->unload_set($full, '0')) ?>" title="" itemprop="url"><i
                                            class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                        if ($counter == 4) {
                            $counter = 0;
                        }
                    }
                    ?>
                </div>
            </div>
            <?php ob_start(); ?>
            jQuery(window).load(function () {
            "use strict";

            jQuery(function () {
            var $portfolio = jQuery('#horizantal2_masonary<?php echo esc_js(self::$counter) ?>');
            $portfolio.isotope({
            masonry: {
            columnWidth: 0.5
            }
            });
            });
            });
            jQuery(document).ready(function ($) {
            jQuery('#horizantal2_masonary<?php echo esc_js(self::$counter) ?>').poptrox({
            usePopupCaption: false,
            usePopupNav: true
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-poptrox', $jsOutput);
        }
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
