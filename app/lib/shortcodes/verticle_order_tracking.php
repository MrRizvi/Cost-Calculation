<?php

class unload_verticle_order_tracking_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_verticle_order_tracking($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Horizontal Tracking bar", 'unload'),
                "base" => "unload_verticle_order_tracking_output",
                "icon" => 'verticle_order_tracking.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "iconpicker",
                        "heading" => esc_html__("Icon:", 'unload'),
                        "param_name" => "icon",
                        "description" => esc_html__("Select the icon from the library.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Sub Title", 'unload'),
                        "param_name" => "subtitle",
                        "description" => esc_html__("Enter the sub title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btn",
                        "default" => esc_html__('Proceed Now', 'unload'),
                        "description" => esc_html__("Enter the button text.", 'unload')
                    )
                )
            );
            return apply_filters('unload_verticle_order_tracking_shortcode', $return);
        }
    }

    public static function unload_verticle_order_tracking_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        unload_Media::unload_singleton()->unload_eq(array('bootstrap'));
        ob_start();
        ?>
        <div class="track-form">
            <div class="heading2">
                <?php if (!empty($icon)): ?><i class="<?php echo esc_html($icon) ?>"></i><?php endif; ?>
                <?php if (!empty($subtitle)): ?><span><?php echo esc_html($subtitle) ?></span><?php endif; ?>
                <?php if (!empty($title)): ?><h3><?php echo esc_html($title) ?></h3><?php endif; ?>
            </div>
            <form>
                <label>
                    <i class="fa fa-stumbleupon"></i>
                    <input name="trakingno" id="trakingno" type="text"
                           placeholder="<?php esc_html_e('Track a Shipment', 'unload') ?>:">
                </label>
                <input type="hidden" id="ordertracking_key" value="<?php echo wp_create_nonce(Unload_KEY); ?>">
                <a title="" href="javascript:void(0)" class="theme-btn">
                    <i class="fa fa-paper-plane"></i><?php echo esc_html($btn) ?>
                </a>
            </form>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
