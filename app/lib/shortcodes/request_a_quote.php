<?php

class unload_request_a_quote_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_request_a_quote($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Request A Quote", 'unload'),
                "base" => "unload_request_a_quote_output",
                "icon" => 'request_a_quote.png',
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
                        "heading" => esc_html__("Sub Title:", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Title Icon', 'unload'),
                        'param_name' => 'icon',
                        'description' => esc_html__('Select icon from library.', 'unload'),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btn",
                        "description" => esc_html__("Enter the button text.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Receiving Email:", 'unload'),
                        "param_name" => "email",
                        "description" => esc_html__("Enter the email address to get all quotes.", 'unload')
                    ),
                    array(
                        "type" => "un_toggle",
                        "heading" => esc_html__("Over Laping", 'unload'),
                        "param_name" => "overlap",
                        'value' => 'off',
                        'default_set' => false,
                        'options' => array(
                            'on' => array(
                                'on' => __('Yes', 'unload'),
                                'off' => __('No', 'unload'),
                            ),
                        )
                    )
                )
            );
            return apply_filters('unload_request_a_quote_shortcode', $return);
        }
    }

    public static function unload_request_a_quote_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        $lap = ($overlap == 'on') ? 'overlape2' : '';
        unload_Media::unload_singleton()->unload_eq(array('bootstrap', 'jplugin', 'datepick'));
        ?>
        <div class="request-free-quote <?php echo esc_attr($lap) ?>">
            <div class="heading2">
                <i class="<?php echo esc_attr($icon) ?>"></i>
                <span><?php echo esc_html($subtitle) ?></span>
                <h3><?php echo esc_html($title) ?></h3>
            </div>

            <div class="request-quote-body">
                <div class="log"></div>
                <form id="requestQuote">
                    <div class="row">
                        <div class="col-md-12">
                            <label><input id="name" type="text" class="text-field"
                                          placeholder="<?php esc_html_e('Name', 'unload') ?>"/></label>
                        </div>
                        <div class="col-md-12">
                            <label><i class="fa fa-envelope"></i><input id="quoteemail" type="email" class="text-field"
                                                                        placeholder="<?php esc_html_e('Email Address', 'unload') ?>"/></label>
                        </div>
                        <div class="col-md-12">
                           
                                <label><i class="fa fa-calendar"></i><input class="datepicker" id="fromdate" type="text"
                                       placeholder="<?php esc_html_e('Select Date From', 'unload') ?>"/></label>
                        </div>
                        <div class="col-md-12">
                               <label><i class="fa fa-calendar"></i><input class="datepicker" id="todate" type="text"
                                       placeholder="<?php esc_html_e('Select Date To', 'unload') ?>"/></label>
                        </div>
                        <div class="col-md-12">
                            <textarea id="msg" placeholder="<?php esc_html_e('Message', 'unload') ?>"></textarea>
                        </div>
                    </div>
                    <input id="recMail" type="hidden" name="recMail" value="<?php echo esc_attr($email) ?>"/>
                    <input id="ajax_quote_nonce" type="hidden" name="ajax_quote_nonce"
                           value="<?php echo wp_create_nonce('ajax_quote_nonce'); ?>"/>
                </form>
                <?php if (!empty($btn)): ?>
                    <a id="requestQuoteProcess" href="javascript:void(0)" title="" itemprop="url" class="theme-btn">
                        <i class="fa fa-paper-plane"></i> <?php echo esc_html($btn) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php ob_start(); ?>
        jQuery(document).ready(function ($) {
        $('.datepicker').datepick();
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-datepick', $jsOutput);
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }

}
