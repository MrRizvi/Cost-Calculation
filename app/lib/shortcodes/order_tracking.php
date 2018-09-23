<?php

class unload_order_tracking_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_order_tracking($atts = null)
    {
        $H = new unload_Helper();
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Order Tracking", 'unload'),
                "base" => "unload_order_tracking_output",
                "icon" => 'order_tracking.png',
                "category" => esc_html__('Unload', 'unload'),
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Description", 'unload'),
                        "param_name" => "desc",
                        "description" => esc_html__("Enter the short description for this section.", 'unload')
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Button Text:", 'unload'),
                        "param_name" => "btn",
                        "default" => esc_html__('Proceed Now', 'unload'),
                        "description" => esc_html__("Enter the button text.", 'unload')
                    ),
                    array(
                        "type" => "attach_images",
                        "heading" => esc_html__("Background Image:", 'unload'),
                        "param_name" => "backgroundimg",
                        "description" => esc_html__("Upload background image.", 'unload')
                    )
                )
            );
            return apply_filters('unload_order_tracking_shortcode', $return);
        }
    }

    public static function unload_order_tracking_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        unload_Media::unload_singleton()->unload_eq(array('bootstrap'));
        ob_start();
        $imgSrc = wp_get_attachment_image_src($backgroundimg, 'full');
        ?>
        <div class="shipment-visibility blackish"
             style="background:url(<?php echo esc_url($H->unload_set($imgSrc, '0')) ?>)  no-repeat scroll center / cover">
            <span><i class="fa fa-stumbleupon"></i></span>
            <?php if (!empty($title)): ?><h4><?php echo esc_html($title) ?></h4><?php endif; ?>
            <?php if (!empty($desc)): ?><p><?php echo esc_html($desc) ?></p><?php endif; ?>
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
