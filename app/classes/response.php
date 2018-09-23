<?php

class unload_response
{

    private static $instance;

    public static function unload_ajaxLogin($data)
    {
        $h = new unload_Helper();
        $error = '';
        $muser = $h->unload_set($data, 'user');
        $pass = $h->unload_set($data, 'pass');
        $nonce = $h->unload_set($data, 'nonce');
        $rem = $h->unload_set($data, 'rem');

        if (!wp_verify_nonce($nonce, 'ajax_login_nonce')) {
            return;
        }
        if (empty($muser)) {
            $error .= '<div class="alert alert-warning">' . esc_html__('Please Enter User Name', 'unload') . '</div>';
        }
        if (empty($pass)) {
            $error .= '<div class="alert alert-warning">' . esc_html__('Please Enter Password', 'unload') . '</div>';
        }

        $userInfo = get_user_by('login', $muser);
        if (is_wp_error($userInfo)) {
            $error .= '<div class="alert alert-warning">' . esc_html__('Invalid username', 'unload') . '</div>';
        }

        if (empty($error)) {
            $userInfo = get_user_by('login', $muser);
            if (is_wp_error($userInfo)) {
                echo json_encode(array('status' => FALSE, 'msg' => esc_html__('Wrong username or password.', 'unload')));
            } else {
                $info = array();
                $info['user_login'] = $muser;
                $info['user_password'] = $pass;
                if ($rem == 'true') {
                    $info['remember'] = TRUE;
                }
                $user_signon = wp_signon($info, FALSE);
                $get_role = $h->unload_set($h->unload_set($user_signon, 'roles'), '0');
                if ($get_role == 'un_customer') {
                    $url = $h->unloadTpl('tpl-order-list.php');
                    echo json_encode(array('status' => TRUE, 'msg' => '<div class = "alert alert-success">' . esc_html__('Login Successfull!Redirecting...', 'unload') . '</div>', 'url' => $url));
                } else {
                    echo json_encode(array('status' => TRUE, 'msg' => '<div class = "alert alert-success">' . esc_html__('Login Successfull!Redirecting...', 'unload') . '</div>', 'url' => home_url('/')));
                }
            }
        } else {
            echo json_encode(array('status' => FALSE, 'msg' => $error));
        }
    }

    public static function unload_singleton()
    {
        if (!isset(self::$instance)) {
            $obj = __CLASS__;
            self::$instance = new $obj;
        }

        return self::$instance;
    }

    public function __call($method, $args)
    {
        echo esc_html__("unknown method ", "unload") . $method;

        return FALSE;
    }

    public function unload_ContactForm($data)
    {
        $h = new unload_Helper();
        $error = '';
        $name = ($h->unload_set($data, 'name') != 'undefined') ? esc_attr($h->unload_set($data, 'name')) : '';
        $email = ($h->unload_set($data, 'email') != 'undefined') ? esc_attr($h->unload_set($data, 'email')) : '';
        $message = ($h->unload_set($data, 'message') != 'undefined') ? esc_attr($h->unload_set($data, 'message')) : '';
        $receiver = ($h->unload_set($data, 'receiver') != 'undefined') ? esc_attr($h->unload_set($data, 'receiver')) : '';

        if (empty($name)) {
            $error .= '<div class="alert alert-warning">' . esc_html__('Please Enter your Name', 'unload') . '</div>';
        }
        if (empty($email)) {
            $error .= '<div class="alert alert-warning">' . __('Please Enter your Email ID', 'unload') . '</div>';
        }
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= '<div class="alert alert-warning">' . sprintf(__('This %s email address is considered valid.', 'unload'), $email) . '</div>';
        }
        if (empty($message)) {
            $error .= '<div class="alert alert-warning">' . __('Please Enter your Message', 'unload') . '</div>';
        }
        if (!empty($message) && strlen($message) < 10) {
            $error .= '<div class="alert alert-warning">' . __('Please Enter minimum 10 characters in message field.', 'unload') . '</div>';
        }
        if (empty($error)) {
            $opt = (new unload_Helper())->unload_opt();
            $rec_email = ($receiver) ? $receiver : get_option('admin_email');
            $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
            wp_mail($rec_email, __('Contact Us Message', 'unload'), $message, $headers);
            $message = ($h->unload_set($opt, 'optContactMessage')) ? $h->unload_set($opt, 'optContactMessage') : sprintf(__('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.', 'unload'), $name);
            $error .= '<div class="alert alert-success">' . $message . '</div>';
            echo json_encode(array('status' => TRUE, 'msg' => $error));
        } else {
            echo json_encode(array('status' => FALSE, 'msg' => $error));
        }
    }

    public function unload_registerUser($data)
    {
        $h = new unload_Helper();
        $opt = (new unload_Helper())->unload_opt();
        $error = '';
        $fname = $h->unload_set($data, 'first_name');
        $lname = $h->unload_set($data, 'last_name');
        $user = $h->unload_set($data, 'username');
        $email = $h->unload_set($data, 'email');
        $pass = $h->unload_set($data, 'password');
        $repass = $h->unload_set($data, 'repass');
        $term = $h->unload_set($data, 'term');
        $nonce = $h->unload_set($data, 'security');

        if (!wp_verify_nonce($nonce, 'ajax_reg_nonce')) {
            return;
        }


        if (empty($fname)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter First Name', 'unload') . '</div>';
        }
        if (empty($lname)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter Last Name', 'unload') . '</div>';
        }
        if (empty($user)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter User Name', 'unload') . '</div>';
        }
        if (username_exists($user)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Username already taken', 'unload') . '</div>';
        }
        if (empty($email)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter Email Addresss', 'unload') . '</div>';
        }
        if (!is_email($email)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Invalid Email Addresss', 'unload') . '</div>';
        }
        if (email_exists($email)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Email already registered', 'unload') . '</div>';
        }
        if (empty($pass)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please enter a Password', 'unload') . '</div>';
        }
        if (empty($repass)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please enter a Re-password', 'unload') . '</div>';
        }
        if ($pass != $repass) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Passwords do not match', 'unload') . '</div>';
        }
        if ($h->unload_set($opt, 'optRegTerms') == '1') {
            if ($term == 'false') {
                $error .= '<div class = "alert alert-warning">' . esc_html__('Please accept terms & condition', 'unload') . '</div>';
            }
        }
        if (empty($error)) {
            $new_user_id = wp_insert_user(array(
                'user_login' => $user,
                'user_pass' => $pass,
                'user_email' => $email,
                'first_name' => $fname,
                'last_name' => $lname,
                'user_registered' => date('Y-m-d H:i:s'),
                'role' => 'subscriber'
            ));
            wp_setcookie($user, $pass, TRUE);
            wp_set_current_user($new_user_id, $user);
            do_action('wp_login', $user);
            echo json_encode(array('loggedin' => TRUE, 'message' => esc_html__('Login successful, redirecting...', 'unload'), 'url' => home_url('/')));
        } else {
            echo json_encode(array('loggedin' => FALSE, 'message' => $error));
        }
    }

    public function unload_requestAQuote($data)
    {
        $h = new unload_Helper();
        $error = '';
        $name = $h->unload_set($data, 'name');
        $mail = $h->unload_set($data, 'email');
        $fdate = $h->unload_set($data, 'fdate');
        $tdate = $h->unload_set($data, 'tdate');
        $msg = $h->unload_set($data, 'message');
        $nonce = $h->unload_set($data, 'security');
        $rmail = $h->unload_set($data, 'remail');

        if (!wp_verify_nonce($nonce, 'ajax_quote_nonce')) {
            return;
        }

        if (empty($name)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please enter your name', 'unload') . '</div>';
        }
        if (empty($mail)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please enter your email', 'unload') . '</div>';
        }
        if (empty($fdate)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please select from date', 'unload') . '</div>';
        }
        if (empty($tdate)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please select to date', 'unload') . '</div>';
        }
        if (empty($msg)) {
            $error .= '<div class = "alert alert-warning">' . esc_html__('Please enter your message', 'unload') . '</div>';
        }
        if (empty($error)) {
            $msg .= "\r\n\r\n";
            $msg .= esc_html__('Name', 'unload') . ' : ' . $name . "\r\n\r\n";
            $msg .= esc_html__('Email', 'unload') . ' : ' . $mail . "\r\n\r\n";
            $msg .= esc_html__('From Date', 'unload') . ' : ' . $fdate . "\r\n\r\n";
            $msg .= esc_html__('To Date', 'unload') . ' : ' . $tdate . "\r\n\r\n";
            @wp_mail($rmail, esc_html__('Request A Quote', 'unload'), $msg);
            echo json_encode(array('loggedin' => TRUE));
        } else {
            echo json_encode(array('loggedin' => FALSE, 'msg' => $error));
        }
    }

    public function unload_regionBlock($data)
    {
        $opt = (new unload_Helper())->unload_opt();
        $H = new unload_Helper();
        $postId = $H->unload_set($data, 'id');
        if (!empty($postId)) {
            $args = array(
                'post_type' => 'region',
                'post_status' => 'publish',
                'p' => $postId,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ob_start();
                while ($query->have_posts()) {
                    $query->the_post();
                    $desc = $H->unload_m('metaDesc');
                    $subTitle = $H->unload_m('metaSubTitle');
                    $address = $H->unload_m('metaAddress');
                    $contact = $H->unload_m('metaContact');
                    $email = $H->unload_m('metaEmail');
                    $timing = $H->unload_m('metaTiming');
                    $map = $H->unload_m('metaLocation');
                    $splitContact = explode('|', $contact);
                    ?>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">
										<img src="<?php echo unload_Uri ?>partial/images/close1.png" alt=""
                                             itemprop="image"/>
									</span>
                                </button>
                                <div class="region-detail">
                                    <div class="row">
                                        <div class="col-md-6 column">
                                            <div class="region-contact-info">
                                                <div class="heading2">
                                                    <span>Fast And Safe</span>
                                                    <h3><?php esc_html_e('OFFICE ADDRESS', 'unload') ?></h3>
                                                </div>
                                                <?php if (!empty($address)): ?>
                                                    <p><?php esc_html($address) ?></p><?php endif ?>
                                                <div class="contact-detail">
                                                    <?php if (!empty($address)): ?>
                                                        <span class="contact">
															<i class="fa fa-mobile"></i>
															<strong><?php esc_html_e('Phone No', 'unload') ?></strong>
                                                            <?php
                                                            if (!empty($splitContact) && count($splitContact) > 0) {
                                                                foreach ($splitContact as $c) {
                                                                    echo '<span>' . $c . '</span>';
                                                                }
                                                            }
                                                            ?>
														</span>
                                                        <?php
                                                    endif;
                                                    if (!empty($email)):
                                                        ?>
                                                        <span class="contact">
															<i class="fa fa-envelope"></i>
															<strong><?php esc_html_e('Email Address', 'unload') ?></strong>
															<span><?php echo esc_html($email) ?></span>
														</span>
                                                        <?php
                                                    endif;
                                                    if (!empty($timing)):
                                                        ?>
                                                        <span class="contact">
															<i class="fa fa-clock-o"></i>
															<strong><?php esc_html_e('Office Timing', 'unload') ?></strong>
															<span><?php echo esc_html($timing) ?></span>
														</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 column">
                                            <div class="contact-info-form activate">
                                                <!-- contact form -->
                                                <div class="contactform">
                                                    <div id="formresult"></div>
                                                    <form id="contactform" method="post">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="text"
                                                                       placeholder="<?php esc_html_e('Complete Name', 'unload') ?>"
                                                                       class="text-field input-style" id="name"
                                                                       name="name"/>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input type="email"
                                                                       placeholder="<?php esc_html_e('Email Address', 'unload') ?>"
                                                                       id="email" name="email"
                                                                       class="text-field input-style"/>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input type="text"
                                                                       placeholder="<?php esc_html_e('Subject', 'unload') ?>"
                                                                       name="subject" class="text-field input-style"/>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <textarea
                                                                    placeholder="<?php esc_html_e('Description', 'unload') ?>"
                                                                    class="text-field input-style" id="description"
                                                                    name="desc"></textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div id="office-captcha"></div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button id="office-contact"
                                                                        data-mail="<?php echo esc_attr($email) ?>"
                                                                        id="quote-btn" title="" itemprop="url"
                                                                        type="submit" class="theme-btn">
                                                                    <i class="fa fa-paper-plane"></i><?php esc_html_e('Send', 'unload') ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- end contact form -->
                                        </div>
                                    </div>
                                </div><!--Region Detail -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
                $output = ob_get_contents();
                ob_end_clean();
                echo json_encode(array('status' => TRUE, 'msg' => $output));
            }
        } else {
            echo json_encode(array('status' => FALSE, 'msg' => esc_html_('Direct Access in not allowed', 'unload')));
        }
    }

    public function unload_sendOfficeMail($data)
    {
        $h = new unload_Helper();
        $officeMail = $h->unload_set($data, 'officeMail');
        $name = $h->unload_set($data, 'name');
        $email = $h->unload_set($data, 'email');
        $subject = $h->unload_set($data, 'subject');
        $msg = $h->unload_set($data, 'msg');
        $error = '';
        if (empty($officeMail)) {
            echo json_encode(array('status' => FALSE, 'msg' => "<div calss='alert alert-warning'>" . esc_html_('Please Enter office email', 'unload') . "</div>"));
        } else {
            if (empty($name)) {
                $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter Your Name', 'unload') . '</div>';
            }
            if (empty($email)) {
                $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter Your Email', 'unload') . '</div>';
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error .= '<div class = "alert alert-warning">' . sprintf(__('This %s email address is considered valid.', 'unload'), $email) . '</div>';
            }
            if (empty($subject)) {
                $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter Your Subject', 'unload') . '</div>';
            }
            if (empty($msg)) {
                $error .= '<div class = "alert alert-warning">' . esc_html__('Please Enter Your Message', 'unload') . '</div>';
            }

            if (empty($error)) {

                $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
                wp_mail($officeMail, esc_html__('Contact Us Message', 'unload'), $msg);
                $message = sprintf(esc_html__('Thank you %s for using our contact form!Your email was successfully sent and we will be in touch with you soon.', 'unload'), '<strong>' . $name . '</strong>');
                $success = '<div class="alert alert-success">' . $message . '</div>';
                echo json_encode(array('status' => TRUE, 'msg' => $success));
            } else {
                echo json_encode(array('status' => FALSE, 'msg' => $error));
            }
        }
    }

    public function unload_widgetNewsletter($options)
    {
        check_ajax_referer( Unload_KEY, 'newsletter_key' );  
        $h = new unload_Helper();
        $opt = $h->unload_opt();
        $errors = '';
        $notify = '';
        $apikey = $h->unload_set($opt, 'optMailchimpApiKey');
        $list_id = $h->unload_set($opt, 'optMailchimpListId');
        $email = $h->unload_set($options, 'email');
        $before = '<div class = "alert alert-warning">';
        $after = '</div>';
        if ($apikey == '') {
            $errors .= $before . esc_html__('Please Enter MailChimp API Key in theme options', 'unload') . $after;
        }

        if ($list_id == '') {
            $errors .= $before . esc_html__('Please Enter MailChimp List ID in theme options', 'unload') . $after;
        }

        if ($email == '') {
            $errors .= $before . esc_html__('Please Enter Your Email Address', 'unload') . $after;
        }

        if ($email != '' && !is_email($email)) {
            $errors .= $before . esc_html__('Please Enter Valid Email Address', 'unload') . $after;
        }
        if (empty($errors)) {
            $dc = '';
            if (strstr($apikey, "-")) {
                list($key, $dc) = explode("-", $apikey, 2);
                if (!$dc) {
                    $dc = "us1";
                }
            }
            $auth = unload_encrypt('user:' . $apikey);
            $get_name = explode('@', $email);
            $data = array(
                'apikey' => $apikey,
                'email_address' => $email,
                'status' => 'subscribed',
                'merge_fields' => array(
                    'FNAME' => $h->unload_set($get_name, '0')
                )
            );
            $json_data = json_encode($data);
            global $wp_version;
            $request = array(
                'headers' => array(
                    'Authorization' => 'Basic ' . $auth,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Content-Length' => strlen($json_data),
                ),
                'httpversion' => '1.0',
                'timeout' => 10,
                'method' => 'POST',
                'user-agent' => 'WordPress/' . $wp_version . ';
						' . home_url('/'),
                'sslverify' => FALSE,
                'body' => $json_data,
            );

            $req = wp_remote_post('https://' . $dc . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/', $request);
            $r = json_decode($h->unload_set($req, 'body'));

            if (preg_match("/The requested resource could not be found./", $h->unload_set($r, 'detail')) == TRUE) {
                $notify .= '<div class="alert alert-warning"><strong>' . esc_html__('Invalid List ID', 'unload') . '.</div>';
            } elseif (preg_match("/Use PUT to insert or update list members./", $h->unload_set($r, 'detail')) == TRUE) {
                $notify .= "<div class='alert alert-warning'><strong>{$email} " . esc_html__('is Already Exists', 'unload') . ".</div>";
            } else {
                $notify .= '<div class="alert alert-success"><strong>' . esc_html__('Thank you for subscribing with us', 'unload') . '.</div>';
            }
            echo json_encode(array('msg' => $notify));
        } else {
            echo json_encode(array('msg' => $errors));
        }
        exit;
    }

    public function unload_processBooking($data)
    {
        $h = new unload_Helper();
        $opt = $h->unload_opt();
        $before = '<div class="alert alert-warning">';
        $after = '</div>';
        $errors = '';
        $orderPrefix = ($h->unload_set($opt, 'optBookingOrderPrfix')) ? $h->unload_set($opt, 'optBookingOrderPrfix') : esc_html__('order', 'unload');
        $SuccessMsg = $h->unload_set($opt, 'optBookingMsg');
        $table = "\r\n\r\n";
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $table .= ucwords(str_replace(array('_', '-'), ' ', $k)) . ' : ' . $v . "\r\n";
                if (empty($v)) {
                    $replace = array('_', '-');
                    $errors .= $before . sprintf(esc_html__('%s not be empty', 'unload'), ucwords(str_replace($replace, ' ', $k))) . $after;
                }
            }
        }
        $table .= "\r\n";
        if (empty($errors)) {
            $generateId = sprintf("%08d", mt_rand(1, 99999999));
            $orderId = $orderPrefix . '-' . $generateId;
            $order = array(
                'post_title' => wp_strip_all_tags($orderId),
                'post_type' => 'un_order',
                'post_status' => 'publish'
            );
            $orderPostId = wp_insert_post($order);
            $orderMeata = array(
                'metaOrderStatus' => esc_html__('Order Received', 'unload'),
                'metaFromCountry' => $h->unload_set($data, 'from_country'),
                'metaFromCity' => $h->unload_set($data, 'from_state'),
                'metaToCountry' => $h->unload_set($data, 'to_country'),
                'metaToCity' => $h->unload_set($data, 'to_state'),
                'metaService' => get_the_title($h->unload_set($data, 'service')),
                'metaOrderDate' => date('m-d-Y'),
                'metaSenderName' => $h->unload_set($data, 'sender-name'),
                'metaSenderEmail' => $h->unload_set($data, 'sender-mail'),
                'metaSenderContact' => $h->unload_set($data, 'sender-contact'),
                'metaSenderAddress' => $h->unload_set($data, 'sender-address'),
                'metaReciverName' => $h->unload_set($data, 'reciver-name'),
                'metaReciverEmail' => $h->unload_set($data, 'reciver-mail'),
                'metaReciverContact' => $h->unload_set($data, 'reciver-contact'),
                'metaReciverAddress' => $h->unload_set($data, 'reciver-address'),
                'metaOrderNote' => $h->unload_set($data, 'order-note'),
            );
            foreach ($orderMeata as $k => $v) {
                update_post_meta($orderPostId, $k, $v);
            }
            $tmplate = array('{{site}}', '{{user}}');
            $replace = array(strtoupper(home_url('/')), $h->unload_set($data, 'sender-name'));
            $message = str_replace($tmplate, $replace, $h->unload_set($opt, 'optBookingMailTemplate'));
            $message .= $table;
            $mailName = strtoupper(str_replace(array('http://', 'https://', '.com', '/'), '', home_url('/')));
            $mailAddress = $h->unload_set($opt, 'optBookingFromMail');
            require_once ABSPATH . WPINC . '/class-phpmailer.php';
            new unload_Wpmail($mailName, $mailAddress);
            $mailHeader = 'From: ' . $mailAddress . '' . "\r\n" . 'Reply-To: ' . $mailAddress . '' . "\r\n";
            wp_mail($h->unload_set($data, 'sender-mail'), sprintf(esc_html__('Order ID %s', 'unload'), '#' . $generateId), $message, $mailHeader);
            wp_mail($mailAddress, sprintf(esc_html__('Received New Order %s', 'unload'), '#' . $generateId), $message, $mailHeader);
            // create new user

            require_once(ABSPATH . WPINC . '/registration.php');
            $pass = wp_generate_password(12, TRUE, TRUE);
            $userName = explode('@', $h->unload_set($data, 'sender-mail'));
            $userArgs = array(
                'user_login' => $h->unload_set($userName, '0'),
                'user_pass' => $pass,
                'user_email' => $h->unload_set($data, 'sender-mail'),
                'first_name' => $h->unload_set($userName, '0'),
                'user_registered' => date('Y-m-d H:i:s'),
                'role' => 'un_customer'
            );

            $new_user_id = wp_insert_user($userArgs);
            $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
            $message = sprintf(esc_html__('User Information of %s:', 'unload'), $blogname) . "\r\n\r\n";
            $message .= sprintf(esc_html__('Username: %s', 'unload'), $h->unload_set($userName, '0')) . "\r\n\r\n";
            $message .= sprintf(esc_html__('Password: %s', 'unload'), $pass) . "\r\n\r\n";
            $message .= sprintf(esc_html__('Email: %s', 'unload'), $h->unload_set($data, 'sender-mail')) . "\r\n\r\n";
            $message .= sprintf(esc_html__('Please Login from this link: %s', 'unload'), wp_login_url()) . "\r\n";
            wp_mail($h->unload_set($data, 'sender-mail'), sprintf(esc_html__('[%s] Your username and password info', 'unload'), $blogname), $message);
            // create new user
            echo json_encode(array('status' => TRUE, 'msg' => $SuccessMsg));
        } else {
            echo json_encode(array('status' => FALSE, 'msg' => $errors));
        }
    }

    public function unload_trackOrder($data)
    {
        check_ajax_referer( Unload_KEY, 'security' );  
        $h = new unload_Helper;
        if ($h->unload_set($data, 'orderid') != '') {
            $opt = $h->unload_opt();
            $orderPrefix = ($h->unload_set($opt, 'optBookingOrderPrfix')) ? $h->unload_set($opt, 'optBookingOrderPrfix') : esc_html__('order', 'unload');
            $args = array(
                'post_type' => 'un_order',
                'post_status' => 'publish',
                'name' => $orderPrefix . '-' . $h->unload_set($data, 'orderid')
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $status = get_post_meta(get_the_ID(), 'metaOrderStatus', TRUE);
                    echo json_encode(array('msg' => $status));
                }
                wp_reset_postdata();
            } else {
                echo json_encode(array('msg' => esc_html__('Invalid Tracking Code', 'unload')));
            }
        } else {
            echo json_encode(array('msg' => esc_html__('Enter the tracking code', 'unload')));
        }
    }

    public function unload_processShippingRequest($data)
    {
        check_ajax_referer( Unload_KEY, 'shipping_submit_key' );
        $h = new unload_Helper();
        $before = '<div class="alert alert-warning">';
        $after = '</div>';
        $errors = '';
        $mailid = $h->unload_set($data, 'mailid');
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                if (empty($v)) {
                    $replace = array('_', '-');
                    $errors .= $before . sprintf(esc_html__('%s not be empty', 'unload'), ucwords(str_replace($replace, ' ', $k))) . $after;
                }
            }
        }
        if (empty($errors)) {
            $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
            $title = sprintf(esc_html__('Shipping Request From %s:', 'unload'), $blogname) . "\r\n\r\n";
            $message = '';
            unset($data['mailid']);
            unset($data['action']);
            foreach ($data as $k => $v) {
                if ($k == 'features') {
                    $message .= sprintf(esc_html__('Features: %s', 'unload'), implode(',', $v)) . "\r\n\r\n";
                } else {
                    $message .= sprintf(esc_html__('%s: %s', 'unload'), ucwords(str_replace('_', ' ', $k)), $v) . "\r\n\r\n";
                }
            }
            wp_mail($mailid, $title, $message);
            echo json_encode(array('status' => TRUE, 'msg' => $SuccessMsg));
        } else {
            echo json_encode(array('status' => FALSE, 'msg' => $errors));
        }
    }

    public function unload_getShippingRequest($data)
    {
        check_ajax_referer( Unload_KEY, 'security' );  
        $h = new unload_Helper;
        $opt = $h->unload_opt();
        $title = ($h->unload_set($opt, 'optShippingTitle')) ? $h->unload_set($opt, 'optShippingTitle') : '';
        $sub_title = ($h->unload_set($opt, 'optShippingSubTitle')) ? $h->unload_set($opt, 'optShippingSubTitle') : '';
        $btntext = ($h->unload_set($opt, 'optShippingbtn')) ? $h->unload_set($opt, 'optShippingbtn') : '';
        $mailid = ($h->unload_set($opt, 'optShippingEmail')) ? $h->unload_set($opt, 'optShippingEmail') : '';
        $bg = '';
        $getfeatures = ($h->unload_set($opt, 'optShippingFeatures')) ? $h->unload_set($opt, 'optShippingFeatures') : '';
        $emptyArray = array();
        $features_count = count($getfeatures);
        if ($features_count > 0) {
            foreach ($getfeatures as $f) {
                $emptyArray[] = array('feature_name' => $f);
            }
        }
        $extra_features = $emptyArray;
        ob_start();
        include unload_Root . 'calc.php';
        $htmlOutput = ob_get_contents();
        ob_end_clean();
        echo balanceTags($htmlOutput);
        exit;
    }

    public function __clone()
    {
        trigger_error(esc_html__('Cloning the registry is not permitted', 'unload'), E_USER_ERROR);
    }

}
