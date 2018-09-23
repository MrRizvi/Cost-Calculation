<?php

function crazyblo_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
{
    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', 'my_row-fluid', $class_string); // This will replace "vc_row-fluid" with "my_row-fluid"
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string); // This will replace "vc_col-sm-%" with "my_col-sm-%"
    }

    return $class_string;
}

add_filter('vc_shortcodes_css_class', 'crazyblo_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

function vc_theme_vc_row($atts, $content = NULL)
{
    $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';
    extract(shortcode_atts(array(
        'base' => '',
        'css' => '',
        'el_class' => '',
        'bg_image' => '',
        'bg_color' => '',
        'bg_image_repeat' => '',
        'border_color' => '',
        'font_color' => '',
        'padding' => '',
        'margin_bottom' => '',
        // start my param
        'show_title' => '',
        'col_title' => '',
        'col_sub_title' => '',
        'title_style' => '',
        'col_desc' => '',
        'show_parallax' => '',
        'parallax_layer' => '',
        'parallax_type' => '',
        'parallax_bg' => '',
        'miscellaneous' => '',
        'top_space' => '',
        'bottom_space' => '',
        'rem_topbottom' => '',
        'gray_section' => '',
        'container' => '',
        'overlap' => '',
    ), $atts));

    $atts['base'] = '';
    wp_enqueue_style('js_composer_front');
    wp_enqueue_script('wpb_composer_front_js');
    wp_enqueue_style('js_composer_custom_css');
    $vc_row = new WPBakeryShortCode_VC_Row($atts);
    $el_class = $vc_row->getExtraClass($el_class);
    $output = '';
    $css_class = $el_class;
    $css_class = ($css) ? apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), $atts['base'], $atts) . ' ' . $css_class : $css_class;
    $style = customBuildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

    $my_class = '';
    if ($miscellaneous == 'on' && $top_space == 'on') {
        $my_class .= 'remove-top' . ' ';
    }

    if ($miscellaneous == 'on' && $bottom_space == 'on') {
        $my_class .= 'remove-bottom' . ' ';
    }

    if ($miscellaneous == 'on' && $rem_topbottom == 'on') {
        $my_class .= 'no-padding' . ' ';
    }

    if ($miscellaneous == 'on' && $overlap == 'on') {
        $my_class .= 'overlape' . ' ';
    }

    if ($miscellaneous == 'on' && $gray_section == 'on') {
        $my_class .= 'gray' . ' ';
    }

    if ($show_parallax == 'on' && !empty($parallax_layer)) {
        $my_class .= $parallax_layer;
    }

    $my_parallax = '';
    if ($show_parallax == 'on' && !empty($parallax_bg)) {
        if ($parallax_bg):
            $img = wp_get_attachment_url($parallax_bg, 'full');
        else:
            $img = '';
        endif;

        $type = '';
        if ($parallax_type != '') {
            $type = $parallax_type . ' ';
        }

        $my_parallax .= ($img) ? '<div class="' . $type . '" style="background:url(' . $img . ') no-repeat scroll 0 0 rgba(0, 0, 0, 0)"></div>' : '';
    }

    $titlesStyle = '';
    if ($show_title == 'on'):
        $titlesStyle .= (new unload_Helper)->unload_vcTitle($title_style, $col_title, $col_sub_title, $col_desc);
    endif;

    $output = '<section class="block ' . $my_class . ' ' . $css_class . '"' . $style . '>';
    $output .= $my_parallax;
    $output .= ($container == 'on') ? '<div class="container">' : '';
    $output .= $titlesStyle;
    $output .= '<div class="row">';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>';
    $output .= ($container == 'on') ? '</div>' : '';
    $output .= '</section>';

    return $output;
}

function vc_theme_vc_row_inner($atts, $content = NULL)
{
    extract(shortcode_atts(array(
        'el_class' => '',
        'container' => '',
        'row' => '',
    ), $atts));
    $atts['base'] = '';
    wp_enqueue_style('js_composer_front');
    wp_enqueue_script('wpb_composer_front_js');
    wp_enqueue_style('js_composer_custom_css');

    $output = '';
    $css_class = $el_class;
    $custom_style = '';

    if ($container) {
        return

            '<section class="block ' . $css_class . '" ' . $custom_style . ' >
				<div class="container">
					' . wpb_js_remove_wpautop($content) . '
				</div>
			</section>' . "\n";
    }

    return '<section class=" block' . $css_class . ' ' . $custom_style . '" >
				' . wpb_js_remove_wpautop($content) . '
			</section>' . "\n";
}

function vc_theme_vc_column_inner($atts, $content = NULL)
{
    extract(shortcode_atts(array('width' => '1/1', 'el_class' => ''), $atts));

    $width = wpb_translateColumnWidthToSpan($width);
    $width = str_replace('vc_span', 'col-md-', $width);
    $el_class = ($el_class) ? ' ' . $el_class : '';

    return '<div class="wpb_column ' . $width . $el_class . '">
				' . do_shortcode($content) . '
			</div>' . "\n";
}

function vc_theme_vc_column($atts, $content = NULL)
{
    extract(shortcode_atts(array(
        'width' => '1/1',
        'el_class' => '',
        'show_title' => '',
        'col_title' => '',
        'col_sub_title' => '',
        'title_style' => '',
        'col_desc' => '',
    ), $atts));

    $titlesStyle = '';
    if ($show_title == 'on'):
        $titlesStyle .= (new unload_Helper)->unload_vcTitle($title_style, $col_title, $col_sub_title, $col_desc);
    endif;

    $width = wpb_translateColumnWidthToSpan($width);
    $width = str_replace('vc_col-sm-', 'col-md-', $width . ' column');

    $el_class = ($el_class) ? ' ' . $el_class : '';
    $output = '<div class="' . $width . ' ' . $el_class . '">';
    $output .= $titlesStyle;
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}

// start vc row and column customized
$miscellaneous = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Miscellaneous', 'unload'),
    "heading" => esc_html__("Miscellaneous Settings", 'unload'),
    "param_name" => "miscellaneous",
    'value' => 'off',
    'default_set' => FALSE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Show miscellaneous settings for this section.", 'unload'),
    'group' => esc_html__('Miscellaneous', 'unload'),
);

$top_space = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Miscellaneous', 'unload'),
    "heading" => esc_html__("Top Space", 'unload'),
    "param_name" => "top_space",
    'value' => 'off',
    'default_set' => TRUE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Remove space in the top of section", 'unload'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('on')
    ),
);

$bottom_space = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Miscellaneous', 'unload'),
    "heading" => esc_html__("Bottom Space", 'unload'),
    "param_name" => "bottom_space",
    'value' => 'off',
    'default_set' => TRUE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Remove space in the bottom of section", 'unload'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('on')
    ),
);

$rem_topbottom = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Miscellaneous', 'unload'),
    "heading" => esc_html__("Top Bottom Space", 'unload'),
    "param_name" => "rem_topbottom",
    'value' => 'off',
    'default_set' => TRUE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Remove space in the bottom of section", 'unload'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('on')
    ),
);

$overlap = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Miscellaneous', 'unload'),
    "heading" => esc_html__("Overlap", 'unload'),
    "param_name" => "overlap",
    'value' => 'off',
    'default_set' => TRUE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Overlap this section", 'unload'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('on')
    ),
);

$gray_section = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Miscellaneous', 'unload'),
    "heading" => esc_html__("Gray Section", 'unload'),
    "param_name" => "gray_section",
    'value' => 'off',
    'default_set' => FALSE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Make this section background gray", 'unload'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('on')
    ),
);
// end vc row and column customized

$container = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Other', 'unload'),
    "heading" => esc_html__("Container", 'unload'),
    "param_name" => "container",
    'value' => 'off',
    'default_set' => FALSE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Enable container for this section", 'unload'),
);

// start parallax section			
$show_parallax = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Parallax', 'unload'),
    "heading" => esc_html__("Show Parallax", 'unload'),
    "param_name" => "show_parallax",
    'value' => 'off',
    'default_set' => FALSE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Make this section parallax then true.", 'unload')
);

$parallax_layer = array(
    "type" => "dropdown",
    "class" => "",
    'group' => esc_html__('Parallax', 'unload'),
    "heading" => esc_html__("Parallax Layer", 'unload'),
    "param_name" => "parallax_layer",
    "value" => array(
        esc_html__('No Layer', 'unload') => 'no-layer',
        esc_html__('Whitish', 'unload') => 'whitish',
        esc_html__('Light Black', 'unload') => 'layer',
        esc_html__('Blackish', 'unload') => 'blackish',
        esc_html__('Blue', 'unload') => 'blue',
        esc_html__('Dark', 'unload') => 'dark',
        esc_html__('Grayish', 'unload') => 'grayish',
        esc_html__('Dark Blue', 'unload') => 'darkblue',
    ),
    "description" => esc_html__("Choose Style for Parallax.", 'unload'),
    'dependency' => array(
        'element' => 'show_parallax',
        'value' => array('on')
    ),
);
$parallax_type = array(
    "type" => "dropdown",
    "class" => "",
    'group' => esc_html__('Parallax', 'unload'),
    "heading" => esc_html__("Parallax Type", 'unload'),
    "param_name" => "parallax_type",
    "value" => array(
        '' => '',
        esc_html__('Moving', 'unload') => 'parallax',
        esc_html__('Fixed BG', 'unload') => 'fixed-bg',
        esc_html__('Fixed Image', 'unload') => 'fixed-img2',
    ),
    "description" => esc_html__("Choose Parallax Type.", 'unload'),
    'dependency' => array(
        'element' => 'show_parallax',
        'value' => array('on')
    ),
);

$parallax_img = array(
    "type" => "attach_image",
    "class" => "",
    'group' => esc_html__('Parallax', 'unload'),
    "heading" => esc_html__("Parallax Background", 'unload'),
    "param_name" => "parallax_bg",
    "description" => esc_html__("Make this section as parallax.", 'unload'),
    'dependency' => array(
        'element' => 'show_parallax',
        'value' => array('on')
    ),
);

//start title settings
$show_heading = array(
    "type" => "un_toggle",
    "class" => "",
    'group' => esc_html__('Title Setting', 'unload'),
    "heading" => esc_html__("Show Title", 'unload'),
    "param_name" => "show_title",
    'value' => 'off',
    'default_set' => FALSE,
    'options' => array(
        'on' => array(
            'on' => __('Yes', 'unload'),
            'off' => __('No', 'unload'),
        ),
    ),
    "description" => esc_html__("Make this section with title.", 'unload')
);
$title_style = array(
    "type" => "dropdown",
    "class" => "",
    'group' => esc_html__('Title Setting', 'unload'),
    "heading" => esc_html__("Title Style", 'unload'),
    "param_name" => "title_style",
    "value" => array(
        esc_html__('No Style', 'unload') => '',
        esc_html__('Dark Title With Icon', 'unload') => '1',
        esc_html__('Dark Title', 'unload') => '2',
        esc_html__('Center Title', 'unload') => '3',
        esc_html__('Left Title With Description', 'unload') => '4',
        esc_html__('Left Title Without Description', 'unload') => '5',
        esc_html__('Left Small Title', 'unload') => '6',
        esc_html__('Left Large Title', 'unload') => '7',
        esc_html__('Fancy Title Style One', 'unload') => '8',
        esc_html__('Fancy Title Style Two', 'unload') => '9'
    ),
    "description" => esc_html__("Select the title style for this section", 'unload'),
    'dependency' => array(
        'element' => 'show_title',
        'value' => array('on')
    ),
);
$title = array(
    "type" => "textfield",
    "class" => "",
    'group' => esc_html__('Title Setting', 'unload'),
    "heading" => esc_html__("Enter the Title", 'unload'),
    "param_name" => "col_title",
    "description" => esc_html__("Enter the title of this section.", 'unload'),
    'dependency' => array(
        'element' => 'show_title',
        'value' => array('on')
    ),
);
$sub_title = array(
    "type" => "textfield",
    "class" => "",
    'group' => esc_html__('Title Setting', 'unload'),
    "heading" => esc_html__("Enter the Sub Title", 'unload'),
    "param_name" => "col_sub_title",
    "description" => esc_html__("Enter the sub title of this section.", 'unload'),
    'dependency' => array(
        'element' => 'show_title',
        'value' => array('on')
    ),
);

$col_desc = array(
    "type" => "textarea",
    "class" => "",
    'group' => esc_html__('Title Setting', 'unload'),
    "heading" => esc_html__("Enter the short description", 'unload'),
    "param_name" => "col_desc",
    "description" => esc_html__("Enter the sub enter the title description for this section.", 'unload'),
    'dependency' => array(
        'element' => 'title_style',
        'value' => array('4')
    ),
);


if (function_exists('vc_map')) {

    //vc column settings
    vc_add_param('vc_column', $show_heading);
    vc_add_param('vc_column', $title);
    vc_add_param('vc_column', $sub_title);
    vc_add_param('vc_column', $title_style);

    //vc row settings
    vc_add_param('vc_row', $show_heading);
    vc_add_param('vc_row', $title_style);
    vc_add_param('vc_row', $title);
    vc_add_param('vc_row', $sub_title);
    vc_add_param('vc_row', $col_desc);

    vc_add_param('vc_row', $miscellaneous);
    vc_add_param('vc_row', $top_space);
    vc_add_param('vc_row', $bottom_space);
    vc_add_param('vc_row', $rem_topbottom);
    vc_add_param('vc_row', $gray_section);
    vc_add_param('vc_row', $overlap);
    vc_add_param('vc_row', $container);

    vc_add_param('vc_row', $show_parallax);
    vc_add_param('vc_row', $parallax_layer);
    vc_add_param('vc_row', $parallax_type);
    vc_add_param('vc_row', $parallax_img);

    $remove_param = array('parallax', 'video_bg', 'parallax_image', 'parallax_speed_video', 'video_bg_url', 'video_bg_parallax', 'parallax_speed_bg');
    foreach ($remove_param as $rparam) {
        vc_remove_param("vc_row", $rparam);
    }

    function customBuildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '')
    {
        $has_image = FALSE;
        $style = '';
        if ((int)$bg_image > 0 && ($image_url = wp_get_attachment_url($bg_image, 'large')) !== FALSE) {
            $has_image = TRUE;
            $style .= "background-image: url(" . $image_url . ");";
        }
        if (!empty($bg_color)) {
            $style .= 'background-color: ' . $bg_color . ';';
        }
        if (!empty($bg_image_repeat) && $has_image) {
            if ($bg_image_repeat === 'cover') {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif ($bg_image_repeat === 'contain') {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif ($bg_image_repeat === 'no-repeat') {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if (!empty($font_color)) {
            $style .= 'color: ' . $font_color . ';';
        }
        if ($padding != '') {
            $style .= 'padding: ' . (preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding . 'px') . ';';
        }
        if ($margin_bottom != '') {
            $style .= 'margin-bottom: ' . (preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom . 'px') . ';';
        }

        return empty($style) ? $style : ' style="' . $style . '"';
    }

}
	