<?php

class unload_newsletter_Widget extends WP_Widget
{

    static public $counter = 0;
    public $h;

    public function __construct()
    {
        $this->h = new unload_Helper();
        $widget_ops = array(
            'description' => esc_html__('This widget is used to show newsletter.', 'unload')
        );
        $control_ops = array(
            'width' => 250,
            'height' => 350,
            'id_base' => 'unload-newsletter'
        );
        parent::__construct('unload-newsletter', esc_html__('Footer Newsletter Unload', 'unload'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        $h = new unload_Helper;
        $opt = $h->unload_opt();
        extract($args);
        $defaults = array('title' => esc_html__('NEWSLETTER SUBSCRIBE', 'unload'), 'subtitle' => '', 'desc' => '', 'btntitle' => esc_html__('SUBMIT NOW', 'unload'));
        $instance = wp_parse_args((array)$instance, $defaults);
        echo wp_kses($before_widget, true);
        $widgetTitle = esc_html($this->h->unload_set($instance, 'title'));
        $widgetSubTitle = esc_html($this->h->unload_set($instance, 'subtitle'));
        $title = apply_filters(
            'widget_title', ($widgetTitle == '') ? '' : $widgetTitle, array('subtitle' => $widgetSubTitle), $this->id_base
        );
        ?>
        <div class="widget blue1">
            <?php
            echo wp_kses($before_title . $title . $after_title, true);
            $apiKey = $h->unload_set($opt, 'optMailchimpApiKey');
            $listId = $h->unload_set($opt, 'optMailchimpListId');
            if (!empty($apiKey) && !empty($listId)):
                ?>
                <div class="subscription-form">
                    <?php if ($h->unload_set($instance, 'desc') != ''): ?>
                        <p itemprop="description"><?php echo esc_html($h->unload_set($instance, 'desc')) ?></p>
                    <?php endif; ?>
                    <div class="widget-notify"></div>
                    <form id="widget-newsletter">
                        <input id="widget-newsletter_mail" type="text" placeholder="<?php esc_html_e('Enter Your Email Address', 'unload') ?>"/>
                        <input type="hidden" id="newsletter_key" value="<?php echo wp_create_nonce(Unload_KEY); ?>">
                        <a title="" href="javascript:void(0)"
                           class="theme-btn footer-newsletter<?php echo esc_attr(self::$counter) ?>">
                            <i class="fa fa-paper-plane"></i><?php echo esc_html($h->unload_set($instance, 'btntitle')) ?>
                        </a>
                    </form>
                </div>
                <?php
            else:
                ?>
                <div class="error-list">
                    <p><?php esc_html_e('Please fill MailChimp API Key and list id in theme options.', 'unload') ?></p>
                </div>
                <?php
            endif;
            ?>
        </div>
        <?php
        echo wp_kses($after_widget, true);
        self::$counter++;
    }

    /* Store */

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['subtitle'] = $new_instance['subtitle'];
        $instance['desc'] = $new_instance['desc'];
        $instance['btntitle'] = $new_instance['btntitle'];

        return $instance;
    }

    /* Settings */

    public function form($instance)
    {
        $defaults = array('title' => esc_html__('NEWSLETTER SUBSCRIBE', 'unload'), 'subtitle' => '', 'desc' => '', 'btntitle' => esc_html__('SUBMIT NOW', 'unload'));
        $instance = wp_parse_args((array)$instance, $defaults);
        $options = array('true' => esc_html__('True', 'unload'), 'false' => esc_html__('False', 'unload'));
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
                for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php esc_html_e('Description:', 'unload'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('desc')); ?>"
                      name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_attr($instance['desc']); ?></textarea>
        </p>

        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('btntitle')); ?>"><?php esc_html_e('Button Text:', 'unload'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('btntitle')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('btntitle')); ?>" type="text"
                   value="<?php echo esc_attr($instance['btntitle']); ?>"/>
        </p>
        <?php
    }

}
