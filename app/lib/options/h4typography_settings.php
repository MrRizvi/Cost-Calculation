<?php

class unload_h4typographySettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'h4typography';
        $this->title = esc_html__('H4 Styling', 'unload');
        $this->desc = esc_html__('Unload Theme H4 Typography Settings', 'unload');
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
                'id' => 'optH4Typo',
                'type' => 'switch',
                'title' => esc_html__('H4 Typography', 'unload'),
                'desc' => esc_html__('Show or hide body typography', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'required' => array('optH4Typo', '=', true),
                'id' => 'optH4Typography',
                'type' => 'typography',
                'title' => esc_html__('H4 Typography', 'unload'),
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
