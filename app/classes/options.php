<?php

class unload_options
{

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;
        return false;
    }

    public function unload_title($title = '')
    {
        return sprintf(esc_html__('%s', 'unload'), $title);
    }

    public function unload_desc($desc = '')
    {
        return sprintf(esc_html__('%s', 'unload'), $desc);
    }

}
