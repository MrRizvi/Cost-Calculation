<?php
// Template Name:	Booking
$h = new unload_Helper;
$h->unload_header();
$opt = $h->unload_opt();
$h->unload_headerTop(get_the_ID());
unload_Media::unload_singleton()->unload_eq(array('select2', 'bootstrap', 'jplugin', 'datepick', 'countries', 'icheck', 'sticky-kit'));
$title = $h->unload_set($opt, 'optBookingTitle');
$subtitle = $h->unload_set($opt, 'optBookingSubTitle');
$desc = $h->unload_set($opt, 'optBookingDesc');
$sideImg = $h->unload_set($opt, 'optBookingSideImg');
$bgImage = $h->unload_set($opt, 'optBookingBgImg');
$btnTxt = ($h->unload_set($opt, 'optBookingBtnTxt')) ? $h->unload_set($opt, 'optBookingBtnTxt') : esc_html__('BOOK NOW', 'unload');
$isTerm = $h->unload_set($opt, 'optBookingTerm');
$termPage = $h->unload_set($opt, 'optBookingTermPage');
$isPrivacy = $h->unload_set($opt, 'optBookingPrivacy');
$PrivacyPage = $h->unload_set($opt, 'optBookingPrivacyPage');
$termTxt = $h->unload_set($opt, 'optBookingTemsTxt');
$services = $h->unload_posts('service');
?>
    <section class="block grayish">
        <div class="fixed-bg"
             style="background: url(<?php echo esc_url($h->unload_set($bgImage, 'url')) ?>) no-repeat scroll;"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="booking-page" data-sticky_parent>
                        <div class="row">
                            <div class="col-md-4">
                                <?php if ($h->unload_set($sideImg, 'url') != ''): ?>
                                    <div class="person-img" data-sticky_column>
                                        <img src="<?php echo esc_url($h->unload_set($sideImg, 'url')) ?>" alt=""/>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-8">
                                <div class="booking">
                                    <div class="title2 title4">
                                        <?php if (!empty($subtitle)): ?>
                                            <strong>
                                                <?php echo esc_html($subtitle) ?>
                                            </strong>
                                            <?php
                                        endif;
                                        if (!empty($subtitle)):
                                            ?>
                                            <h2>
                                                <?php echo esc_html($title) ?>
                                            </h2>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($subtitle)): ?>
                                        <P><?php echo esc_html($desc) ?></P>
                                    <?php endif; ?>
                                    <div class="booking-result"></div>
                                    <div id="booking-form" class="booking-form">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="select-service select-box">
                                                        <select
                                                            onchange="print_state('from_state', this.selectedIndex);"
                                                            id="from_country" name="from_country"></select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="select-from select-box">
                                                        <select name="from_state" id="from_state">
                                                            <option><?php esc_html_e('From State', 'unload') ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="select-service select-box">
                                                        <select onchange="print_state('to_state', this.selectedIndex);"
                                                                id="to_country" name="to_country"></select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="select-from select-box">
                                                        <select name="to_state" id="to_state">
                                                            <option><?php esc_html_e('To State', 'unload') ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="select-goods select-box">
                                                        <select name="service" id="service">
                                                            <option><?php esc_html_e('Choose Service', 'unload') ?></option>
                                                            <?php
                                                            if (!empty($services) && count($services) > 0) {
                                                                foreach ($services as $k => $v) {
                                                                    echo '<option value="' . esc_attr($k) . '">' . esc_html($v) . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">' . esc_html__('No Service', 'unload') . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="datepicker-field">
                                                        <input class="datepicker" name="order-date" id="datepicker"
                                                               type="text"
                                                               placeholder="<?php esc_html_e('Select Date', 'unload') ?>"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label><input type="text" name="sender-name" class="text-field"
                                                                  placeholder="<?php esc_html_e('Name', 'unload') ?>"/></label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label><i class="fa fa-envelope"></i><input type="email"
                                                                                                name="sender-mail"
                                                                                                class="text-field"
                                                                                                placeholder="<?php esc_html_e('Email Address', 'unload') ?>"/></label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label><i class="fa fa-phone"></i><input type="text"
                                                                                             name="sender-contact"
                                                                                             class="text-field"
                                                                                             placeholder="<?php esc_html_e('Phone No', 'unload') ?>"/></label>
                                                </div>

                                                <div class="col-md-12">
                                                    <label><input type="text" name="sender-address" class="text-field"
                                                                  placeholder="<?php esc_html_e('Address', 'unload') ?>"/></label>
                                                </div>
                                                <div class="title2 title4">
                                                    <h2><?php esc_html_e('Reciver Information', 'unload') ?></h2>
                                                </div>
                                                <div class="col-md-12">
                                                    <label><input type="text" name="reciver-name" class="text-field"
                                                                  placeholder="<?php esc_html_e('Name', 'unload') ?>"/></label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label><i class="fa fa-envelope"></i><input type="email"
                                                                                                name="reciver-mail"
                                                                                                class="text-field"
                                                                                                placeholder="<?php esc_html_e('Email Address', 'unload') ?>"/></label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label><i class="fa fa-phone"></i><input type="text"
                                                                                             name="reciver-contact"
                                                                                             class="text-field"
                                                                                             placeholder="<?php esc_html_e('Phone No', 'unload') ?>"/></label>
                                                </div>

                                                <div class="col-md-12">
                                                    <label><input type="text" name="reciver-address" class="text-field"
                                                                  placeholder="<?php esc_html_e('Address', 'unload') ?>"/></label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea name="order-note" class="text-field"
                                                              placeholder="<?php esc_html_e('Order Note', 'unload') ?>"></textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <?php if ($isTerm == '1' || $isPrivacy == '1'): ?>
                                                        <div class="terms-services">
														<span>
															<input tabindex="23" type="checkbox" id="termscondition"/>
															<label>
																<?php
                                                                echo esc_html($termTxt);
                                                                if ($isTerm == '1'):
                                                                    ?>
                                                                    <a target="_blank"
                                                                       href="<?php echo get_page_link($termPage) ?>"
                                                                       title="">
																		<?php esc_html_e('Terms of Service ', 'unload') ?>
																	</a>
                                                                    <?php
                                                                endif;
                                                                if ($isTerm == '1' && $isPrivacy == '1'):
                                                                    esc_html_e(' and ', 'unload');
                                                                endif;
                                                                if ($isPrivacy == '1'):
                                                                    ?>
                                                                    <a target="_blank"
                                                                       href="<?php echo get_page_link($PrivacyPage) ?>"
                                                                       title="">
																		<?php esc_html_e('Privacy Policy', 'unload') ?>
																	</a>
                                                                <?php endif; ?>
															</label>
														</span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <a href="javascript:void(0)" class="theme-btn"><i
                                                            class="fa fa-paper-plane"></i><?php echo esc_html($btnTxt) ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!--Calculate Shipping -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
$jsOutput = "jQuery(document).ready(function($){
	'use strict';
	$('select#from_country').select2({
            placeholder: '" . esc_html__('From Country', 'unload') . "'
        });
        $('select#from_state').select2({
            placeholder: '" . esc_html__('From City', 'unload') . "'
        });
		$('select#to_country').select2({
            placeholder: '" . esc_html__('To Country', 'unload') . "'
        });
        $('select#to_state').select2({
            placeholder: '" . esc_html__('To City', 'unload') . "'
        });
		$('select#service').select2({
            placeholder: '" . esc_html__('Select Service', 'unload') . "'
        });
	print_country('from_country');
	print_country('to_country');
	$('#datepicker').datepick();
	$('.terms-services > span > input').iCheck({
        checkboxClass: 'icheckbox_futurico2',
        increaseArea: '20%' // optional
    });
	
	$('.person-img').stick_in_parent();
});";
wp_add_inline_script('unload-script', $jsOutput);
get_footer();
