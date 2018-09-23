<?php

class unload_h1typographySettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'h1typography';
        $this->title = esc_html__('H1 Styling', 'unload');
        $this->desc = esc_html__('Unload Theme H1 Typography Settings', 'unload');
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
                'id' => 'optH1Typo',
                'type' => 'switch',
                'title' => esc_html__('Body Typography', 'unload'),
                'desc' => esc_html__('Show or hide body typography', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'required' => array('optH1Typo', '=', true),
                'id' => 'optH1Typography',
                'type' => 'typography',
                'title' => esc_html__('H1 Typography', 'unload'),
                //'google' => true,
                //'font-backup' => true,
                'font-style' => true,
                //'subsets' => true,
                'font-size' => true,
                'line-height' => true,
                'word-spacing' => true,
                'letter-spacing' => true,
                'color' => true,
                'preview' => true,
                'all_styles' => true,
                //'output' => array( 'body' ),
                //'compiler' => array( 'body' ),
                'units' => 'px',
                'subtitle' => esc_html__('Typography option with each property can be called individually.', 'unload'),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
            ),
        );
    }

}
