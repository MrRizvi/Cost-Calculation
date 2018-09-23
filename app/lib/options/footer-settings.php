<?php

class unload_footerSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'footer';
        $this->title = esc_html__('Footer', 'unload');
        $this->desc = esc_html__('Unload Theme Footer Settings', 'unload');
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
                'id' => 'optFooter',
                'type' => 'switch',
                'title' => esc_html__('Show Footer', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optFooterSectionStart',
                'type' => 'section',
                'title' => esc_html__('Footer Options', 'unload'),
                'indent' => true,
                'required' => array('optFooter', '=', true)
            ),
            array(
                'id' => 'optFooterNav',
                'type' => 'switch',
                'title' => esc_html__('Footer Menu', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optFooterBg',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload Footer Background Image', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optFooterSocialicons',
                'type' => 'social_media',
                //'heading' => true,
                'title' => esc_html__('Footer Social Media Builder', 'unload'),
                //'full_width' => true,
            ),
            array(
                'id' => 'optFooterCopyright',
                'type' => 'textarea',
                'validate' => 'html',
                'title' => __('Footer Copyright Text', 'unload'),
            ),
            array(
                'id' => 'optFooterSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
        );
    }

}
