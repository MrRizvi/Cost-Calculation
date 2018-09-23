<?php

class unload_about_company_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_about_company($atts = null)
    {

        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("About Company", 'unload'),
                "base" => "unload_about_company_output",
                "icon" => 'about_company.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "attach_image",
                        "heading" => esc_html__("Image:", 'unload'),
                        "param_name" => "imgage",
                        "description" => esc_html__("Upload side Image for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Sub Title:", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => esc_html__("Description:", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the description for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("1st Fun Fact title:", 'unload'),
                        "param_name" => "funt1",
                        "description" => esc_html__("Enter the fun factor title.", 'unload')
                    ),
                    array(
                        "type" => "un_toggle",
                        "heading" => esc_html__("About Button", 'unload'),
                        "param_name" => "fullwidth",
                        'value' => 'off',
                        'default_set' => false,
                        'options' => array(
                            'on' => array(
                                'on' => __('Yes', 'unload'),
                                'off' => __('No', 'unload'),
                            ),
                        ),
                    ),
                    array(
                        "type" => "iconpicker",
                        "heading" => esc_html__("1st Fun Fact icon:", 'unload'),
                        "param_name" => "funicon1",
                        "description" => esc_html__("Select the icon from the library.", 'unload')
                    ),
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__("1st Fun Fact Number:", 'unload'),
                        "param_name" => "funnub1",
                        'min' => '1',
                        'max' => '10000000',
                        'step' => '1',
                        "description" => esc_html__("Enter the fun factor number.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("2nd Fun Fact title:", 'unload'),
                        "param_name" => "funt2",
                        "description" => esc_html__("Enter the fun factor title.", 'unload')
                    ),
                    array(
                        "type" => "iconpicker",
                        "heading" => esc_html__("2nd Fun Fact icon:", 'unload'),
                        "param_name" => "funicon2",
                        "description" => esc_html__("Select the icon from the library.", 'unload')
                    ),
                    array(
                        "type" => "un-number",
                        "heading" => esc_html__("2nd Fun Fact Number:", 'unload'),
                        "param_name" => "funnub2",
                        'min' => '1',
                        'max' => '10000000',
                        'step' => '1',
                        "description" => esc_html__("Enter the fun factor number.", 'unload')
                    ),
                    array(
                        "type" => "un_toggle",
                        "heading" => esc_html__("About Button", 'unload'),
                        "param_name" => "about",
                        'value' => 'off',
                        'default_set' => false,
                        'options' => array(
                            'on' => array(
                                'on' => __('Yes', 'unload'),
                                'off' => __('No', 'unload'),
                            ),
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Select Page:", 'unload'),
                        "param_name" => "aboutpage",
                        "description" => esc_html__("Select the page that you want to link.", 'unload'),
                        "value" => array_flip((new unload_Helper)->unload_posts('page')),
                        'dependency' => array(
                            'element' => 'about',
                            'value' => array('on')
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Title:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the title of the button.", 'unload'),
                        'dependency' => array(
                            'element' => 'about',
                            'value' => array('on')
                        ),
                    ),
                )
            );
            return apply_filters('unload_about_company_shortcode', $return);
        }
    }

    public static function unload_about_company_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        unload_Media::unload_singleton()->unload_eq(array('counter', 'waypoints'));
        ob_start();
        $isFull = ($fullwidth == 'on') ? 'col-md-12' : 'col-md-6';
        ?>
        <div id="about-shipment">
            <div class="row">
                <div class="<?php echo esc_attr($isFull) ?>">
                    <div class="safe-affordable-cargo">
                        <div class="title2">
                            <strong><?php echo esc_html($subtitle) ?></strong>
                            <h2><?php echo esc_html($title) ?></h2>
                        </div>
                        <p itemprop="description"><?php echo esc_html($desc) ?></p>
                        <div class="services1">
                            <div class="row">
                                <?php if (!empty($funnub1)): ?>
                                    <div class="col-md-6">
                                        <div class="simple-services1">
                                            <div class="service-box1">
                                                <i class="<?php echo esc_attr($funicon1) ?>"></i>
                                                <h5 class="counter"><?php echo esc_html($funnub1) ?></h5>
                                                <span><?php echo esc_html($funt1) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($funnub2)): ?>
                                    <div class="col-md-6">
                                        <div class="simple-services1">
                                            <div class="service-box1">
                                                <i class="<?php echo esc_attr($funicon2) ?>"></i>
                                                <h5 class="counter"><?php echo esc_html($funnub2) ?></h5>
                                                <span><?php echo esc_html($funt2) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($about == 'on'): ?>
                            <a class="theme-btn dark" href="<?php //echo get_page_link($aboutpage) ?>" title="">
                                <i class="fa fa-paper-plane"></i> <?php echo esc_html($btn) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                if (!empty($imgage)):
                    $src = wp_get_attachment_image_src($imgage, 'unload_570x423');
                    ?>
                    <div class="<?php echo esc_attr($isFull) ?>">
                        <div class="about-shipment-thumb">
                            <img src="<?php echo esc_url($H->unload_set($src, '0')) ?>" alt="" itemprop="image"/>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        $jsOutput = "jQuery(document).ready(function ($) {
		        'use strict';
		        $('.counter').counterUp({
		            delay: 10,
		            time: 1000
		        });
		    });";
        wp_add_inline_script('unload-waypoints', $jsOutput);
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
