<?php

$H = new unload_Helper();
$method = get_class_methods(get_class());
$func = $H->unload_set($method, '0');
$get_array = self::$func('unload_Shortcodes_Map');
$get_params = $H->unload_set($get_array, 'params');
$create_array = array();
$temp = '';
foreach ($get_params as $param) {
    if (array_key_exists('value', $param) || array_key_exists('min', $param)) {
        unset($param['holder']);
        $temp_val = ($H->unload_set($param, 'value')) ? $H->unload_set($param, 'value') : $H->unload_set($param, 'min');
        if (is_array($temp_val)) {
            $temp = array_shift($temp_val);
        } else {
            $temp = $temp_val;
        }
    }
    $create_array[$H->unload_set($param, 'param_name')] = $temp;
}
$values = wp_parse_args($atts, $create_array);
extract($values);
