<?php

class unload_recent_posts_Widget extends WP_Widget
{

    public $h;

    public function __construct()
    {
        $this->h = new unload_Helper();
        $widget_ops = array(
            'description' => esc_html__('This widget is used to show recent posts.', 'unload')
        );
        $control_ops = array(
            'width' => 250,
            'height' => 350,
            'id_base' => 'unload-recent-posts'
        );
        parent::__construct('unload-recent-posts', esc_html__('Recent Posts Unload', 'unload'), $widget_ops, $control_ops);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $defaults = array('title' => esc_html__('Recent Posts', 'unload'), 'subtitle' => esc_html__('Uniquely Pursue', 'unload'), 'number' => '3', 'category' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        echo wp_kses($before_widget, true);
        $widgetTitle = esc_html($this->h->unload_set($instance, 'title'));
        $widgetSubTitle = esc_html($this->h->unload_set($instance, 'subtitle'));
        $title = apply_filters(
            'widget_title', ($widgetTitle == '') ? '' : $widgetTitle, array('subtitle' => $widgetSubTitle), $this->id_base
        );
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'showposts' => $this->h->unload_set($instance, 'number')
        );
        if ($this->h->unload_set($instance, 'category') != '') {
            $args['category_name'] = implode(',', $this->h->unload_set($instance, 'category'));
        }
        $query = new WP_Query($args);
        ?>
        <div class="widget widgets1">
            <?php
            echo wp_kses($before_title . $title . $after_title, true);
            if ($query->have_posts()) {
                echo '<div class="widget-data">';
                while ($query->have_posts()) {
                    $query->the_post();
                    $year = get_the_time('Y');
                    $month = get_the_time('m');
                    $day = get_the_time('d');
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="recent-post-widget">
                            <?php the_post_thumbnail('thumbnail') ?>
                            <div class="recent-post-content">
                                <h4><a href="<?php the_permalink() ?>"
                                       title="<?php the_title() ?>"><?php the_title() ?></a></h4>
                                <ul class="post-meta2">
                                    <li>
                                        <i class="fa fa-calendar-o"></i>
                                        <a href="<?php echo esc_url($this->h->unload_dateLink(false)) ?>" title=""
                                           itemprop="datePublished"
                                           content="<?php echo get_the_date(get_option('post_format')) ?>"><?php echo get_the_date(get_option('post_format')) ?></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-user"></i>
                                        <?php esc_html_e('By', 'unload') ?>
                                        <a href="<?php echo esc_url($this->h->unload_authorLink(false)) ?>" title=""
                                           itemprop="url"><?php the_author() ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
        echo wp_kses($after_widget, true);
    }

    /* Store */

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['subtitle'] = $new_instance['subtitle'];
        $instance['number'] = $new_instance['number'];
        $instance['category'] = $new_instance['category'];

        return $instance;
    }

    /* Settings */

    public function form($instance)
    {
        $defaults = array('title' => esc_html__('Recent Posts', 'unload'), 'subtitle' => esc_html__('Uniquely Pursue', 'unload'), 'number' => '3', 'category' => '');
        $instance = wp_parse_args((array)$instance, $defaults);
        $options = (new unload_helper)->unload_cat(array('taxonomy' => 'category', 'hide_empty' => true), true);
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
                for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of Posts:', 'unload'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number"
                   value="<?php echo esc_attr($instance['number']); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Select Categories:', 'unload'); ?></label>
            <select multiple="multiple" class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('category')); ?>[]">
                <?php
                if (!empty($options) && count($options) > 0) {
                    foreach ($options as $key => $val) {
                        if (!empty($instance['category'])) {
                            $selected = (in_array($key, $instance['category'])) ? 'selected="selected"' : '';
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
