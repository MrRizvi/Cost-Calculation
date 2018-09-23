<?php

class unload_footerbuilderSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'footerbuilder';
        $this->title = esc_html__('Footer Builder', 'unload');
        $this->desc = esc_html__('Unload Theme Footer Builder Settings', 'unload');
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
                'id' => 'optFooterBuilder',
                'type' => 'multi_builder',
                'title' => esc_html__('Daynamic Footer Builder', 'unload'),
                'full_width' => true,
            )
        );
    }

}
