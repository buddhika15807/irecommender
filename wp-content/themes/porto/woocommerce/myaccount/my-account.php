<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$porto_woo_version = porto_get_woo_version_number();
$con = mysqli_connect("localhost","root","","wealthpa_wp752"); 

wc_print_notices(); ?>

<p class="myaccount_user alert alert-success">
	<?php
	/*Write username on login*/
	$myfile = fopen("iRecommender-Logs/Sehan/iRecommender_Logged_User.txt", "w") or die("Unable to open file!");
	$txt = $current_user->ID;
	fwrite($myfile, (string)$txt);
	fclose($myfile);
	/*Write username on login*/

	/*Write username on login*/
	$Sql = "SELECT USER_ID, VALUE FROM wp6t_cimy_uef_data WHERE USER_ID ='".$txt."' ";
	$result = mysqli_query($con, $Sql); 

	if (mysqli_num_rows($result) > 0) {
	$kiafile = fopen("iRecommender-Logs/Kia/". $txt .".txt", "w") or die("Unable to open file!");
    while($row = mysqli_fetch_array($result)) {
       $file = fopen('iRecommender-Logs/Kia/Log.csv',"a");
        /*fputcsv($file,array_values($row));*/
        fwrite($kiafile, $row[1]);
		fclose($kiafile);
     }
} else {
     echo "you have no records";
     }
	/*Write username on login*/

	printf(
		__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
		$current_user->display_name,
        version_compare($porto_woo_version, '2.3', '<') ? wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) : wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);
	?>
</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>
