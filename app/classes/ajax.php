<?php

class unload_ajax
{

    public function __construct()
    {
        $requests = array(
            'unloadContactForm' => 'unload_ContactForm',
            'unloadAjaxLogin' => 'unload_ajaxLogin',
            'registerUser' => 'unload_registerUser',
            'requestAQuote' => 'unload_requestAQuote',
            'regionBlock' => 'unload_regionBlock',
            'sendOfficeMail' => 'unload_sendOfficeMail',
            'widgetNewsletter' => 'unload_widgetNewsletter',
            'processBooking' => 'unload_processBooking',
            'trackOrder' => 'unload_trackOrder',
            'processShippingRequest' => 'unload_processShippingRequest',
            'getShippingRequest' => 'unload_getShippingRequest'
        );
        foreach ($requests as $key => $request) {
            add_action("wp_ajax_nopriv_$key", array($this, $request));
            add_action("wp_ajax_$key", array($this, $request));
        }
    }

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;
        return false;
    }

    public function unload_ContactForm()
    {
        check_ajax_referer( Unload_KEY, 'contactform_key' ); 
        if (isset($_POST['action']) && $_POST['action'] == 'unloadContactForm') {
            unload_response::unload_singleton()->unload_ContactForm($_POST);
            exit;
        }
    }

    public function unload_ajaxLogin()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'unloadAjaxLogin') {
            unload_response::unload_singleton()->unload_ajaxLogin($_POST);
            exit;
        }
    }

    public function unload_registerUser()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'registerUser') {
            unload_response::unload_singleton()->unload_registerUser($_POST);
            exit;
        }
    }

    public function unload_requestAQuote()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'requestAQuote') {
            unload_response::unload_singleton()->unload_requestAQuote($_POST);
            exit;
        }
    }

    public function unload_regionBlock()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'regionBlock') {
            unload_response::unload_singleton()->unload_regionBlock($_POST);
            exit;
        }
    }

    public function unload_sendOfficeMail()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'sendOfficeMail') {
            unload_response::unload_singleton()->unload_sendOfficeMail($_POST);
            exit;
        }
    }

    public function unload_widgetNewsletter()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'widgetNewsletter') {
            unload_response::unload_singleton()->unload_widgetNewsletter($_POST);
            exit;
        }
    }

    public function unload_processBooking()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'processBooking') {
            unset($_POST['action']);
            unload_response::unload_singleton()->unload_processBooking($_POST);
            exit;
        }
    }

    public function unload_trackOrder()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'trackOrder') {
            unload_response::unload_singleton()->unload_trackOrder($_POST);
            exit;
        }
    }

    public function unload_processShippingRequest()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'processShippingRequest') {
            unload_response::unload_singleton()->unload_processShippingRequest($_POST);
            exit;
        }
    }

    public function unload_getShippingRequest()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'getShippingRequest') {
            unload_response::unload_singleton()->unload_getShippingRequest($_POST);
            exit;
        }
    }

    public function __clone()
    {
        trigger_error(esc_html__('Cloning the registry is not permitted', 'unload'), E_USER_ERROR);
    }

}
