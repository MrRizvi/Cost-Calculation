<?php

class unload_parallax_video_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_parallax_video($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Parallax Video", 'unload'),
                "base" => "unload_parallax_video_output",
                "icon" => 'parallax_video.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Vidoe Url:", 'unload'),
                        "param_name" => "url",
                        "description" => esc_html__("Enter the Vimeo & Youtube video url.", 'unload')
                    ),
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Background Image:", 'unload'),
                        "param_name" => "img",
                        "description" => esc_html__("Upload background image.", 'unload')
                    )
                )
            );
            return apply_filters('unload_parallax_video_shortcode', $return);
        }
    }

    public static function unload_parallax_video_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        $h = new unload_Helper;
        unload_Media::unload_singleton()->unload_eq(array('poptrox'));
        ob_start();
        if (!empty($url)) {
            $imgSrc = wp_get_attachment_image_src($img, 'full');
            ?>
            <div class="cargo-video cargo-video2">
                <img src="<?php echo esc_url($h->unload_set($imgSrc, '0')) ?>" alt=""/>
                <div class="cargo-video-cap lightbox">
                    <?php if (!empty($title)): ?>
                        <p>
                            <a href="javascript:void(0)" title="">
                                <?php echo esc_html($title) ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($url) ?>" itemprop="url" title=""><i class="fa fa-play"></i></a>
                </div>
            </div>
            <?php
            $jsOutput = "jQuery(document).ready(function ($) {
					var foo = $('.lightbox');
					foo.poptrox({
						usePopupCaption: false,
						usePopupNav: true,
					});
				});";
            wp_add_inline_script('unload-poptrox', $jsOutput);
        }
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
