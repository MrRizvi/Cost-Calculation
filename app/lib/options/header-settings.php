<?php

class unload_headerSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'header';
        $this->title = esc_html__('Header', 'unload');
        $this->desc = esc_html__('Unload Theme Header Settings', 'unload');
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
                'id' => 'optHeaderStyle',
                'type' => 'image_select',
                'title' => __('Select Header Style', 'unload'),
                'subtitle' => __('Select the header style for this theme.', 'unload'),
                'full_width' => true,
                'options' => array(
                    '1' => array(
                        'alt' => esc_html__('Header Style 1', 'unload'),
                        'img' => unload_Uri . 'partial/images/headers/1.jpg'
                    ),
                    '2' => array(
                        'alt' => esc_html__('Header Style 2', 'unload'),
                        'img' => unload_Uri . 'partial/images/headers/3.jpg'
                    ),
                    '3' => array(
                        'alt' => esc_html__('Header Style 3', 'unload'),
                        'img' => unload_Uri . 'partial/images/headers/4.jpg'
                    ),
                    '4' => array(
                        'alt' => esc_html__('Header Style 4', 'unload'),
                        'img' => unload_Uri . 'partial/images/headers/5.jpg'
                    )
                ),
                'default' => '1'
            ),
            array(
                'id' => 'optHeaderColor',
                'type' => 'color',
                'output' => array('.site-title'),
                'title' => esc_html__('Header Background Color', 'unload'),
                'default' => '#1f425d',
                'transparent' => FALSE
            ),
            array(
                'id' => 'optHeaderSearch',
                'type' => 'switch',
                'title' => esc_html__('Show Header Search', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            // start header one styleing
            
            array(
                'id' => 'optHeaderOneSection',
                'type' => 'section',
                'title' => esc_html__('Header One Settings', 'unload'),
                'subtitle' => esc_html__('In this section set all available header one options.', 'unload'),
                'indent' => true,
                'required' => array('optHeaderStyle', '=', '1')
            ),            
            array(
                'id' => 'optHeaderOnetheme',
                'type' => 'switch',
                'title' => esc_html__('Theme', 'unload'),
                'default' => false,
                'on' => esc_html__('Light', 'unload'),
                'off' => esc_html__('Dark', 'unload')
            ),
            array(
                'id' => 'optHeaderOneSticky',
                'type' => 'switch',
                'title' => esc_html__('Header Sticky', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderOneLogo',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload Logo', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optHeaderOneShowContactNo',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Number', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderOneContactNo',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Number', 'unload'),
                'required' => array('optHeaderOneShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneContactNoBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Office Location', 'unload'),
                'required' => array('optHeaderOneShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneShowContactEmail',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Email', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderOneContactEmail',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Email', 'unload'),
                'required' => array('optHeaderOneShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneContactEmailBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Email Bottom Tag', 'unload'),
                'required' => array('optHeaderOneShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneShippingButton',
                'type' => 'switch',
                'title' => esc_html__('Show Shipping Calculator PopUp', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderOneShippingButtonText',
                'type' => 'text',
                'title' => esc_html__('Enter the button text', 'unload'),
                'required' => array('optHeaderOneShippingButton', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneTopBar',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderOneTopBarTiming',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Timing', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderOneTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneTopBarTimingText',
                'type' => 'text',
                'title' => esc_html__('Enter the timing', 'unload'),
                'required' => array('optHeaderOneTopBarTiming', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneTopBarSignin',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Signin', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderOneTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneTopBarFormLink',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Contact Form Link', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderOneTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneTopBarSocialMedia',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Social Media', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderOneTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneTopBarSocialicons',
                'type' => 'social_media',
                //'heading' => true,
                'title' => esc_html__('Header Two Top Bar Social Media Builder', 'unload'),
                //'full_width' => true,
                'required' => array('optHeaderOneTopBarSocialMedia', '=', '1')
            ),
            array(
                'id' => 'optHeaderOneSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
            // end header one styleing
            // start header two styleing
            array(
                'id' => 'optHeaderTwoSection',
                'type' => 'section',
                'title' => esc_html__('Header Two Settings', 'unload'),
                'subtitle' => esc_html__('In this section set all available header two options.', 'unload'),
                'indent' => true,
                'required' => array('optHeaderStyle', '=', '2')
            ),
            array(
                'id' => 'optHeaderTwoSticky',
                'type' => 'switch',
                'title' => esc_html__('Header Sticky', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderTwoLogo',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload Logo', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optHeaderTwoTopBar',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderTwoTopBarTiming',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Timing', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderTwoTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderTwoTopBarTimingText',
                'type' => 'text',
                'title' => esc_html__('Enter the timing', 'unload'),
                'required' => array('optHeaderTwoTopBarTiming', '=', '1')
            ),
            array(
                'id' => 'optHeaderTwoTopBarSignin',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Signin', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderTwoTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderTwoTopBarFormLink',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Contact Form Link', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderTwoTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderTwoTopBarSocialMedia',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Social Media', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
                'required' => array('optHeaderTwoTopBar', '=', '1')
            ),
            array(
                'id' => 'optHeaderTwoTopBarSocialicons',
                'type' => 'social_media',
                //'heading' => true,
                'title' => esc_html__('Header Two Top Bar Social Media Builder', 'unload'),
                //'full_width' => true,
                'required' => array('optHeaderTwoTopBarSocialMedia', '=', '1')
            ),
            array(
                'id' => 'optHeaderTwoSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
            // end header one styleing
            // start header three styleing
            array(
                'id' => 'optHeaderThreeSection',
                'type' => 'section',
                'title' => esc_html__('Header Three Settings', 'unload'),
                'subtitle' => esc_html__('In this section set all available header three options.', 'unload'),
                'indent' => true,
                'required' => array('optHeaderStyle', '=', '3')
            ),
            array(
                'id' => 'optHeaderThreeSticky',
                'type' => 'switch',
                'title' => esc_html__('Header Sticky', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderThreeLogo',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload Logo', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optHeaderThreeShowContactNo',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Number', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderThreeContactNo',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Number', 'unload'),
                'required' => array('optHeaderThreeShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optHeaderThreeContactNoBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Office Location', 'unload'),
                'required' => array('optHeaderThreeShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optHeaderThreeShowContactEmail',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Email', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderThreeContactEmail',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Email', 'unload'),
                'required' => array('optHeaderThreeShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optHeaderThreeContactEmailBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Email Bottom Tag', 'unload'),
                'required' => array('optHeaderThreeShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optHeaderThreeShippingButton',
                'type' => 'switch',
                'title' => esc_html__('Show Shipping Calculator PopUp', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderThreeShippingButtonText',
                'type' => 'text',
                'title' => esc_html__('Enter the button text', 'unload'),
                'required' => array('optHeaderThreeShippingButton', '=', '1')
            ),
            array(
                'id' => 'optHeaderThreeSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
            // end header three styleing
            // start header four styleing
            array(
                'id' => 'optHeaderFourSection',
                'type' => 'section',
                'title' => esc_html__('Header Four Settings', 'unload'),
                'subtitle' => esc_html__('In this section set all available header Four options.', 'unload'),
                'indent' => true,
                'required' => array('optHeaderStyle', '=', '4')
            ),
            array(
                'id' => 'optHeaderFourtheme',
                'type' => 'switch',
                'title' => esc_html__('Theme', 'unload'),
                'default' => false,
                'on' => esc_html__('Light', 'unload'),
                'off' => esc_html__('Dark', 'unload')
            ),
            array(
                'id' => 'optHeaderFourLogo',
                'type' => 'media',
                'url' => true,
                'title' => __('Upload Logo', 'unload'),
                'compiler' => 'true',
            ),
            array(
                'id' => 'optHeaderFourShowContactNo',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Number', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderFourContactNo',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Number', 'unload'),
                'required' => array('optHeaderFourShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optHeaderFourContactNoBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Office Location', 'unload'),
                'required' => array('optHeaderFourShowContactNo', '=', '1')
            ),
            array(
                'id' => 'optHeaderFourShowContactEmail',
                'type' => 'switch',
                'title' => esc_html__('Show Header Contact Email', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderFourContactEmail',
                'type' => 'text',
                'title' => esc_html__('Enter the Contact Email', 'unload'),
                'required' => array('optHeaderFourShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optHeaderFourContactEmailBottom',
                'type' => 'text',
                'title' => esc_html__('Enter the Email Bottom Tag', 'unload'),
                'required' => array('optHeaderFourShowContactEmail', '=', '1')
            ),
            array(
                'id' => 'optHeaderFourShippingButton',
                'type' => 'switch',
                'title' => esc_html__('Show Shipping Calculator PopUp', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optHeaderFourShippingButtonText',
                'type' => 'text',
                'title' => esc_html__('Enter the button text', 'unload'),
                'required' => array('optHeaderFourShippingButton', '=', '1')
            ),
            array(
                'id' => 'optHeaderFourTopBarSocialMedia',
                'type' => 'switch',
                'title' => esc_html__('Show Header Top Bar Social Media', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload'),
            ),
            array(
                'id' => 'optHeaderFourTopBarSocialicons',
                'type' => 'social_media',
                'title' => esc_html__('Header Two Top Bar Social Media Builder', 'unload'),
                'required' => array('optHeaderFourTopBarSocialMedia', '=', '1')
            ),
            array(
                'id' => 'optHeaderFourSectionEnd',
                'type' => 'section',
                'indent' => false,
            ),
            // end header four styleing
        );
    }

}
