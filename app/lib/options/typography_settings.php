<?php

class unload_typographySettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-text-width';
        $this->id = 'typography';
        $this->title = esc_html__('Typography', 'unload');
        $this->desc = esc_html__('Unload Theme Typography Settings', 'unload');
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
        return array();
    }

}
