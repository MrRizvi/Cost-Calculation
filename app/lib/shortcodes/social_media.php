<?php

class unload_social_media_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_social_media($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Social Media", 'unload'),
                "base" => "unload_social_media_output",
                "icon" => 'unload_social_media_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style:", 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Social Square Gray', 'unload') => 'socialmedia-btns social-square light-social',
                            esc_html__('Social Square Dark', 'unload') => 'socialmedia-btns social-square dar-bg-social',
                            esc_html__('Social Square Dark Border', 'unload') => 'socialmedia-btns social-square dar-bor-social',
                            esc_html__('Social Square Mono BG', 'unload') => 'socialmedia-btns social-square thm-social',
                            esc_html__('Social Square Colored Border', 'unload') => 'socialmedia-btns social-square col-bor-social',
                            esc_html__('Social Square Colored BG', 'unload') => 'socialmedia-btns social-square col-bg-social',
                            esc_html__('Social Circular Gray', 'unload') => 'socialmedia-btns social-radius light-social',
                            esc_html__('Social Circular Dark', 'unload') => 'socialmedia-btns social-radius dar-bg-social',
                            esc_html__('Social Circular Dark Border', 'unload') => 'socialmedia-btns social-radius dar-bor-social',
                            esc_html__('Social Circular Mono BG', 'unload') => 'socialmedia-btns social-radius thm-social',
                            esc_html__('Social Circular Colored Border', 'unload') => 'socialmedia-btns social-radius col-bor-social',
                            esc_html__('Social Circular Colored BG', 'unload') => 'socialmedia-btns social-radius col-bg-social',
                            esc_html__('Social Leaf Gray', 'unload') => 'socialmedia-btns social-halfradius light-social',
                            esc_html__('Social Leaf Dark', 'unload') => 'socialmedia-btns social-halfradius dar-bg-social',
                            esc_html__('Social Leaf Dark Border', 'unload') => 'socialmedia-btns social-halfradius dar-bor-social',
                            esc_html__('Social Leaf Mono BG', 'unload') => 'socialmedia-btns social-halfradius thm-social',
                            esc_html__('Social Leaf Colored Border', 'unload') => 'socialmedia-btns social-halfradius col-bor-social',
                            esc_html__('Social Leaf Colored BG', 'unload') => 'socialmedia-btns social-halfradius col-bg-social',
                        ),
                        "description" => esc_html__("Select the style of the social media.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Facebook:", 'unload'),
                        "param_name" => "fb",
                        "description" => esc_html__("Enter facebook link.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Google Plus:", 'unload'),
                        "param_name" => "gp",
                        "description" => esc_html__("Enter google plus link.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Twitter:", 'unload'),
                        "param_name" => "tw",
                        "description" => esc_html__("Enter twitter link.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Pinterest:", 'unload'),
                        "param_name" => "pt",
                        "description" => esc_html__("Enter pinterest link.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Linkedin:", 'unload'),
                        "param_name" => "lk",
                        "description" => esc_html__("Enter linkedin link.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Dribbble:", 'unload'),
                        "param_name" => "dr",
                        "description" => esc_html__("Enter dribbble link.", 'unload')
                    )
                )
            );
            return apply_filters('unload_social_media_output', $return);
        }
    }

    public static function unload_social_media_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        ?>
        <div class="socialmedia-div">
            <ul class="<?php echo esc_attr($style) ?>">
                <?php if (!empty($fb)): ?>
                    <li><a href="<?php echo esc_url($fb) ?>" title=""><i class="fa fa-facebook"></i></a>
                    </li><?php endif; ?>
                <?php if (!empty($gp)): ?>
                    <li><a href="<?php echo esc_url($gp) ?>" title=""><i class="fa fa-google-plus"></i></a>
                    </li><?php endif; ?>
                <?php if (!empty($tw)): ?>
                    <li><a href="<?php echo esc_url($tw) ?>" title=""><i class="fa fa-twitter"></i></a>
                    </li><?php endif; ?>
                <?php if (!empty($pt)): ?>
                    <li><a href="<?php echo esc_url($pt) ?>" title=""><i class="fa fa-pinterest-p"></i></a>
                    </li><?php endif; ?>
                <?php if (!empty($lk)): ?>
                    <li><a href="<?php echo esc_url($lk) ?>" title=""><i class="fa fa-linkedin"></i></a>
                    </li><?php endif; ?>
                <?php if (!empty($dr)): ?>
                    <li><a href="<?php echo esc_url($dr) ?>" title=""><i class="fa fa-dribbble"></i></a>
                    </li><?php endif; ?>
            </ul>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
