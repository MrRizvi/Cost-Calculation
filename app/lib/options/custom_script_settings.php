<?php

class unload_scriptSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'script';
        $this->title = esc_html__('Custom Script', 'unload');
        $this->desc = esc_html__('Unload Theme Custom Script Settings', 'unload');
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
                'id' => 'header_code',
                'type' => 'textarea',
                'title' => esc_html__('Header Code', 'unload'),
                'desc' => esc_html__('Enter the the header code wich you want to add in page head top section like css/script/meta etc', 'unload'),
            ),
            array(
                'id'       => 'footer_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Footer Javascript', 'unload' ),
                'subtitle' => esc_html__( 'Enter javascript code to add in page footer section', 'unload' ),
                'mode'     => 'javascript',
                'theme'    => 'monokai',
            ),
            array(
                'id'       => 'footer_css',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom Styling for Footer Bottom Bar Section', 'unload' ),
                'subtitle' => esc_html__( 'Enter css class properties to add in page footer bottom bar section', 'unload' ),
            ),
        );
    }

}
