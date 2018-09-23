<?php
// Template Name:	Customer Order List
$h = new unload_Helper;
$h->unload_header();
$opt = $h->unload_opt();
$h->unload_headerTop(get_the_ID());
$currentUser = wp_get_current_user();
$userMail = $h->unload_set($h->unload_set($currentUser, 'data'), 'user_email');
//$userMail = 'sahill@gmail.com';
global $wpdb;
$table = $wpdb->prefix . 'postmeta';
$result = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT post_id from $table where meta_value=%s", $userMail), ARRAY_A);
$orderList = array();
if (!empty($result) && count($result) > 0) {
    foreach ($result as $row) {
        $orderList[] = $h->unload_set($row, 'post_id');
    }
}
$args = array(
    'post_type' => 'un_order',
    'post_status' => 'publish',
    'post__in' => $orderList
);
$query = new WP_Query($args);
if ($query->have_posts()) {
    ?>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-margin2">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $orderPrefix = ($h->unload_set($opt, 'optBookingOrderPrfix')) ? $h->unload_set($opt, 'optBookingOrderPrfix') : esc_html__('order', 'unload');
                            $name = $h->unload_m('metaSenderName');
                            $orderNote = $h->unload_m('metaOrderNote');
                            $date = strtotime($h->unload_m('metaOrderDate'));
                            $address = $h->unload_m('metaSenderAddress');
                            $reciverEmail = $h->unload_m('metaReciverEmail');
                            $reciverContact = $h->unload_m('metaReciverContact');
                            $toCountry = $h->unload_m('metaToCountry');
                            $toCity = $h->unload_m('metaToCity');
                            $id = str_replace($orderPrefix . '-', '', get_the_title());
                            ?>
                            <div class="profile-main">
                                <div class="profiler-info">
                                    <span>Hello!</span>
                                    <h2><a href="javascript:void(0)" title=""><?php echo esc_html($name) ?></a></h2>
                                    <p><?php echo esc_html($orderNote) ?></p>
                                    <ul class="post-meta2">
                                        <li><a href="javascript:void(0)"
                                               title=""><?php echo esc_html(date('d M, Y', $date)) ?></a></li>
                                        <li><i class="fa fa-home"></i> <?php echo esc_html($address) ?></li>
                                    </ul>
                                </div>
                                <div class="profiler-address">
                                    <ul>
                                        <li><strong><?php esc_html_e('Email Address', 'unload') ?>:</strong> <a
                                                href="javascript:void(0)"
                                                title=""><?php echo esc_html($reciverEmail) ?></a></li>
                                        <li><strong><?php esc_html_e('Phone Number', 'unload') ?>
                                                :</strong> <?php echo esc_html($reciverContact) ?></li>
                                        <li><strong><?php esc_html_e('Country Name', 'unload') ?>
                                                :</strong> <?php echo esc_html($toCountry) ?></li>
                                        <li><strong><?php esc_html_e('City Name', 'unload') ?>
                                                :</strong> <?php echo esc_html($toCity) ?></li>
                                        <li><strong><?php esc_html_e('Order ID', 'unload') ?>
                                                :</strong> <?php echo esc_html($id) ?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
get_footer();
