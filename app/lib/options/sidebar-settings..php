<?php

class unload_sidebarSettings
{
    public $icon;
    public $id;
    public $title;
    public $desc;

    public function __construct()
    {
        $this->icon = 'el-th-large';
        $this->id = 'widget-sidebar';
        $this->title = esc_html__('Sidebar & Widget\'s', 'unload');
        $this->desc = esc_html__('Unload Theme Widget Sidebar Settings', 'unload');
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
                'id' => 'optDynamicSidebar',
                'type' => 'multi_text',
                'title' => esc_html__('Dynamic Sidebar Name', 'unload'),
                'desc' => esc_html__('Enter the name of dynamic sidebar', 'unload')
            ),
            array(
                'id' => 'test',
                'type' => 'section',
                'title' => esc_html__('Wordpress Default Sidebar Subtitle', 'unload'),
                'subtitle' => esc_html__('Enter wordpress default widget\'s subtitle.', 'unload'),
                'indent' => true,
            ),
            array(
                'id' => 'optSidebarWidgetarchives',
                'type' => 'text',
                'title' => esc_html__('Enter Archive Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetcalendar',
                'type' => 'text',
                'title' => esc_html__('Enter Calendar Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetcategories',
                'type' => 'text',
                'title' => esc_html__('Enter Categories Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetnav_menu',
                'type' => 'text',
                'title' => esc_html__('Enter Nav Menu Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetmeta',
                'type' => 'text',
                'title' => esc_html__('Enter Meta Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetpages',
                'type' => 'text',
                'title' => esc_html__('Enter Pages Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetrecent-comments',
                'type' => 'text',
                'title' => esc_html__('Enter Recent Comments Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetrecent-posts',
                'type' => 'text',
                'title' => esc_html__('Enter Recent Posts Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetrss',
                'type' => 'text',
                'title' => esc_html__('Enter Rss Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgettag_cloud',
                'type' => 'text',
                'title' => esc_html__('Enter Tag Cloud Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgettext',
                'type' => 'text',
                'title' => esc_html__('Enter Text Subtitle', 'unload')
            ),
            array(
                'id' => 'optSidebarWidgetsearch',
                'type' => 'text',
                'title' => esc_html__('Enter Search Widget Subtitle', 'unload')
            ),
            array(
                'id' => 'optDynamicSidebarEnd',
                'type' => 'section',
                'indent' => false,
            ),
        );
    }

}
