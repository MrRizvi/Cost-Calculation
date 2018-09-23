<?php

abstract class unload_VC_ShortCode
{

    public static function _options($method)
    {
        $called_class = get_called_class();
        return $called_class::$method('unload_Shortcodes_Map');
    }

}
