<?php

class unload_newsletterSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'newsletter';
        $this->title = esc_html__('Newsletter', 'unload');
        $this->desc = esc_html__('Unload Theme Newsletter Settings', 'unload');
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
                'id' => 'optMailchimpApiKey',
                'type' => 'text',
                'title' => esc_html__('MailChimp API Key', 'unload'),
                'desc' => sprintf(esc_html__('Enter your MailChimp API Key. You can get it %s.', 'unload'), '<a target="_blank" href="https://admin.mailchimp.com/account/api-key-popup">' . esc_html__('here', 'unload') . '</a>'),
            ),
            array(
                'id' => 'optMailchimpListId',
                'type' => 'text',
                'title' => esc_html__('MailChimp List ID', 'unload'),
                'desc' => sprintf(esc_html__('Enter your List ID. You can get it %s.', 'unload'), '<a target="_blank" href="https://admin.mailchimp.com/lists/">' . esc_html__('here', 'unload') . '</a>')
            ),
        );
    }

}
