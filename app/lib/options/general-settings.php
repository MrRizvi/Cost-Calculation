<?php

class unload_generalSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-home';
        $this->id = 'general';
        $this->title = esc_html__('General', 'unload');
        $this->desc = esc_html__('Unload Theme General Settings', 'unload');
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
                'id' => 'optThemeRtl',
                'type' => 'switch',
                'title' => esc_html__('Theme RTL', 'unload'),
                'default' => FALSE,
                'on' => esc_html__('Enable', 'unload'),
                'off' => esc_html__('Disable', 'unload')
            ),
            array(
                'id' => 'optThemeColor',
                'type' => 'color',
                'output' => array('.site-title'),
                'title' => esc_html__('Theme Color', 'unload'),
                'default' => '#ffb400',
                'transparent' => FALSE
            ),
            // start google map api key
            array(
                'id' => 'optGoogleAreaStart',
                'type' => 'section',
                'title' => esc_html__('Google Settings', 'unload'),
                'indent' => TRUE,
            ),
            array(
                'id' => 'optGoogleMapApiKey',
                'type' => 'text',
                'title' => esc_html__('Enter Google Map Api Key', 'unload'),
            ),
            array(
                'id' => 'optGoogleCaptchSiteKey',
                'type' => 'text',
                'title' => esc_html__('Enter Google Captch Site Key', 'unload'),
            ),
            array(
                'id' => 'optGoogleCaptchSiteSecret',
                'type' => 'text',
                'title' => esc_html__('Enter Google Captch Site Secret', 'unload'),
            ),
            array(
                'id' => 'optGoogleAreaEnd',
                'type' => 'section',
                'indent' => FALSE,
            ),
            // end google map api key
        );
    }

}
