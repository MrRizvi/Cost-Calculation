<?php

class unload_simple_gallery_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_simple_gallery($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Simple Gallery", 'unload'),
                "base" => "unload_simple_gallery_output",
                "icon" => 'simple_gallery.png',
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
            return apply_filters('unload_simple_gallery_shortcode', $return);
        }
    }

    public static function unload_simple_gallery_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('poptrox'));
        $siplitImages = explode(',', $images);
        $sizes = array('unload_580x634', 'unload_580x634', 'unload_775x336');
        $cols = array('6', '6', '12');
        if (!empty($siplitImages)) {
            $counter = 0;
            ?>
            <div class="gallery6">
                <div class="row">
                    <?php
                    foreach ($siplitImages as $img) {
                        $src = wp_get_attachment_image_src($img, $sizes[$counter]);
                        $full = wp_get_attachment_image_src($img, 'full');
                        $title = get_the_title($img);
                        ?>
                        <div class="col-md-<?php echo esc_attr($cols[$counter]) ?>">
                            <div class="gallery-img" id="gallery-img<?php echo esc_attr(self::$counter) ?>">
                                <img src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt="" itemprop="image"/>
                                <div class="padd">
                                    <div class="gallery-padding">
                                        <div class="gallery-detail">
                                            <h3><?php echo esc_html($title) ?></h3>
                                            <a data-lightbox="gallery-set6"
                                               href="<?php echo esc_url($H->unload_set($full, '0')) ?>" title=""
                                               itemprop="url"><i class="fa fa-search-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                        if ($counter == 2) {
                            $counter = 0;
                        }
                    }
                    ?>
                </div>
            </div>
            <?php ob_start(); ?>
            jQuery(document).ready(function ($) {
            jQuery('.gallery-img<?php echo esc_js(self::$counter) ?>').poptrox({
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
