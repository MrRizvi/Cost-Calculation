<?php

class unload_headerresSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'responsiveheader';
        $this->title = esc_html__('Responsive Header', 'unload');
        $this->desc = esc_html__('Unload Theme Responsive Header Setting', 'unload');
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function unload_init()
    {
        return array(
            array(
                'id' => 'optResHeaderLogo',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload Logo', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optResHeaderSigin',
                'type' => 'switch',
                'title' => esc_html__('Show Header Signin', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optResHeaderquote',
                'type' => 'switch',
                'title' => esc_html__('Show Shipping Calculator PopUp', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optResHeaderquoteText',
                'type' => 'text',
                'title' => esc_html__('Enter the button text', 'unload'),
                'required' => array('optResHeaderquote', '=', '1')
            ),
            array(
                'id' => 'optResHeaderTiming',
                'type' => 'switch',
                'title' => esc_html__('Show Header Timing', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
            ),
            array(
                'id' => 'optResHeaderTopBarTimingText',
                'type' => 'text',
                'title' => esc_html__('Enter the timing', 'unload'),
                'required' => array('optResHeaderTiming', '=', '1')
            ),
            array(
                'id' => 'optResHeaderShowContactNo',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Number', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optResHeaderContactNo',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Number', 'unload'),
                'required' => array('optResHeaderShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optResHeaderContactNoBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Office Location', 'unload'),
                'required' => array('optResHeaderShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optResHeaderShowContactEmail',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Email', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optResHeaderContactEmail',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Email', 'unload'),
                'required' => array('optResHeaderShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optResHeaderContactEmailBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Email Bottom Tag', 'unload'),
                'required' => array('optResHeaderShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optResHeaderTopBarSocialMedia',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Social Media', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
            ),
            array(
                'id' => 'optResHeaderTopBarSocialicons',
                'type' => 'social_media',
                //'heading' => true,
                'title' => esc_html__('Header Two Top Bar Social Media Builder', 'unload'),
                //'full_width' => true,
                'required' => array('optResHeaderTopBarSocialMedia', '=', '1')
            ),
        );
    }

}
