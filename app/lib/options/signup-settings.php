<?php

class unload_signupSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-th-large';
        $this->id = 'signup';
        $this->title = esc_html__('Login & Sign Up', 'unload');
        $this->desc = esc_html__('Unload Theme Login & Sign Up Settings', 'unload');
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
                'id' => 'optLoginRegBg',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload PopUp Background', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optLoginShow',
                'type' => 'switch',
                'title' => esc_html__('Show Login Area', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
            ),
            // start signin section
            array(
                'id' => 'optLoginSection',
                'type' => 'section',
                'title' => esc_html__('Login PopUp Section', 'unload'),
                'subtitle' => esc_html__('In this section set all available Login options.', 'unload'),
                'indent' => true,
                'required' => array('optLoginShow', '=', '1')
            ),
            array(
                'id' => 'optLoginTitle',
                'type' => 'text',
                'title' => esc_html__('Enter the login area title', 'unload')
            ),
            array(
                'id' => 'optLoginSubTitle',
                'type' => 'text',
                'title' => esc_html__('Enter the login area sub title', 'unload')
            ),
            array(
                'id' => 'optLoginDesc',
                'type' => 'textarea',
                'title' => esc_html__('Enter the login area description', 'unload')
            ),
            array(
                'id' => 'optLoginPassRemember',
                'type' => 'switch',
                'title' => esc_html__('Show Remember Password', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optLoginForgotPass',
                'type' => 'switch',
                'title' => esc_html__('Show Forgot Password', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optLoginBtnTitle',
                'type' => 'text',
                'title' => esc_html__('Enter the login button text', 'unload')
            ),
            array(
                'id' => 'optLoginSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
            // end signin section
            array(
                'id' => 'optRegisterShow',
                'type' => 'switch',
                'title' => esc_html__('Show Registration Area', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
            ),
            // start register section
            array(
                'id' => 'optRegSection',
                'type' => 'section',
                'title' => esc_html__('Registration PopUp Section', 'unload'),
                'subtitle' => esc_html__('In this section set all available Registration options.', 'unload'),
                'indent' => true,
                'required' => array('optRegisterShow', '=', '1')
            ),
            array(
                'id' => 'optRegTitle',
                'type' => 'text',
                'title' => esc_html__('Enter the registration area title', 'unload')
            ),
            array(
                'id' => 'optRegSubTitle',
                'type' => 'text',
                'title' => esc_html__('Enter the registration area sub title', 'unload')
            ),
            array(
                'id' => 'optRegDesc',
                'type' => 'textarea',
                'title' => esc_html__('Enter the registration area description', 'unload')
            ),
            array(
                'id' => 'optRegTerms',
                'type' => 'switch',
                'title' => esc_html__('Term & Condition', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
            ),
            array(
                'id' => 'optRegTermsText',
                'type' => 'text',
                'title' => esc_html__('Enter the Term & condition text', 'unload'),
                'required' => array('optRegTerms', '=', '1')
            ),
            array(
                'id' => 'optRegTermsPage',
                'type' => 'select',
                'data' => 'pages',
                'title' => esc_html__('Select Terms & Condition Page', 'unload'),
                'required' => array('optRegTerms', '=', '1')
            ),
            array(
                'id' => 'optRegBtnTitle',
                'type' => 'text',
                'title' => esc_html__('Enter the registration button text', 'unload')
            ),
            array(
                'id' => 'optRegSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
            // end register section
        );
    }

}
