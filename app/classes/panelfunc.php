<?php

class unload_Panelfunc
{

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;
        return false;
    }

    public function unload_HeadersImages()
    {
        $headerImagesPath = unload_Root . 'partial/images/headers/';
        $headerImagesUrl = unload_Uri . 'partial/images/headers/';
        $headers = array();
        if (is_dir($headerImagesPath)) {
            if ($headerImageDir = opendir($headerImagesPath)) {
                while (($headerFile = readdir($headerImageDir)) !== false) {
                    if (stristr($headerFile, '.png') !== false || stristr($headerFile, '.jpg') !== false) {
                        $name = explode('.', $headerFile);
                        $name = str_replace('.' . end($name), '', $headerFile);
                        $headers[] = array(
                            'alt' => $name,
                            'img' => $headerImagesUrl . $headerFile
                        );
                    }
                }
            }
        }
        return $headers;
    }

    public function __clone()
    {
        trigger_error(esc_html__('Cloning the registry is not permitted', 'unload'), E_USER_ERROR);
    }

}
