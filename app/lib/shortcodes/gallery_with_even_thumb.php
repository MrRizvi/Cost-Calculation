<?php

class unload_gallery_with_even_thumb_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_gallery_with_even_thumb($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Gallery with Even Thumb", 'unload'),
                "base" => "unload_gallery_with_even_thumb_output",
                "icon" => 'gallery_with_even_thumb.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "attach_images",
                        "heading" => esc_html__('Upload Images', 'unload'),
                        "param_name" => "images",
                        "description" => esc_html__('Upload images for this gallery style', 'unload')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Column", 'unload'),
                        "param_name" => "col",
                        "value" => array_flip(
                            array(
                                'col-md-6' => esc_html__('2 Column', 'unload'),
                                'col-md-4' => esc_html__('3 Column', 'unload'),
                                'col-md-3' => esc_html__('4 Column', 'unload'),
                            )
                        )
                    ),
                )
            );
            return apply_filters('unload_gallery_with_even_thumb_shortcode', $return);
        }
    }

    public static function unload_gallery_with_even_thumb_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('isotop', 'poptrox'));
        $siplitImages = explode(',', $images);
        $size = 'unload_580x634';
        if (!empty($siplitImages)) {
            $counter = 0;
            ?>
            <div class="gallery1 gallery2">
                <div class="row masonary" id="event_thumb_gallery_masonary<?php echo esc_attr(self::$counter) ?>">
                    <?php
                    foreach ($siplitImages as $img) {
                        $src = wp_get_attachment_image_src($img, $size);
                        $full = wp_get_attachment_image_src($img, 'full');
                        $title = get_the_title($img);
                        ?>
                        <div class="<?php echo esc_attr($col) ?>">
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
                    }
                    ?>
                </div>
            </div>
            <?php ob_start(); ?>
            jQuery(window).load(function () {
            "use strict";

            jQuery(function () {
            var $portfolio = jQuery('#event_thumb_gallery_masonary<?php echo esc_js(self::$counter) ?>');
            $portfolio.isotope({
            masonry: {
            columnWidth: 0
            }
            });
            });
            });
            jQuery(document).ready(function ($) {
            $('#event_thumb_gallery_masonary<?php echo esc_js(self::$counter) ?>').poptrox({
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
