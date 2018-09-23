<?php

return array(
    'button' => array(
        "type" => "textfield",
        "heading" => esc_html__("Button Text:", 'unload'),
        "param_name" => "btn",
        "description" => esc_html__("Enter the button text.", 'unload')
    ),
    'image' => array(
        "type" => "attach_image",
        "heading" => esc_html__("Upload Image:", 'unload'),
        "param_name" => "image",
        "description" => esc_html__("Upload Image for this section.", 'unload')
    ),
    'textarea' => array(
        "type" => "textarea",
        "heading" => esc_html__("Description:", 'unload'),
        "param_name" => "desc",
        "description" => esc_html__("Enter the description for this section.", 'unload')
    ),
    'title' => array(
        "type" => "textfield",
        "heading" => esc_html__("Title:", 'unload'),
        "param_name" => "title",
        "description" => esc_html__("Enter the title for this section.", 'unload')
    ),
    'subtitle' => array(
        "type" => "textfield",
        "heading" => esc_html__("Sub Title:", 'unload'),
        "param_name" => "subtitle",
        "description" => esc_html__("Enter the sub title for this section.", 'unload')
    ),
    'number' => array(
        "type" => "un-number",
        "heading" => esc_html__('Number of Posts', 'unload'),
        "param_name" => "number",
        'min' => '1',
        'max' => '50',
        'step' => '1',
        "description" => esc_html__('Enter the number of posts to show', 'unload')
    ),
    'order' => array(
        "type" => "dropdown",

        "heading" => esc_html__('Order', 'unload'),
        "param_name" => "order",
        "value" => array(
            esc_html__('Ascending', 'unload') => 'ASC',
            esc_html__('Descending', 'unload') => 'DESC'
        ),
        "description" => esc_html__("Select sorting order ascending or descending for posts listing", 'unload')
    ),
    'order_by' => array(
        "type" => "dropdown",

        "heading" => esc_html__("Order By", 'unload'),
        "param_name" => "orderby",
        "value" => array_flip(
            array(
                'date' => esc_html__('Date', 'unload'),
                'title' => esc_html__('Title', 'unload'),
                'name' => esc_html__('Name', 'unload'),
                'author' => esc_html__('Author', 'unload'),
                'comment_count' => esc_html__('Comment Count', 'unload'),
                'random' => esc_html__('Random', 'unload')
            )
        ),
        "description" => esc_html__("Select order by method for posts listing", 'unload')
    ),
    array(
        'type' => 'un-number',
        'class' => '',
        'edit_field_class' => 'vc_col-sm-4 items_to_show ult_margin_bottom',
        'heading' => __('On Desktop', 'unload'),
        'param_name' => 'slides_on_desk',
        'value' => '5',
        'min' => '1',
        'max' => '25',
        'step' => '1',
        'description' => '',
        'group' => 'General',
    ),
);
