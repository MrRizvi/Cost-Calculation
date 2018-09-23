<?php

class unload_about_Widget extends WP_Widget
{

    public $h;

    public function __construct()
    {
        $this->h = new unload_Helper();
        $widget_ops = array(
            'description' => esc_html__('This widget is used to show about unload.', 'unload')
        );
        $control_ops = array(
            'width' => 250,
            'height' => 350,
            'id_base' => 'unload-about'
        );
        parent::__construct('unload-about', esc_html__('Footer About Unload', 'unload'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        $h = new unload_Helper;
        $opt = $h->unload_opt();
        extract($args);
        $defaults = array('logo' => '', 'desc' => '', 'social_icons' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        echo wp_kses($before_widget, true);
        ?>
        <div class="about-widget">
            <div class="logo">
                <?php if ($h->unload_set($instance, 'logo') != ''): ?>
                    <a itemprop="url" href="<?php echo esc_url(home_url('/')) ?>" title="">
                        <img itemprop="image" src="<?php echo esc_url($h->unload_set($instance, 'logo')) ?>" alt=""/>
                    </a>
                <?php endif; ?>
            </div>
            <?php if ($h->unload_set($instance, 'desc') != ''): ?>
                <p itemprop="description"><?php echo esc_html($h->unload_set($instance, 'desc')) ?></p>
                <?php
            endif;
            if ($h->unload_set($instance, 'social_icons') == 'true'):
                $social = $h->unload_set($opt, 'optFooterSocialicons');
                ?>
                <ul class="social-btn">
                    <?php
                    if (!empty($social) && count($social) > 0):
                        foreach ($social as $s):
                            $data = json_decode(urldecode($h->unload_set($s, 'data')));
                            if ($data->enable == 'true'):
                                ?>
                                <li>
                                    <a itemprop="url" href="<?php echo esc_url($data->url) ?>">
                                        <i class="fa <?php echo esc_attr($data->icon) ?>"></i>
                                    </a>
                                </li>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </ul>
                <?php
            endif;
            ?>
        </div>
        <?php
        echo wp_kses($after_widget, true);
    }

    /* Store */

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['logo'] = $new_instance['logo'];
        $instance['desc'] = $new_instance['desc'];
        $instance['social_icons'] = $new_instance['social_icons'];

        return $instance;
    }

    /* Settings */

    public function form($instance)
    {
        $defaults = array('logo' => '', 'desc' => '', 'social_icons' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        $options = array('true' => esc_html__('True', 'unload'), 'false' => esc_html__('False', 'unload'));
        ?>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('logo')); ?>"><?php esc_html_e('Logo Url:', 'unload'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('logo')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('logo')); ?>" type="text"
                   value="<?php echo esc_attr($instance['logo']); ?>"/>
        </p>

        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php esc_html_e('Short Description:', 'unload'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('desc')); ?>"
                      name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_attr($instance['desc']); ?></textarea>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('social_icons')); ?>"><?php esc_html_e('Social Icons:', 'unload'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('social_icons')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('social_icons')); ?>">
                <?php
                if (!empty($options) && count($options) > 0) {

                    foreach ($options as $key => $val) {
                        if (!empty($instance['social_icons'])) {
                            $selected = ($key == $instance['social_icons']) ? 'selected="selected"' : '';
                        } else {
                            $selected = '';
                        }
                        echo '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
                    }
                }
                ?>

            </select>
        </p>
        <?php
    }

}
