<?php

class unload_BlogSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'blog';
        $this->title = esc_html__('Blog Post', 'unload');
        $this->desc = esc_html__('Unload Theme Blog Post Settings', 'unload');
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
                'id' => 'optBlogTheme',
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
                'id' => 'optBlogHeader',
                'type' => 'switch',
                'title' => esc_html__('Header Section', 'unload'),
                'desc' => esc_html__('Show or hide blog page header section', 'unload'),
                'default' => false,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogHeaderTitle',
                'type' => 'text',
                'title' => __('Header Title', 'unload'),
                'required' => array('optBlogHeader', '=', true)
            ),
            array(
                'id' => 'optBlogHeaderSubTitle',
                'type' => 'text',
                'title' => __('Header Sub Title', 'unload'),
                'required' => array('optBlogHeader', '=', true)
            ),
            array(
                'id' => 'optBlogHeaderBg',
                'type' => 'media',
                'url' => true,
                'title' => __('Header Background', 'unload'),
                'compiler' => 'true',
                'required' => array('optBlogHeader', '=', true)
            ),
            array(
                'id' => 'optBlogLayout',
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
            ),
            array(
                'id' => 'optBlogSidebar',
                'type' => 'select',
                'title' => esc_html__('Sidebar', 'unload'),
                'options' => (new unload_Helper)->unload_sidebar(),
                'select2' => array('allowClear' => true),
                'required' => array('optBlogLayout', '!=', 'full')
            ),
            array(
                'id' => 'optBlogImg',
                'type' => 'switch',
                'title' => esc_html__('Image', 'unload'),
                'desc' => esc_html__('Show or hide post image', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogDate',
                'type' => 'switch',
                'title' => esc_html__('Date', 'unload'),
                'desc' => esc_html__('Show or hide post date', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogTitle',
                'type' => 'switch',
                'title' => esc_html__('Title', 'unload'),
                'desc' => esc_html__('Show or hide post title', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogContent',
                'type' => 'switch',
                'title' => esc_html__('Content', 'unload'),
                'desc' => esc_html__('Show or hide post content', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogComment',
                'type' => 'switch',
                'title' => esc_html__('Comment', 'unload'),
                'desc' => esc_html__('Show or hide post comment', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogAuthor',
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
