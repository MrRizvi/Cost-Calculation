<?php

class unload_gallery_Widget extends WP_Widget
{

    static $counter = 0;
    public $h;

    public function __construct()
    {
        $this->h = new unload_Helper();
        $widget_ops = array(
            'description' => esc_html__('This widget is used to show gallery images.', 'unload')
        );
        $control_ops = array(
            'width' => 250,
            'height' => 350,
            'id_base' => 'unload-gallery'
        );
        parent::__construct('unload-gallery', esc_html__('Gallery Unload', 'unload'), $widget_ops, $control_ops);
        add_action('admin_enqueue_scripts', array($this, 'unload_uploadScripts'));
    }

    public function unload_uploadScripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', unload_Uri . 'partial/js/upload-media.js', array('jquery'));

        wp_enqueue_style('thickbox');
    }

    public function widget($args, $instance)
    {
        extract($args);
        $defaults = array('title' => esc_html__('Gallery', 'unload'), 'subtitle' => esc_html__('Uniquely Pursue', 'unload'), 'images' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        echo wp_kses($before_widget, true);
        $widgetTitle = esc_html($this->h->unload_set($instance, 'title'));
        $widgetSubTitle = esc_html($this->h->unload_set($instance, 'subtitle'));
        $title = apply_filters(
            'widget_title', ($widgetTitle == '') ? '' : $widgetTitle, array('subtitle' => $widgetSubTitle), $this->id_base
        );
        unload_Media::unload_singleton()->unload_eq(array('poptrox'));
        ?>
        <div class="widget widgets1">
            <?php echo wp_kses($before_title . $title . $after_title, true); ?>
            <div class="widget-data gallery-photos">
                <div class="row">
                    <?php
                    $imges = explode(',', $instance['images']);
                    if (!empty($imges)) {
                        foreach ($imges as $img) {
                            $srcSM = wp_get_attachment_image_src($img, 'thumbnail');
                            $srcFL = wp_get_attachment_image_src($img, 'full');
                            ?>
                            <div class="col-md-4">
                                <a href="<?php echo esc_url($this->h->unload_set($srcFL, '0')) ?>"
                                   data-lightbox="gallery-set" title="" itemprop="url">
                                    <img src="<?php echo esc_url($this->h->unload_set($srcSM, '0')) ?>" alt=""
                                         itemprop="image"/>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php ob_start(); ?>
        jQuery(document).ready(function ($) {
        'use strict';

        $('.gallery-photos').poptrox({
        usePopupCaption: false,
        usePopupNav: true
        });
        });
        <?php
        $jsOutput = ob_get_contents();
        ob_end_clean();
        wp_add_inline_script('unload-poptrox', $jsOutput);
        echo wp_kses($after_widget, true);
    }

    /* Store */

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['subtitle'] = $new_instance['subtitle'];
        $instance['images'] = $new_instance['images'];

        return $instance;
    }

    /* Settings */

    public function form($instance)
    {

        $defaults = array('title' => esc_html__('Gallery', 'unload'), 'subtitle' => esc_html__('Uniquely Pursue', 'unload'), 'images' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        ?>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'unload'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($instance['title']); ?>"/>
        </p>

        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php esc_html_e('Sub Title:', 'unload'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text"
                   value="<?php echo esc_attr($instance['subtitle']); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('images')); ?>"><?php esc_html_e('Images:', 'unload'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('images')); ?>" class="widefat"
                   value="<?php echo esc_attr($instance['images']); ?>"/>
            <input type="button" value="<?php esc_html_e('Upload Image', 'unload'); ?>"
                   class="button widefat custom_media_upload"
                   id="<?php echo esc_attr($this->get_field_id('images')); ?>"/>
        </p>
        <?php
    }

}
