jQuery(document).ready(function ($) {
    "use strict";
    if ($('#wpadminbar').length != 0 && $('.top-sec').length != 0) {
        $('header').css('margin-top', '30px');
    } else {
        $('header').css('margin-top', '0px');
    }

    if ($.isFunction($.fn.scrollupbar)) {
        $('.scrollup').scrollupbar();
    }

    $('body').removeClass('date');
    // Parallax // 
    $('.parallax').scrolly({bgParallax: true});
    // Container Gap // 
    var container_gap = $(".container").offset().left;
    $(".contact-head").css({
        'left': container_gap
    });
    // Hash Location // 
//    function scrollTo(hash) {
//        location.hash = "#" + hash;
//    }

    // Responsive Header //
    $(".responsive-btn").on("click", function () {
        $(".responsive-menu").addClass("slidein");
        return false;
    });
    $(".close-btn").on("click", function () {
        $(".responsive-menu").removeClass("slidein");
        return false;
    });
    $(".responsive-menu").on("click", function (e) {
        e.stopPropagation();
        return false;
    });
    $(".responsive-menu li > a").on("click", function (e) {
        if ($(this).parent('li').hasClass('menu-item-has-children')) {
            $(this).parent().siblings().children("ul").slideUp();
            $(this).parent().siblings().removeClass("active");
            $(this).parent().children("ul").slideToggle();
            $(this).parent().toggleClass("active");
            return false;
        } else {
            window.location.href = $(this).attr('href');
        }
    });
	
	//scrollbar plugin
		if ($.isFunction($.fn.perfectScrollbar)) {
			$('.calculate-shipping,.request-quote-body').perfectScrollbar();
		}
	
    // Sticky Header// 
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 10) {
            $(".stick").addClass("sticky");
        } else {
            $(".stick").removeClass("sticky");
        }
    });
    var menu_height = $("header.stick").height();
    if ($('header').hasClass('stick')) {
        menu_height = menu_height - 30;
    }
    $(".theme-layout").css({"padding-top": menu_height});
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 10) {
            $('header').addClass('scrollup');
            var menu_h = $("header.sticky").height();
            if ($("header").hasClass("sticky")) {
                $(".theme-layout").css({"padding-top": menu_h});
            } else {
                $(".theme-layout").css({"margin-bottom": "0"});
            }
        } else {
            $('header').removeClass('scrollup').attr('style', '');
            if ($('#wpadminbar').length != 0 && $('.top-sec').length != 0) {
                $('header').css({"margin-top": "30px"});
            }
            $(".theme-layout").css({"padding-top": menu_height});
        }
    });


// Scroll Bar //
    if ($.isFunction($.fn.perfectScrollbar)) {
        $('.responsive-menu, .modal-dialog1, .modal-dialog2').perfectScrollbar();
    }

// Responsive Header Sec
    $(".top-sec-btn").on("click", function () {
        $(".responsive-top-sec").toggleClass("active");
        return false;
    });
    // Unload SignUp Popup
    $('.signup-form > button').on('click', function () {
        $('#signup-popup').removeClass('unload-singnup-popup');
        return false;
    });
    // Popup One // 
    $('.popup1').on('click', function () {
        $('#signup-popup').addClass('unload-singnup-popup');
        return false;
    });
    // Unload Calculate Form PopUp
    $('.modal-body2 > button').on('click', function () {
        $('#calculate-form-popup').removeClass('unload-calculate-form-popup');
        return false;
    });
    // Popup 2 // 
    $('.popup2').on('click', function () {
        $('#calculate-form-popup').addClass('unload-calculate-form-popup');
        return false;
    });
    //** Partners **//
    if (typeof owlCarousel == 'function') {
        $("#partners").owlCarousel({
            rtl: unload.rtl,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 2000,
            loop: true,
            dots: false,
            nav: true,
            margin: 90,
            items: 5,
            singleItem: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                600: {
                    items: 3
                },
                900: {
                    items: 3
                },
                1200: {
                    items: 5
                }
            }
        });
    }

// start contact form
    $('form.contactform button').on('click', function () {
        var this_id = $(this).attr('id');
        var form = $('#' + this_id).parents('form.contactform');
        var name = $(form).find('input[name="complete_name"]').val();
        var email = $(form).find('input[name="email_address"]').val();
        var subject = $(form).find('input[name="subject"]').val();
        var message = $(form).find('textarea[name="description"]').val();
        var receiver = $(form).find('input[name="receiver"]').val();
        var contactform_key = $(form).find('input[name="contactform_key"]').val();
        var msg = $(form).prev();
        $(msg).empty();
        var data = 'name=' + name + '&contactform_key='+contactform_key+'&email=' + email + '&subject=' + subject + '&message=' + message + '&receiver=' + receiver + '&action=unloadContactForm';
        $.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: 'json',
            beforeSend: function () {
                $('#' + this_id).after('<img src="' + unload.url + 'partial/images/ajax-loader.gif" class="loader" />').attr('disabled', 'disabled');
            },
            success: function (res) {
                $(msg).html(res.msg);
                $(msg).slideDown('slow');
                $("form img.loader").fadeOut('slow', function () {
                    $(this).remove();
                });
                if (res.status === true) {
                    $(form).slideUp('slow');
                } else if (res.status === true) {
                    $(msg).html(res.msg);
                    $(msg).slideDown('slow');
                }
                $('#' + this_id).removeAttr('disabled');
                setTimeout(function () {
                    $(msg).empty();
                }, 5000);
            }
        });
        return false;
    });
});
function unload_list($id) {
    jQuery("#PAD").addClass("loaded");
    var l = jQuery("#PAD" + $id + " > ul li").length;
    for (var i = 0; i <= l; i++) {
        var room_list = jQuery("#PAD" + $id + " > ul li").eq(i);
        var room_img_height = jQuery(room_list).find(".company-project > img").innerHeight();
        jQuery(room_list).css({
            "height": room_img_height
        });
        jQuery(room_list).find(".company-project > img").css({
            "width": "100%"
        });
    }

    jQuery("#PAD" + $id + " > ul li.start").addClass("active");
    jQuery("#PAD" + $id + " > ul li").on("mouseenter", function () {
        jQuery("#PAD" + $id + " > ul li").removeClass("active");
        jQuery(this).addClass("active");
    });
}


jQuery(document).ready(function ($) {

//login form script
    $('form#loginForm a#login').live('click', function (e) {
        var user = $('form#loginForm').find('#user').val();
        var pass = $('form#loginForm').find('#password').val();
        var nonce = $('form#loginForm').find('#ajax_login_nonce').val();
        var remember = '';
        if ($('input#rempass').is(":checked")) {
            remember = 'true';
        } else {
            remember = 'false';
        }
        var resArea = $('form#loginForm').prev('div.log');
        var data = 'user=' + user + '&pass=' + pass + '&nonce=' + nonce + '&rem=' + remember + '&action=unloadAjaxLogin';
        $.ajax({
            type: 'POST',
            url: unload.ajaxurl,
            dataType: 'json',
            data: data,
            beforeSend: function () {
                $('div.preloader').fadeIn('slow');
            },
            success: function (res) {
                $('div.preloader').fadeOut('slow');
                if (res.status == true) {
                    resArea.empty();
                    resArea.html(res.msg);
                    document.location.href = res.url;
                } else {
                    resArea.empty();
                    resArea.html(res.msg);
                }
            }
        });
        e.preventDefault();
    });
    //end login form script


    $('form#regForm a#regUser').live('click', function (e) {
        var resArea = $('form#regForm').prev('div.log');
        var term = '';
        if ($('input#terms').is(":checked")) {
            term = 'true';
        } else {
            term = 'false';
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: unload.ajaxurl,
            data: {
                'action': 'registerUser',
                'first_name': $('form#regForm #fname').val(),
                'last_name': $('form#regForm #lname').val(),
                'username': $('form#regForm #reg-user').val(),
                'email': $('form#regForm #reg_email').val(),
                'password': $('form#regForm #pass').val(),
                'repass': $('form#regForm #repass').val(),
                'security': $('form#regForm #ajax_reg_nonce').val(),
                'term': term
            },
            beforeSend: function () {
                $('div.preloader').fadeIn('slow');
            },
            success: function (data) {
                $('div.preloader').fadeOut('slow');
                $(resArea).empty();
                $(resArea).html(data.message);
                if (data.loggedin == true) {
                    document.location.href = data.url;
                }
                setTimeout(function () {
                    $(resArea).empty();
                }, 4000);
            }
        });
        e.preventDefault();
    });
    // end registration form script

    // start request a quote
    $('a#requestQuoteProcess').live('click', function (e) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: unload.ajaxurl,
            data: {
                'action': 'requestAQuote',
                'name': $('form#requestQuote #name').val(),
                'email': $('form#requestQuote #quoteemail').val(),
                'fdate': $('form#requestQuote #fromdate').val(),
                'tdate': $('form#requestQuote #todate').val(),
                'message': $('form#requestQuote #msg').val(),
                'security': $('form#requestQuote #ajax_quote_nonce').val(),
                'remail': $('form#requestQuote #recMail').val(),
            },
            beforeSend: function () {
                $('div.preloader').fadeIn('slow');
            },
            success: function (data) {
                $('div.preloader').fadeOut('slow');
                if (data.loggedin == true) {
                    $('#submission-message').modal('show');
                    $('form#requestQuote').prev('div.log').empty();
                    setTimeout(function () {
                        $('.alert').hide();
                    }, 5000);
                } else if (data.loggedin == false) {
                    $('form#requestQuote').prev('div.log').empty();
                    $('form#requestQuote').prev('div.log').html(data.msg);
                    setTimeout(function () {
                        $('.alert').hide();
                    }, 5000);
                }
            }
        });
        e.preventDefault();
    });
    // end request a quote


    // office contact form
    $('button#office-contact').live('click', function () {
        var parent = $(this).parents('form#contactform');
        var officeMail = $(this).data('mail');
        var name = $(parent).find('input[name="name"]').val();
        var email = $(parent).find('input[name="email"]').val();
        var subject = $(parent).find('input[name="subject"]').val();
        var msg = $(parent).find('textarea[name="desc"]').val();
        var data = 'officeMail=' + officeMail + '&name=' + name + '&email=' + email + '&subject=' + subject + '&msg=' + msg + '+&action=sendOfficeMail';
        var logBox = $(parent).prev('div#formresult');
        $.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: 'json',
            beforeSend: function () {
                $('div.preloader').fadeIn('slow');
            },
            success: function (res) {
                $('div.preloader').fadeOut('slow');
                if (res.status === true) {
                    $(logBox).empty();
                    $(logBox).html(res.msg);
                    $(parent).slideUp('slow');
                } else if (res.status === false) {
                    $(logBox).empty();
                    $(logBox).html(res.msg);
                }
            }
        });
        return false;
    });
    // end office contact form

    // widget newsletter
    $('form#widget-newsletter a.theme-btn').on('click', function () {
        var $this = $(this);
        var parent = $(this).parents('form#widget-newsletter');
        var newsletter_key = $("#newsletter_key").val();
        var email = $(parent).find("input").val();
        var data = 'email=' + email + '&action=widgetNewsletter' +'&newsletter_key='+newsletter_key;
        var notify = $(parent).prev('div.widget-notify');
        $(notify).empty();
        jQuery.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $($this).children('i').removeClass().addClass('fa fa-cog');
                $($this).addClass('process');
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $($this).children('i').removeClass().addClass('fa fa-paper-plane');
                $($this).removeClass('process');
                $(notify).empty();
                $(notify).html(res.msg);
                $(parent).find("input").val('');
            }
        });
        return false;
    });
    $('#widget-newsletter_mail').live("keypress", function (e) {
        if (e.keyCode == 13) {
            var $this = $(this);
            var parent = $(this).parents('form#widget-newsletter');
            var email = $(parent).find("input").val();
            var data = 'email=' + email + '&action=widgetNewsletter';
            var notify = $(parent).prev('div.widget-notify');
            $(notify).empty();
            jQuery.ajax({
                type: "post",
                url: unload.ajaxurl,
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $($this).prop('disabled', true);
                    $('.theme-btn i').removeClass().addClass('fa fa-cog');
                    $('.theme-btn').addClass('process');
                },
                success: function (res) {
                    $($this).prop('disabled', false);
                    $('.theme-btn i').removeClass().addClass('fa fa-paper-plane');
                    $('.theme-btn').removeClass('process');
                    $(notify).empty();
                    $(notify).html(res.msg);
                    $(parent).find("input").val('');
                }
            });
            return false; // prevent the button click from happening
        }
    });
    // widget newsletter

    // booking form
    $('div.booking-form a.theme-btn').on('click', function () {
        var isCheck = $('input#termscondition:checked').length;
        if ($('input#termscondition').length > 0) {
            if (isCheck == 0) {
                alert(unload.term);
                return false;
            }
        }
        var $this = $(this);
        var parent = $(this).parents('div.booking-form');
        var email = $(parent).find("input").val();
        var formData = $(parent).find('form').serialize() + '&action=processBooking';
        var data = formData;
        var notify = $(parent).prev('div.booking-result');
        $(notify).empty();
        jQuery.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $('div.preloader').fadeIn('slow');
            },
            success: function (res) {
                $(notify).empty();
                $($this).prop('disabled', false);
                $('div.preloader').fadeOut('slow');
                if (res.status === true) {
                    $('#submission-message').find('h1').html(unload.ordrTitle);
                    $('#submission-message').find('p').html(res.msg);
                    $('#submission-message').modal('show');
                    $(parent).closest('form').find("input[type=text], textarea").val("");
                } else if (res.status === false) {
                    $(notify).html(res.msg);
                    setTimeout(function () {
                        $(notify).empty();
                    }, 5000);
                }
            }
        });
        return false;
    });
    // booking form

    // tracking info
    $('div.shipment-visibility a.theme-btn').on('click', function () {
        var $this = $(this);
        var parent = $(this).parents('div.shipment-visibility');
        var orderid = $(parent).find("input").val();
        var security = $("#ordertracking_key").val();
        var data = 'orderid=' + orderid + '&action=trackOrder'+ '&security='+security;
        jQuery.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $($this).children('i').removeClass().addClass('fa fa-cog');
                $($this).addClass('process');
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $($this).children('i').removeClass().addClass('fa fa-paper-plane');
                $($this).removeClass('process');
                $('#submission-message').find('h1').html(unload.ordrTitle);
                $('#submission-message').find('p').html(res.msg);
                $('#submission-message').modal('show');
                $(parent).find("input").val('');
            }
        });
        return false;
    });
    // tracking info

    // tracking info2
    $('div.track-form a.theme-btn').on('click', function () {
        var $this = $(this);
        var parent = $(this).parents('div.track-form');
        var orderid = $(parent).find("input").val();        
        var security = $("#ordertracking_key").val();
        var data = 'orderid=' + orderid + '&action=trackOrder'+ '&security='+security;
        jQuery.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $($this).children('i').removeClass().addClass('fa fa-cog');
                $($this).addClass('process');
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $($this).children('i').removeClass().addClass('fa fa-paper-plane');
                $($this).removeClass('process');
                $('#submission-message').find('h1').html(unload.ordrTitle);
                $('#submission-message').find('p').html(res.msg);
                $('#submission-message').modal('show');
                $(parent).find("input").val('');
            }
        });
        return false;
    });
    // tracking info2
    $('#trakingno').live("keypress", function (e) {
        if (e.keyCode == 13) {
            var $this = $(this);
            var parent = $(this).parents('div.track-form');
            var orderid = $(this).val();
            var data = 'orderid=' + orderid + '&action=trackOrder';
            jQuery.ajax({
                type: "post",
                url: unload.ajaxurl,
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $($this).prop('disabled', true);
                    $('.theme-btn i').removeClass().addClass('fa fa-cog');
                    $('.theme-btn').addClass('process');
                },
                success: function (res) {
                    $($this).prop('disabled', false);
                    $('.theme-btn i').removeClass().addClass('fa fa-paper-plane');
                    $('.theme-btn').removeClass('process');
                    $('#submission-message').find('h1').html(unload.ordrTitle);
                    $('#submission-message').find('p').html(res.msg);
                    $('#submission-message').modal('show');
                    $(parent).find("input").val('');
                }
            });
            return false; // prevent the button click from happening
        }
    });
    // shipping form
    $('form#shipping_pkg_quote a#shipping_submit').live('click', function () {
        var $this = $(this);
        var parent = $(this).parents('form#shipping_pkg_quote');
        var formData = $(parent).serialize() + '&action=processShippingRequest';
        var data = formData;
        var notify = $(parent).prev('div.msg');
        $(notify).empty();
        jQuery.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            dataType: "json",
            beforeSend: function () {
                $($this).prop('disabled', true);
                $('div.preloader').fadeIn('slow');
            },
            success: function (res) {
                $(notify).empty();
                $($this).prop('disabled', false);
                $('div.preloader').fadeOut('slow');
                if (res.status === true) {
                    $('#submission-message').find('h1').html();
                    $('#submission-message').find('p').html(res.msg);
                    $('#submission-message').modal('show');
                    $(parent).closest('form').find("input[type=text], textarea").val("");
                } else if (res.status === false) {
                    $(notify).html(res.msg);
                    setTimeout(function () {
                        $(notify).empty();
                    }, 5000);
                }
            }
        });
        return false;
    });
    // shipping form

    $('a#shipping_calc').on('click', function () {
        var $this = $(this);
        var security = $("#request_a_rate").val();
        var data = 'action=getShippingRequest' + '&security=' +security;
        jQuery.ajax({
            type: "post",
            url: unload.ajaxurl,
            data: data,
            beforeSend: function () {
                $($this).prop('disabled', true);
                $('div.preloader').fadeIn('slow');
            },
            success: function (res) {
                $($this).prop('disabled', false);
                $('div.preloader').fadeOut('slow');
                $('div.theme-layout').prepend('<div id=calculate-form-popup><div class=calculate-form-popup><div class="modal-dialog2"><div class=modal-content2><div class=modal-body2><button type=submit><img alt=""src="' + unload.url + 'partial/images/close1.png"></button>' + res + '</div></div></div></div></div>')
                $('#calculate-form-popup').find('div.cargo-shipment').removeClass('cargo-shipment');
                $('.modal-dialog2').perfectScrollbar();
                $('#calculate-form-popup select#shiping_from_country').select2({placeholder: 'From Country'});
                $('#calculate-form-popup select#shiping_from_country').select2({placeholder: 'From Country'});
                $('#calculate-form-popup select#shipping_from_state').select2({placeholder: 'To Country'});
                $('#calculate-form-popup select#shiping_to_country').select2({placeholder: 'From City'});
                $('#calculate-form-popup select#shipping_to_state').select2({placeholder: 'From City'});
                $('#calculate-form-popup select#shipining_service').select2({placeholder: 'Select Service'});
                $('#calculate-form-popup').addClass('unload-calculate-form-popup');
                print_country('shiping_from_country');
                print_country('shiping_to_country');
                $('.extra-services input').iCheck({
                    checkboxClass: 'icheckbox_futurico2',
                    increaseArea: '20%' // optional
                });
            }
        });
        return false;
    });
    // shipping form
    $('.modal-body2 > button').live('click', function () {
        $('#calculate-form-popup').removeClass('unload-calculate-form-popup');
        $('#calculate-form-popup').remove();
        return false;
    });
    // event image and google switch on event page
//    if ( $( ".event-page" ).length ) {
// 
//                    $(".post-thumb > span").live("click", function () {
//                    $(this).parent("div").toggleClass("slide-down");
//                    return false;
//                    });
// 
//}
});