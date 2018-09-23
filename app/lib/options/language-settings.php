<?php

class unload_languageSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-fontsize';
        $this->id = 'language-uploader';
        $this->title = esc_html__('Language Uploader', 'unload');
        $this->desc = esc_html__('Unload Theme localization Settings', 'unload');
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
                'id' => 'optLanguage',
                'type' => 'language'
            )
        );
    }

}
