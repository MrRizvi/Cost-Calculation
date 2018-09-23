<?php

class unload_BlogsingleSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = '';
        $this->id = 'blogsingle';
        $this->title = esc_html__('Single Post', 'unload');
        $this->desc = esc_html__('Unload Theme Blog Single Post Settings', 'unload');
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
                'id' => 'optBlogSingleLayout',
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
                'default' => '3'
            ),
            array(
                'id' => 'optBlogSingleSidebar',
                'type' => 'select',
                'title' => esc_html__('Sidebar', 'unload'),
                'options' => (new unload_Helper)->unload_sidebar(),
                'select2' => array('allowClear' => true),
                'required' => array('optBlogSingleLayout', '!=', 'full')
            ),
            array(
                'id' => 'optBlogSingleImg',
                'type' => 'switch',
                'title' => esc_html__('Featured Image', 'unload'),
                'desc' => esc_html__('Show or hide blog post featured image', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleTitle',
                'type' => 'switch',
                'title' => esc_html__('Title', 'unload'),
                'desc' => esc_html__('Show or hide blog post title', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleCat',
                'type' => 'switch',
                'title' => esc_html__('Categories', 'unload'),
                'desc' => esc_html__('Show or hide blog post categories', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleDate',
                'type' => 'switch',
                'title' => esc_html__('Date', 'unload'),
                'desc' => esc_html__('Show or hide blog post date', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleAuthor',
                'type' => 'switch',
                'title' => esc_html__('Author', 'unload'),
                'desc' => esc_html__('Show or hide blog post author', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleComment',
                'type' => 'switch',
                'title' => esc_html__('Comment Count', 'unload'),
                'desc' => esc_html__('Show or hide blog post comment count', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleShare',
                'type' => 'switch',
                'title' => esc_html__('Post Share', 'unload'),
                'desc' => esc_html__('Show or hide blog post share', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
            array(
                'id' => 'optBlogSingleSocialShare',
                'type' => 'select',
                'multi' => true,
                'title' => esc_html__('Select Social Shares', 'unload'),
                'options' => array(
                    'facebook' => esc_html__('Facebook', 'unload'),
                    'twitter' => esc_html__('Twitter', 'unload'),
                    'google-plus' => esc_html__('Google Plus', 'unload'),
                    'reddit' => esc_html__('Reddit', 'unload'),
                    'linkedin' => esc_html__('Linkedin', 'unload'),
                    'pinterest' => esc_html__('Pinterest', 'unload'),
                    'tumblr' => esc_html__('Tumblr', 'unload'),
                    'envelope-o' => esc_html__('Email', 'unload'),
                ),
                'required' => array('optBlogSingleShare', '=', true),
            ),
            array(
                'id' => 'optBlogSingleTag',
                'type' => 'switch',
                'title' => esc_html__('Post Tag\'s', 'unload'),
                'desc' => esc_html__('Show or hide blog post tag\'s', 'unload'),
                'default' => true,
                'on' => esc_html__('Yes', 'unload'),
                'off' => esc_html__('No', 'unload')
            ),
        );
    }

}
