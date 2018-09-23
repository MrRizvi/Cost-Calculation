<?php

class unload_bookingSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-wrench';
        $this->id = 'booking';
        $this->title = esc_html__('Booking', 'unload');
        $this->desc = esc_html__('Unload Theme Booking Settings', 'unload');
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
                'id' => 'optBookingTitle',
                'type' => 'text',
                'title' => esc_html__('Title', 'unload')
            ),
            array(
                'id' => 'optBookingSubTitle',
                'type' => 'text',
                'title' => esc_html__('Sub Title', 'unload')
            ),
            array(
                'id' => 'optBookingDesc',
                'type' => 'textarea',
                'title' => esc_html__('Description', 'unload')
            ),
            array(
                'id' => 'optBookingSideImg',
                'type' => 'media',
                'title' => esc_html__('Upload side image', 'unload'),
            ),
            array(
                'id' => 'optBookingBgImg',
                'type' => 'media',
                'title' => esc_html__('Upload background image', 'unload'),
            ),
            array(
                'id' => 'optBookingBtnTxt',
                'type' => 'text',
                'title' => esc_html__('Button Text', 'unload')
            ),
            array(
                'id' => 'optBookingTemsTxt',
                'type' => 'text',
                'title' => esc_html__('Term\'s & Condition Text', 'unload')
            ),
            array(
                'id' => 'optBookingTerm',
                'type' => 'switch',
                'title' => esc_html__('Show Terms & Condition', 'unload'),
                'default' => FALSE,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBookingTermPage',
                'type' => 'select',
                'title' => esc_html__('Terms & Conditions Page', 'unload'),
                'desc' => esc_html__('Select the page for terms & condition page', 'unload'),
                'required' => array('optBookingTerm', '=', TRUE),
                'data' => 'pages'
            ),
            array(
                'id' => 'optBookingPrivacy',
                'type' => 'switch',
                'title' => esc_html__('Show Privacy Plolicy', 'unload'),
                'default' => FALSE,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBookingPrivacyPage',
                'type' => 'select',
                'title' => esc_html__('Privacy Policy Page', 'unload'),
                'desc' => esc_html__('Select the page for privacy policy page', 'unload'),
                'required' => array('optBookingPrivacy', '=', TRUE),
                'data' => 'pages'
            ),
            array(
                'id' => 'optBookingOrderPrfix',
                'type' => 'text',
                'title' => esc_html__('Order Prefix', 'unload')
            ),
            array(
                'id' => 'optBookingMsg',
                'type' => 'textarea',
                'title' => esc_html__('Success Message', 'unload')
            ),
            array(
                'id' => 'optBookingMailTemplate',
                'type' => 'textarea',
                'title' => esc_html__('Enter email template display site name plase use {{site}} and use for Sender Name {{name}}', 'unload')
            ),
            array(
                'id' => 'optBookingFromMail',
                'type' => 'text',
                'title' => esc_html__('Set from mail', 'unload')
            )
        );
    }

}
