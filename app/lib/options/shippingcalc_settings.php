<?php

class unload_ShippingCalcSettings {

    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct() {
        $this->icon = 'el-wrench';
        $this->id = 'shippingcalc';
        $this->title = esc_html__('Shipping Calculator', 'unload');
        $this->desc = esc_html__('Unload Theme Shipping Clculator', 'unload');
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function unload_init() {
        return array(
            array(
                'id' => 'optShippingTitle',
                'type' => 'text',
                'title' => esc_html__('Title', 'unload')
            ),
            array(
                'id' => 'optShippingSubTitle',
                'type' => 'text',
                'title' => esc_html__('Sub Title', 'unload')
            ),
            array(
                'id' => 'optShippingbtn',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'unload')
            ),
            array(
                'id' => 'optShippingEmail',
                'type' => 'text',
                'title' => esc_html__('Email id for receiving email\'s', 'unload')
            ),
            array(
                'id' => 'optShippingImg',
                'type' => 'media',
                'title' => esc_html__('Upload background image', 'unload'),
            ),
            array(
                'id' => 'opthideservice',
                'type' => 'switch',
                'title' => esc_html__('Hide "Services" Field', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'opthidelength',
                'type' => 'switch',
                'title' => esc_html__('Hide "Length" Field', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'opthideheight',
                'type' => 'switch',
                'title' => esc_html__('Hide "Height" Field', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'opthidewight',
                'type' => 'switch',
                'title' => esc_html__('Hide "Wieght" Field', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optShippingFeatures',
                'type' => 'multi_text',
                'title' => esc_html__('Extra Features', 'unload')
            ),
            array(
                'id' => 'optShippingadditionalfields',
                'type' => 'multi_text',
                'title' => esc_html__('Extra Form Fields', 'unload')
            )
        );
    }

}
