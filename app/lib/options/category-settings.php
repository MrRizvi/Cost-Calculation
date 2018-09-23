<?php

class unload_CategorySettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'category';
        $this->title = esc_html__('Category', 'unload');
        $this->desc = esc_html__('Unload Theme Category Settings', 'unload');
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
                'id' => 'optCategoryTheme',
                'type' => 'select',
                'title' => esc_html__('Select Blog Layout', 'unload'),
                'options' => array(
                    '1col' => esc_html__('1 Column', 'unload'),
                    'col-md-6' => esc_html__('2 Column', 'unload'),
                    'col-md-4' => esc_html__('3 Column', 'unload'),
                    'col-md-3' => esc_html__('4 Column', 'unload'),
                ),
                'required' => array('optBlogSingleShare', '=', true),
            ),
            array(
                'id' => 'optCategoryHeader',
                'type' => 'switch',
                'title' => esc_html__('Header Section', 'unload'),
                'desc' => esc_html__('Show or hide category page header section', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optCategoryHeaderTitle',
                'type' => 'text',
                'title' => __('Header Title', 'unload'),
                'required' => array('optCategoryHeader', '=', true)
            ),
            array(
                'id' => 'optCategoryHeaderSubTitle',
                'type' => 'text',
                'title' => __('Header Sub Title', 'unload'),
                'required' => array('optCategoryHeader', '=', true)
            ),
            array(
                'id' => 'optCategoryHeaderBg',
                'type' => 'media',
                'url' => true,
                'title' => __('Header Background', 'unload'),
                'compiler' => 'true',
                'required' => array('optCategoryHeader', '=', true)
            ),
            array(
                'id' => 'optCategoryLayout',
                'type' => 'image_select',
                'title' => __('Sidebar Layout', 'unload'),
                'subtitle' => __('Select the sidebar layout of all blog posts.', 'unload'),
                'full_width' => false,
                'options' => array(
                    'left' => array(
                        'alt' => esc_html__('Left', 'unload'),
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right', 'unload'),
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    'full' => array(
                        'alt' => esc_html__('Full', 'unload'),
                        'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                    ),
                ),
                'default' => 'full'
            ),
            array(
                'id' => 'optCategorySidebar',
                'type' => 'select',
                'title' => esc_html__('Sidebar', 'unload'),
                'options' => (new unload_Helper)->unload_sidebar(),
                'select2' => array('allowClear' => true),
                'required' => array('optCategoryLayout', '!=', 'full')
            ),
            array(
                'id' => 'optCategoryImg',
                'type' => 'switch',
                'title' => esc_html__('Image', 'unload'),
                'desc' => esc_html__('Show or hide post image', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optCategoryDate',
                'type' => 'switch',
                'title' => esc_html__('Date', 'unload'),
                'desc' => esc_html__('Show or hide post date', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optCategoryTitle',
                'type' => 'switch',
                'title' => esc_html__('Title', 'unload'),
                'desc' => esc_html__('Show or hide post title', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optCategoryContent',
                'type' => 'switch',
                'title' => esc_html__('Content', 'unload'),
                'desc' => esc_html__('Show or hide post content', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optCategoryComment',
                'type' => 'switch',
                'title' => esc_html__('Comment', 'unload'),
                'desc' => esc_html__('Show or hide post comment', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optCategoryAuthor',
                'type' => 'switch',
                'title' => esc_html__('Author', 'unload'),
                'desc' => esc_html__('Show or hide post author', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
        );
    }

}
