<?php

class unload_video_Widget extends WP_Widget
{

    static $counter = 0;
    public $h;

    public function __construct()
    {
        $this->h = new unload_Helper();
        $widget_ops = array(
            'description' => esc_html__('This widget is used to show vidoe popup.', 'unload')
        );
        $control_ops = array(
            'width' => 250,
            'height' => 350,
            'id_base' => 'unload-video'
        );
        parent::__construct('unload-video', esc_html__('Video PopUp Unload', 'unload'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $defaults = array('title' => esc_html__('CARGO VIDEO', 'unload'), 'subtitle' => esc_html__('Uniquely Pursue', 'unload'), 'vidtitle' => '', 'bg' => '', 'vidurl' => '');
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
            <div class="widget-data">
                <div class="cargo-video">
                    <img src="<?php echo esc_url($instance['bg']) ?>" alt="" itemprop="image"/>
                    <div class="cargo-video-cap lightbox">
                        <a href="<?php echo esc_url($instance['vidurl']) ?>" itemprop="url" title=""><i
                                class="fa fa-play"></i></a>
                        <p><?php echo esc_html($instance['vidtitle']) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php ob_start(); ?>
        jQuery(document).ready(function ($) {
        'use strict';

        $('.cargo-video').poptrox({
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
        $instance['vidtitle'] = $new_instance['vidtitle'];
        $instance['bg'] = $new_instance['bg'];
        $instance['vidurl'] = $new_instance['vidurl'];

        return $instance;
    }

    /* Settings */

    public function form($instance)
    {

        $defaults = array('title' => esc_html__('CARGO VIDEO', 'unload'), 'subtitle' => esc_html__('Uniquely Pursue', 'unload'), 'vidtitle' => '', 'bg' => '', 'vidurl' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        ?>
        < p >
        < label for = "<?php echo esc_attr($this->get_field_id('title')); ?>" ><?php esc_html_e('Title:', 'unload'); ?> < /label>
        < input class = "widefat" id = "<?php echo esc_attr($this->get_field_id('title')); ?>" name = "<?php echo esc_attr($this->get_field_name('title')); ?>" type = "text" value = "<?php echo esc_attr($instance['title']); ?>" / >
        < /p>

        < p >
        < label for = "<?php echo esc_attr($this->get_field_id('subtitle')); ?>" ><?php esc_html_e('Sub Title:', 'unload'); ?> < /label>
        < input class = "widefat" id = "<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name = "<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type = "text" value = "<?php echo esc_attr($instance['subtitle']); ?>" / >
        < /p>
        < p >
        < label for = "<?php echo esc_attr($this->get_field_id('vidtitle')); ?>" ><?php esc_html_e('Video Title:', 'unload'); ?> < /label>
        < input class = "widefat" id = "<?php echo esc_attr($this->get_field_id('vidtitle')); ?>" name = "<?php echo esc_attr($this->get_field_name('vidtitle')); ?>" type = "text" value = "<?php echo esc_attr($instance['vidtitle']); ?>" / >
        < /p>
        < p >
        < label for = "<?php echo esc_attr($this->get_field_id('bg')); ?>" ><?php esc_html_e('Background Image:', 'unload'); ?> < /label>
        < input class = "widefat" id = "<?php echo esc_attr($this->get_field_id('bg')); ?>" name = "<?php echo esc_attr($this->get_field_name('bg')); ?>" type = "text" value = "<?php echo esc_attr($instance['bg']); ?>" / >
        < /p>
        < p >
        < label for = "<?php echo esc_attr($this->get_field_id('vidurl')); ?>" ><?php esc_html_e('Video Url (vimeo, youtube):', 'unload'); ?> < /label>
        < input class = "widefat" id = "<?php echo esc_attr($this->get_field_id('vidurl')); ?>" name = "<?php echo esc_attr($this->get_field_name('vidurl')); ?>" type = "text" value = "<?php echo esc_attr($instance['vidurl']); ?>" / >
        < /p>
        <?php
    }

}
