<?php

class unload_tabed_gallery_VC_ShortCode extends unload_VC_ShortCode
{

    static $counter = 0;

    public static function unload_tabed_gallery($atts = NULL)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Tabed Carousal Gallery", 'unload'),
                "base" => "unload_tabed_gallery_output",
                "icon" => 'tabed_gallery.png',
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

            return apply_filters('unload_tabed_gallery_shortcode', $return);
        }
    }

    public static function unload_tabed_gallery_output($atts = NULL, $content = NULL)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        unload_Media::unload_singleton()->unload_eq(array('owl','imagesloaded'));
        $siplitImages = explode(',', $images);
        if (!empty($siplitImages)) {
            $counter = 0;
            $counter2 = 0;
            ?>
            <div class="gallery5">
                <div class="gallery5-carousel" id="gallery5-carousel<?php echo esc_attr(self::$counter) ?>">
                    <?php
                    foreach ($siplitImages as $img) {
                        $src = wp_get_attachment_image_src($img, 'unload_1170x593');
                        $title = get_the_title($img);
                        ?>
                        <div class="gallery5-img" data-hash="<?php echo esc_attr($counter) ?>">
                            <div class="gallery-img">
                                <img src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt="" itemprop="image"/>
                                <div class="gallery-detail gallery-detail1">
                                    <h3><?php echo esc_html($title) ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    }
                    ?>
                </div>
                <div class="gallery5-carousel-controls">
                    <div class="row">
                        <?php
                        foreach ($siplitImages as $img) {
                            $src = wp_get_attachment_image_src($img, 'unload_370x370');
                            $title = get_the_title($img);
                            $active = ($counter2 == 0) ? 'clicked' : '';
                            ?>
                            <div class="col-md-2">
                                <div class="gallery5-thumb <?php echo esc_attr($active) ?>">
                                    <a class="secondary url" href="#<?php echo esc_attr($counter2) ?>" title=""
                                       itemprop="url">
                                        <img src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt=""
                                             itemprop="image"/>
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $counter2++;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php ob_start();
            $opt = $H->unload_opt();
            $rtl = ($H->unload_set($opt, 'optThemeRtl')) ? 'true' : 'false';
            ?>
            jQuery(document).ready(function ($) {
            jQuery('.gallery5').imagesLoaded(function () {
            var owl = $('.gallery5-carousel');
            $('.gallery5-carousel').owlCarousel({
            rtl: <?php echo esc_js($rtl) ?>,
            autoplay: false,
            autoplayTimeout: 3000,
            smartSpeed: 3000,
            animateIn: "fadeIn",
            animateOut: "fadeOut",
            loop: false,
            dots: false,
            nav: true,
            margin: 10,
            items: 1,
            URLhashListener: true,
            singleItem: true,
            autoHeight: true,
            startPosition: 'URLHash',
            responsiveClass: true,
            responsive: {
            0: {
            items: 1,
            nav: false,
            },
            900: {
            nav: true,
            }
            }
            });
            });

             $('.gallery5-carousel').on("changed.owl.carousel", function (event) {
            setTimeout(function () {
            $(".gallery5-thumb").removeClass("clicked");
            var item = $(".gallery5-carousel").find(".owl-item.active > div").attr("data-hash");
            var check = $(".gallery5-carousel-controls").find($('.gallery5-thumb a[href="#' + item + '"]'));
            $(check).parent().addClass("clicked");
            }, 500);
            });


            //** Gallery5 Thumb **//
            $(".gallery5-thumb").on("click", function () {
            $(".gallery5-thumb").removeClass("clicked");
            $(this).addClass("clicked");
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
