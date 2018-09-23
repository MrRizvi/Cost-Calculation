<?php

class unload_ContactSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-envelope';
        $this->id = 'contact';
        $this->title = esc_html__('Contact Us', 'unload');
        $this->desc = esc_html__('Unload Theme Contact Settings', 'unload');
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
                'id' => 'optContactMail',
                'type' => 'text',
                'title' => esc_html__('Email', 'unload'),
                'desc' => esc_html__('Enter email address to receive collect email from contact form', 'unload'),
            ),
            array(
                'id' => 'optContactMap',
                'type' => 'text',
                'title' => esc_html__('Google Map', 'unload'),
                'desc' => esc_html__('Enter google map Latitude & Longitude with Comma seprated', 'unload'),
            ),
            array(
                'id' => 'optusemultiplemap',
                'type' => 'switch',
                'title' => esc_html__('Use Multiple Location', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optmapposition',
                'type' => 'multi_text',
                'title' => esc_html__('Map Position', 'unload'),
                'desc' => esc_html__('Enter google map Latitude & Longitude with Comma seprated', 'unload'),
                'required' => array('optusemultiplemap', '=', true)
            ),
            array(
                'id' => 'optContactMessage',
                'type' => 'textarea',
                'title' => esc_html__('Success Message', 'unload')
            ),
            array(
                'id' => 'optOfficeInfo',
                'type' => 'switch',
                'title' => esc_html__('Office Info', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optContactInfoStart',
                'type' => 'section',
                'title' => esc_html__('Office Information', 'unload'),
                'indent' => true,
                'required' => array('optOfficeInfo', '=', true)
            ),
            array(
                'id' => 'optOfficeInfoBg',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Background Image', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optOfficeInfoTitle',
                'type' => 'text',
                'url' => true,
                'title' => esc_html__('Title', 'unload'),
            ),
            array(
                'id' => 'optOfficeInfoSubTitle',
                'type' => 'text',
                'url' => true,
                'title' => esc_html__('Sub Title', 'unload'),
            ),
            array(
                'id' => 'optOfficeInfoAddress',
                'type' => 'textarea',
                'url' => true,
                'title' => esc_html__('Office Address', 'unload'),
            ),
            array(
                'id' => 'optOfficeInfoContact',
                'type' => 'multi_text',
                'title' => esc_html__('Contact Number', 'unload'),
            ),
            array(
                'id' => 'optOfficeInfoEmail',
                'type' => 'text',
                'url' => true,
                'title' => esc_html__('Email ID', 'unload'),
            ),
            array(
                'id' => 'optOfficeInfoTiming',
                'type' => 'text',
                'url' => true,
                'title' => esc_html__('Office Timing', 'unload'),
            ),
            array(
                'id' => 'optContactInfoEnd',
                'type' => 'section',
                'indent' => false,
            ),
        );
    }

}
