<?php
// Template Name:	Contact Us
(new unload_Helper())->unload_header();
$opt = (new unload_Helper())->unload_opt();
(new unload_Helper())->unload_headerTop(get_the_ID());
$h = new unload_Helper();
$map = $h->unload_set($opt, 'optContactMap');
$col = ($h->unload_set($opt, 'optOfficeInfo') == '1') ? 'col-md-8' : 'col-md-12';
$bg = $h->unload_set($opt, 'optOfficeInfoBg');?>
<?php unload_Media::unload_singleton()->unload_eq(array('map'));?>
  <script type="text/javascript"> 
    var locations = [
      [ -33.890542, 151.274856, 4],
      [ -33.923036, 151.259052, 5],
      [ -34.028249, 151.157507, 3],
      [ -33.80010128657071, 151.28747820854187, 2],
      [ -33.950198, 151.259302, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map-canvas'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
    <?php
if (!empty($map)):
    unload_Media::unload_singleton()->unload_eq(array('map'));
    $latlong = explode(',', $map);
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 column">
                    <div class="map">
                        <div id="map-canvas"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php ob_start(); ?>
    jQuery(document).ready(function ($) {
    "use strict";

    //** Map **//
    function initialize() {
    var myLatlng=new google.maps.LatLng(<?php echo esc_js($h->unload_set($latlong, '0')) ?>, <?php echo esc_js($h->unload_set($latlong, '1')) ?>);
    var mapOptions={
    zoom: 14,
    disableDefaultUI: true,
    scrollwheel: false,
    center: myLatlng
    }
    var map=new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var image='<?php echo esc_url(unload_Uri) ?>partial/images/icon.png';
    var myLatLng=new google.maps.LatLng(<?php echo esc_js($h->unload_set($latlong, '0')) ?>, <?php echo esc_js($h->unload_set($latlong, '1')) ?>);
    var beachMarker=new google.maps.Marker({
    position: myLatLng,
    map: map,
    icon: image
    });

    }
    google.maps.event.addDomListener(window, 'load', initialize);

    });
    <?php
    $jsOutput = ob_get_contents();
    ob_end_clean();
    wp_add_inline_script('unload-map', $jsOutput);
endif;
?>
    <section class="block block remove-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="row">
                            <?php if ($col == 'col-md-8'): ?>
                                <div class="col-md-4">
                                    <div class="region-contact-info team-detail-info"
                                         style="background: url(<?php echo esc_url($h->unload_set($bg, 'url')) ?>)">
                                        <div class="heading2">
                                            <span><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoSubTitle')) ?> </span>
                                            <h3><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoTitle')) ?> </h3>
                                        </div>
                                        <?php if ($h->unload_set($opt, 'optOfficeInfoAddress') != ''): ?>
                                            <p><?php echo $h->unload_set($opt, 'optOfficeInfoAddress') ?> </p>
                                        <?php endif; ?>
                                        <div class="contact-detail">
                                            <?php if (count($h->unload_set($opt, 'optOfficeInfoAddress')) > 0): ?>
                                                <span class="contact">
												<i class="fa fa-mobile"> </i>
												<strong><?php esc_html_e('Phone No', 'unload') ?> </strong>
                                                    <?php
                                                    foreach ($h->unload_set($opt, 'optOfficeInfoContact') as $c):
                                                        echo '<span>' . $c . '</span>';
                                                        ?>
                                                    <?php endforeach; ?>
											</span>
                                            <?php endif; ?>
                                            <?php if ($h->unload_set($opt, 'optOfficeInfoEmail') != ''): ?>
                                                <span class="contact">
												<i class="fa fa-envelope"> </i>
												<strong><?php esc_html_e('Email Address', 'unload') ?> </strong>
												<span><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoEmail')) ?> </span>
											</span>
                                            <?php endif; ?>
                                            <?php if ($h->unload_set($opt, 'optOfficeInfoTiming') != ''): ?>
                                                <span class="contact">
												<i class="fa fa-clock-o"> </i>
												<strong><?php esc_html_e('Office Timing', 'unload') ?> </strong>
												<span><?php echo esc_html($h->unload_set($opt, 'optOfficeInfoTiming')) ?> </span>
											</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="<?php echo esc_attr($col) ?>">
                                <div class="get-quote-form contact-info-form">
                                    <div class="heading2">
                                        <h3><?php esc_html_e('GET IN TOUCH', 'unload') ?> </h3>
                                    </div>
                                    <p><?php esc_html_e('Fill The Form Bellow. And Get In Touch Immediately', 'unload') ?> </p>
                                    <div style="float:left;width: 100%"></div>
                                    <form id="contactform" class="contactform">
                                        <div class="row">
                                            <input type="hidden" name="receiver"
                                                   value="<?php echo esc_attr($h->unload_set($opt, 'optContactMail')) ?>">
                                            <div class="col-md-12">
                                                <input type="text"
                                                       placeholder="<?php esc_html_e('Complete Name', 'unload') ?>"
                                                       class="text-field input-style" id="complete-name"
                                                       name="complete_name"/>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email"
                                                       placeholder="<?php esc_html_e('Email Address', 'unload') ?>"
                                                       id="email-address" name="email_address"
                                                       class="text-field input-style"/>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text"
                                                       placeholder="<?php esc_html_e('Subject', 'unload') ?>"
                                                       name="subject" class="text-field input-style"/>
                                            </div>
                                            <div class="col-md-12">
                                                <textarea placeholder="<?php esc_html_e('Description', 'unload') ?>"
                                                          class="text-field input-style" id="description"
                                                          name="description"> </textarea>
                                            </div>
                                             <input type="hidden" name="contactform_key" value="<?php echo wp_create_nonce(Unload_KEY); ?>">
                                            <div class="col-md-12">
                                                <button id="quote-btn" title="" itemprop="url" type="button"
                                                        class="theme-btn"><i
                                                        class="fa fa-paper-plane"> </i><?php esc_html_e('Contact Now', 'unload') ?>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
