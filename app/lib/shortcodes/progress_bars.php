<?php

class unload_progress_bars_VC_ShortCode extends unload_VC_ShortCode
{

    public static function unload_progress_bars($atts = null)
    {
        if ($atts == 'unload_Shortcodes_Map') {
            return array(
                "name" => esc_html__("Progress Bars", 'unload'),
                "base" => "unload_progress_bars_output",
                "icon" => 'unload_progress_bars_output.png',
                "category" => esc_html__('Unload', 'unload'),
                "as_parent" => array('only' => 'unload_progress_bars_block_output'),
                "content_element" => true,
                "show_settings_on_create" => true,
                "is_container" => true,
                "params" => array(
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Title:", 'unload'),
                        "param_name" => "title",
                        "description" => esc_html__("Enter the title for this section.", 'unload')
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style:", 'unload'),
                        "param_name" => "style",
                        "value" => array(
                            esc_html__('Progress Bar Creative', 'unload') => 'progressbars-style progressbars-style1',
                            esc_html__('Progress Bar Multi Coloured', 'unload') => 'progressbars-style progressbars-style2',
                            esc_html__('Progress Bar Verticle', 'unload') => 'progressbars-style progressbars-style3',
                            esc_html__('Progress Bar Gray', 'unload') => 'progressbars-style progressbars-style4',
                            esc_html__('Progress Bar Mono Coloured', 'unload') => 'progressbars-style progressbars-style5',
                            esc_html__('Progress Bar Mono Coloured 2', 'unload') => 'progressbars-style progressbars-style4 two',
                        ),
                        "description" => esc_html__("Select the style of the progress_bars.", 'unload')
                    )
                )
            );
            return apply_filters('unload_progress_bars_output', $return);
        }
    }

    public static function unload_progress_bars_output($atts = null, $content = null)
    {
        include(unload_Root . 'app/lib/shortcodes/shortcode_atts.php');
        ob_start();
        global $progress_bar;
        $progress_bar = array();
        do_shortcode($content);
        $count = count($progress_bar);
        $inner = '';
        $inner2 = '';
        $colored = array('marganta-bg', 'lightpurple-bg', 'lightgreen-bg');
        if ($style == 'progressbars-style progressbars-style1') {
            $inner = 'progress-bar progress-bar-striped';
            $inner2 = 'progress';
        } else if ($style == 'progressbars-style progressbars-style2') {
            $inner = 'progress-bar';
            $inner2 = 'progress';
        } else if ($style == 'progressbars-style progressbars-style3') {
            $inner = 'progress-bar blue-bg';
            $inner2 = 'progress progress-bar-vertical';
        } else if ($style == 'progressbars-style progressbars-style4' || $style == 'progressbars-style progressbars-style4 two') {
            $inner = 'progress-bar';
            $inner2 = 'progress';
        } else if ($style == 'progressbars-style progressbars-style5') {
            $inner = 'progress-bar';
            $inner2 = 'progress';
        }
        ?>
        <div class="progressbars-page">
            <div class="<?php echo esc_attr($style) ?>">
                <?php if (!empty($title)): ?>
                    <h2><?php echo esc_attr($title) ?></h2>
                <?php endif; ?>
                <ul>
                    <?php
                    if ($count > 0) {
                        foreach ($progress_bar as $bar) {
                            if ($style == 'progressbars-style progressbars-style3') {
                                ?>
                                <li>
                                    <div class="<?php echo esc_attr($inner2) ?>">
                                        <div class="<?php echo esc_attr($inner) ?>"
                                             aria-valuenow="<?php echo esc_attr($H->unload_set($bar, 'number')) ?>"
                                             aria-orientation="" role="" aria-valuemin="0" aria-valuemax="100"
                                             style="height: <?php echo esc_attr($H->unload_set($bar, 'number')) ?>%;">
                                            <span><?php echo esc_html($H->unload_set($bar, 'number')) ?>%</span>
                                        </div>
                                    </div>
                                    <span><?php echo esc_html($H->unload_set($bar, 'title')) ?></span>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li>
                                    <span><?php echo esc_html($H->unload_set($bar, 'title')) ?></span>
                                    <i><?php echo esc_html($H->unload_set($bar, 'number')) ?>%</i>
                                    <div class="<?php echo esc_attr($inner2) ?>">
                                        <?php if ($style == 'progressbars-style progressbars-style2'): ?>
                                            <div
                                                class="<?php echo esc_attr($inner . ' ' . $H->unload_set($colored, shuffle($colored))) ?>"
                                                aria-orientation="" role=""
                                                aria-valuenow="<?php echo esc_attr($H->unload_set($bar, 'number')) ?>"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width: <?php echo esc_attr($H->unload_set($bar, 'number')) ?>%;">
                                            </div>
                                        <?php else: ?>
                                            <div class="<?php echo esc_attr($inner) ?>"
                                                 aria-valuenow="<?php echo esc_attr($H->unload_set($bar, 'number')) ?>"
                                                 aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo esc_attr($H->unload_set($bar, 'number')) ?>%;">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_clean();
        return do_shortcode($output);
    }

}
