<?php

class unload_isotop_gallery_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_isotop_gallery($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Isotope Gallery Uneven Thumb", 'unload'),
                "base" => "unload_isotop_gallery_output",
                "icon" => 'isotop_gallery.png',
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
            return apply_filters('unload_isotop_gallery_shortcode', $return);
        }
    }

    public static function unload_isotop_gallery_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('isotop', 'poptrox'));
        $siplitImages = explode(',', $images);
        $sizes = array('unload_580x634', 'unload_775x417', 'unload_580x634', 'unload_775x417', 'unload_580x634', 'unload_580x634', 'unload_580x634', 'unload_775x417', 'unload_580x634');
        $cols = array('3', '6', '3', '6', '3', '3', '3', '6', '3');
        if (!empty($siplitImages)) {
            $counter = 0;
            ?>
            <div class="gallery1">
                <div class="row masonary" id="isotop_masonary<?php echo esc_attr(self::$counter) ?>">
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
                        if ($counter == 8) {
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
            var $portfolio = jQuery('#isotop_masonary<?php echo esc_js(self::$counter) ?>');
            $portfolio.isotope({
            masonry: {
            columnWidth: 0.5
            }
            });
            });
            });
            jQuery(document).ready(function ($) {
            jQuery('#isotop_masonary<?php echo esc_js(self::$counter) ?>').poptrox({
            usePopupCaption: false,
            usePopupNav: true
            });
            });
            <?php
            $jsOutput = ob_get_contents();
            ob_end_clean();
            wp_add_inline_script('unload-script', $jsOutput);
        }
        self::$counter++;
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
