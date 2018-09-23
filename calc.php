<?php
$h = new unload_Helper();
$serviceArgs = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'posts_status' => 'publish'
);
$sQuery = new WP_Query($serviceArgs);
$opt = $h->unload_opt();
//print_r($pricecm); exit;
?>

<script type="application/javascript">
    $(document).ready(function(){
        $(":input").on('keyup mouseup change', function () {
            // $(".theme-btn").click(function(){
            var txt = "";
                if($(this).prop('checked') == true) {
                    var fprice = $('input:checkbox:checked').val();
                } else {
                    var fprice = 0;
                }
            var price = $('.pricecm').val();
            var pricekg = $('.pricekg').val();
            var weight = $('.weight').val();
            var width = $('.width').val();
            var height = $('.height').val();
            var dimension = width*height;
            var tprice = dimension*price;
            var tpricekg = weight*pricekg;
            var gtprice = parseInt(fprice) + parseInt(tprice);
            var gtpricekg = parseInt(fprice) + parseInt(tpricekg);
            var gtp = parseInt(gtprice) + parseInt(gtpricekg);
            //txt += "Feature Price: " + fprice + "</br>";
            if(pricekg != undefined && weight != undefined) {
                if (pricekg != '' && weight != '') {
                    txt += "Cost of shipping per kg: " + pricekg + "</br>";
                    txt += "<b style='color: darkgreen; font-size: 17px;'>Total Shipping Cost with Weight: " + gtpricekg + "</b ></br>";
                }
            }
            if(price != undefined && dimension != NaN) {
                if (price != '' && dimension != '') {
                    txt += "Cost of shipping per square cm: " + price + "</br>";
                    txt += "<b style='color: darkgreen; font-size: 17px;'>Total Shipping Cost with Dimension: " + gtprice + "</b ></br>";
                }
            }

            $("#div1").html(txt);
        });
    });

          // });
</script>
<div class="calculate-shipping">
    <div class="dark-title">
        <?php if (!empty($sub_title)): ?>
            <span><i class="fa fa-steam"></i><?php echo esc_html($sub_title) ?></span>
        <?php endif; ?>
        <h3><?php echo esc_html($title) ?></h3>
    </div>
    <div class="cargo-shipment">
        <div class="calculate-shipping-form">
            <div class='msg'></div>
            <form id="shipping_pkg_quote">
                <input type="hidden" name="mailid" value="<?php echo esc_attr($mailid) ?>"/>
                <div class="row"> 
                    <?php if(!($h->unload_set($opt, 'opthideservice'))): ?>
                    <div class="col-md-6">
                        <div class="select-service select-box">
                            <select id="shipining_service" name="shipining_service">
                                <option><?php esc_html_e('Select Service', 'unload') ?></option>
                                <?php
                                while ($sQuery->have_posts()) {
                                    $sQuery->the_post();
                                    echo '<option>' . get_the_title() . '</option>';
                                }
                                wp_reset_postdata();
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    endif;
                    $getfields = ($h->unload_set($opt, 'optShippingadditionalfields')) ? $h->unload_set($opt, 'optShippingadditionalfields') : '';
                    if (!empty($getfields)):
                        foreach ($getfields as $get_field):
                            if (!empty($get_field)):
                                ?>
                                <div class="col-md-6">
                                    <input id="shipping_pkg_length" name="<?php echo esc_attr(str_replace(' ', '_', $get_field)); ?>" type="text"
                                           class="text-field" placeholder="<?php echo esc_html($get_field, 'unload') ?>"/>
                                </div><?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                    <div class="col-md-6">
                        <div class="row">
                            <input type="hidden" class="pricecm" name="pricecm" value="<?php echo $pricecm; ?>">
                            <?php if(!($h->unload_set($opt, 'opthidelength'))): ?>
                            <div class="col-md-6">
                                <input id="shipping_pkg_length" name="shipping_pkg_length" type="text"
                                       class="text-field width" placeholder="<?php esc_html_e('Length (cm)', 'unload') ?>"/>
                            </div>
                            <?php endif; ?>
                            <?php if(!($h->unload_set($opt, 'opthideheight'))): ?>
                            <div class="col-md-6">
                                <input id="shipping_pkg_height" name="shipping_pkg_height" type="text"
                                       class="text-field height" placeholder="<?php esc_html_e('Height (cm)', 'unload') ?>"/>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="select-goods select-box">
                            <select onchange="print_state('shipping_from_state', this.selectedIndex);"
                                    id="shiping_from_country" name="shiping_from_country">
                                <option><?php echo esc_html__('From Country', 'unload') ?></option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="select-to select-box">
                            <select onchange="print_state('shipping_to_state', this.selectedIndex);"
                                    id="shiping_to_country" name="shiping_to_country">
                                <option><?php echo esc_html__('To Country', 'unload') ?></option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-6">
                        <div class="select-to select-box">
                            <select name="shipping_from_state" id="shipping_from_state">
                                <option><?php echo esc_html__('From State', 'unload') ?></option>
                            </select>
                        </div>
                    </div>
                   
                    
                    <div class="col-md-6">
                        <div class="select-to select-box">
                            <select name="shipping_to_state" id="shipping_to_state">
                                <option><?php echo esc_html__('To State', 'unload') ?></option>
                            </select>
                        </div>
                    </div>

                    <?php if(!($h->unload_set($opt, 'opthidewight'))): ?>
                    <div class="col-md-6">
                        <input type="hidden" class="pricekg" name="pricekg" value="<?php echo $pricekg; ?>">
                        <input type="text" id="shipping_pkg_weight" name="shipping_pkg_weight" class="text-field weight"
                               placeholder="<?php esc_html_e('Weight (kg)', 'unload') ?>"/>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <input type="text" id="shipping_email" name="shipping_email" class="text-field"
                               placeholder="<?php esc_html_e('Email', 'unload') ?>"/>
                    </div>
                    <div class="col-md-12">
                        <textarea id="shipping_full_address" name="shipping_full_address" class="text-field"
                                  placeholder="<?php esc_html_e('Receiver Full Address', 'unload') ?>"></textarea>
                    </div>
                    <?php if ($features_count > 0): ?>
                        <div class="col-md-12">
                            <div class="extra-services">
                                <h4><i class="fa fa-paper-plane"></i> <?php esc_html_e('EXTRA SERVICES', 'unload') ?>
                                </h4>
                            </div>
                                <?php
                                $counter = 0;
                                //print_r($extra_features); exit;
                                foreach ($extra_features as $f):
                                    ?>
                                    <span>
                                        <input type="checkbox" name="features[]" class="fprice"
                                               value="<?php echo esc_attr($h->unload_set($f, 'feature_price')) ?>"/>
                                        <label><?php echo esc_html($h->unload_set($f, 'feature_name')) ?>
                                            <?php if($h->unload_set($f, 'feature_price') != ''): ?>
                                            : [$<?php echo esc_html($h->unload_set($f, 'feature_price')) ?>]
                                            <?php endif; ?>
                                        </label>
                                    </span>
                                    <?php
                                    $counter++;
                                endforeach;
                                ?>

                        </div>
                    <?php endif; ?>
                    <div class="col-md-12">
                        <input type="hidden" name="shipping_submit_key" value="<?php echo wp_create_nonce(Unload_KEY); ?>">
                        <a id="shipping_submit" href="javascript:void(0)" title="" class="theme-btn"><i
                                class="fa fa-paper-plane"></i> <?php echo esc_html(($btntext) ? $btntext : esc_html__('Check Now', 'unload')) ?>
                        </a>
                        <div id="div1" style="padding: 10px; float: right;"></div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- Calculate Shipping -->
</div><!-- Cargo Shipment -->
