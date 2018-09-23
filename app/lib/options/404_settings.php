<?php

class unload_404Settings
{

    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = '404';
        $this->title = esc_html__('404', 'unload');
        $this->desc = esc_html__('Unload Theme 404 Settings', 'unload');
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
                'id' => 'opt404Header',
                'type' => 'switch',
                'title' => esc_html__('Header Section', 'unload'),
                'desc' => esc_html__('Show or hide search page header section', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'opt404HeaderTitle',
                'type' => 'text',
                'title' => esc_html__('Header Title', 'unload'),
                'required' => array('opt404Header', '=', true)
            ),
            array(
                'id' => 'opt404HeaderSubTitle',
                'type' => 'text',
                'title' => esc_html__('Header Sub Title', 'unload'),
                'required' => array('opt404Header', '=', true)
            ),
            array(
                'id' => 'opt404HeaderBg',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Header Background', 'unload'),
                'compiler' => 'true',
                'required' => array('opt404Header', '=', true)
            ),
            array(
                'id' => 'opt404Text',
                'type' => 'text',
                'title' => esc_html__('404 Text', 'unload')
            ),
            array(
                'id' => 'opt404SubText',
                'type' => 'text',
                'title' => esc_html__('404 Sub Text', 'unload')
            ),
            array(
                'id' => 'opt404Button',
                'type' => 'switch',
                'title' => esc_html__('Home Button', 'unload'),
                'desc' => esc_html__('Show or hide 404 home button', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'opt404BtnText',
                'type' => 'text',
                'title' => esc_html__('404 Sub Text', 'unload'),
                'default' => esc_html__('GO BACK HOME', 'unload'),
                'required' => array('opt404Button', '=', true)
            )
        );
    }

}
