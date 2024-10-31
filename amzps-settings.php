<?php
// create custom plugin settings menu
add_action('admin_menu', 'amzps_create_menu');

function amzps_check_updates() {
		return FALSE;
}

function amzps_create_menu() {
	global $menu, $submenu;
	//create new top-level menu
	
	//if (amzps_check_updates())
	//	$amzps_menu = add_menu_page('Product Style', 'Product Style', 'publish_posts', 'amzps', 'amzps_main_page',plugins_url('/images/photo_update.png', __FILE__)); 
	//else
		add_menu_page('Product Style', 'Product Style', 'publish_posts', 'amzps', 'amzps_main_page',plugins_url('/images/photo.png', __FILE__)); 
	
	add_submenu_page('amzps', 'Associates ID', 'Settings', 'publish_posts', 'amzps_settings', 'amzps_settings_page', 1); 
	$prod_page = add_submenu_page('amzps', 'Products', 'Products', 'publish_posts', 'amzps_products_main', 'amzps_products_main', 2);
	add_action("admin_print_scripts-".$prod_page, 'amzps_product_list_scripts');
	add_action("admin_print_styles-".$prod_page, 'amzps_product_list_styles');
	add_submenu_page('amzps', 'Product Display Styles', 'Styles', 'publish_posts', 'amzps_styles', 'amzps_styles_page', 3);
	add_submenu_page('amzps', 'Advertisements', 'Ads', 'publish_posts', 'amzps_ads', 'amzps_ads_page', 4);
	$help_page = add_submenu_page('amzps', 'Plugin Help', 'Plugin Help', 'publish_posts', 'amzps_help', 'amzps_help_page', 5);
	add_action("admin_print_scripts-".$help_page, 'amzps_help_list_scripts');
	add_action("admin_print_styles-".$help_page, 'amzps_help_list_styles');
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'amzps_settings_group', 'amzps_assoc_default' );
	register_setting( 'amzps_settings_group', 'amzps_assoc_id' );
	register_setting( 'amzps_settings_group', 'amzps_cb_assoc_id' );
	register_setting( 'amzps_settings_group', 'amzps_footer_link' );
}

function amzps_admin_header_menu() {
	global $amzps_key;
	//amzps_update($amzps_key);
	//if (amzps_check_updates())
	//	$header_menu = '<a href="admin.php?page=amzps"><img src="'.plugins_url('/images/update.png', __FILE__).'" border="0">Product Style Info</a> |';
	//else
		$header_menu = '<a href="admin.php?page=amzps">Product Style Info</a> |';
	$header_menu .= '<a href="admin.php?page=amzps_settings">Settings</a> |';	
	$header_menu .= '<a href="admin.php?page=amzps_products_main">Products</a> |';	
	$header_menu .= '<a href="admin.php?page=amzps_styles">Styles</a> |';	
	$header_menu .= '<a href="admin.php?page=amzps_ads">Ads</a> |';
	$header_menu .= '<a href="admin.php?page=amzps_help">HELP</a>';
	$header_menu .= '<br /><br />';
	
	return $header_menu;

}

//***************************************************************************//
//* Handler Fuction for Category, Product and Field Pages For Product Style *//
//***************************************************************************//
function amzps_products_main() {
	if (isset($_GET['p']) && $_GET['p'] != "")
	{
		$p = $_GET['p'];
		if ($p == "amzps_fields")
		{
			amzps_fields_page();
			exit;
		}
		if ($p == "amzps_categories")
		{
			amzps_categories_page();
			exit;
		}
		if ($p == "amzps_products")
		{
			amzps_products_page();
			exit;
		}
	
	}

	amzps_categories_page();
	exit;

}
function amzps_admin_header_message() {
	$message = '<div style="width:325px;float:right;border-top:1px dashed #000000;border-left:1px dashed #000000;border-right:1px dashed #000000;margin:8px;background-color:#FFFFFF;margin-bottom:25px;">
<div style="padding:10px;background-color:#999999;font-size:18px;font-weight:bold;color:#802222;">Product Style Info</div>
<div style="padding:20px;background-color:#FFFFFF;border-bottom:1px dashed #000000;">
Hi, my name is <b>Ryan Stevenson</b>, developer of Product Style.<br /><br />
Thanks for trying the free version of the Product Style plugin!<br /><br />
This free version is completely functional without limits of any kind, so I hope you enjoy it and find it useful.
<br /><br />
Did you know there is also a commercial (one-time fee) version of the Product Style plugin that offers even more power and features to Amazon affiliates?
<br /><br /><center>
<a href="http://stargeting.amzps.hop.clickbank.net/?tid=wptop" title="Buy Product Style 2 Here" target="_blank" style="font-weight:bold;font-size:18px;">Learn more about Product Style 2 commercial version here.</a></center></div></div>';
	return $message;
}


//**********************************//
//* Settings Page For Product Style *//
//**********************************//
function amzps_settings_page() {


if (isset($_GET['updated']))
{
if ($_GET['updated'] == "true")
{
?>
<div id="message" class="updated">
<p>Your Product Style Settings have been saved.</p>
</div>
<?php } } ?>

<div class="wrap">
<?php echo amzps_admin_header_message(); ?>
<h2>Product Style - Associates ID Settings</h2>
<?php echo amzps_admin_header_menu(); ?>
Please enter your Associate ID for Amazon.com.<br /><br />
You can also optionally choose to promote the Commercial Version of the Product Style Plugin on your site (disabled by default). If you enter your ClickBank affiliate ID and enable that promotional link, you will earn 70% commissions on any sales you refer from your site!<br /><br />
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
    <?php settings_fields( 'amzps_settings_group' ); ?>
    <table class="widefat"> <thead>     <tr>
        <th>Amazon Site</th><th>Associate ID</th></tr></thead>
		<tbody>
		<tr><td>Amazon.com (USA & Worldwide)</td><td><input type="text" name="amzps_assoc_id" value="<?php echo get_option('amzps_assoc_id'); ?>" size="16" /></td>
        </tr>
		
		</tbody>
	<tfoot><tr><th colspan="5" style="text-align: center !important;">
    <input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Save Changes') ?>" />
    </th></tr></tfoot></table><br /><br /><br />
    
	<table class="widefat" style="width:450px !important;"><thead><tr><th colspan="2">Promote Product Style Plugin (optional)</th></tr></thead><tbody>
		<tr>
        <th scope="row">Clickbank ID</th>
		<td><input type="text" name="amzps_cb_assoc_id" value="<?php echo get_option('amzps_cb_assoc_id'); ?>" size="16" /></td></tr>
		<tr>
        <th scope="row">Promote Plugin With Footer Link? (Enter Clickbank ID For Commissions)</th>
		<td><select name="amzps_footer_link"><option value="0"<?php if (get_option('amzps_footer_link') == "0") echo " selected"; ?>>No<option value="1"<?php if (get_option('amzps_footer_link') == "1") echo " selected"; ?>>Yes</select></td></tr>
		</tbody>
	<tfoot><tr><th colspan="2" style="text-align: center !important;">
    <input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Save Changes') ?>" />
    </th></tr></tfoot></table>
	

</form>
</div>
<?php
 } 
?>