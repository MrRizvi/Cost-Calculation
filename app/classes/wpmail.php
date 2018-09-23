<?php

class unload_Wpmail
{

    public $_name, $_email;

    public function __construct($name, $mail)
    {
        $this->_name = $name;
        $this->_email = !empty($mail) ? $mail : get_option('admin_email');
        add_filter('wp_mail_from', function () {
            return $this->_email;
        });
        add_filter('wp_mail_from_name', function () {
            return $this->_name;
        });
    }
}
