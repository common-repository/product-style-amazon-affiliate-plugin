<?php
//**********************************************//
//* Advertisements Admin Page For Product Style *//
//**********************************************//
function amzps_ads_page() {

global $wpdb;
$status_message = "";
$page_status = 1;

if (isset($_GET['paid']))
	$paid = (int) $_GET['paid'];
if (isset($_POST['paid']))
	$paid = (int) $_POST['paid'];
	
	
	
if (isset($_GET['action']))
{

	if ($_GET['action'] == "edit" && isset($paid))
		$page_status = 2;
		
	if ($_GET['action'] == "delete" && isset($paid))
	{
		if ($wpdb->query($wpdb->prepare('DELETE FROM '.$wpdb->prefix.'amzps_padv where paid = %d', $paid)) == 1)
			$status_message = "The advertisement was deleted successfully.";
		else
			$status_message = "There was a problem deleting the advertisement - please try again.";
		
	}

}
if (isset($_POST['paname']) && isset($_POST['new-ad']))
{
	if (trim($_POST['paname']) != "")
	{
		$paid = (int) $_POST['paid'];
		$page_status = 1;
		
		if ($wpdb->insert( $wpdb->prefix.'amzps_padv', array( 'psid' => $_POST['psid'], 'ppid' => $_POST['ppid'], 'pasid' => 0, 'paname' => $_POST['paname'], 'paasin' => $_POST['paasin'], 'patype' => 0, 'patitletype' => $_POST['patitletype'], 'patitle1' => $_POST['patitle1'], 'patitle2' => $_POST['patitle2'], 'patarget' => $_POST['patarget']), array( '%d', '%d', '%d', '%s', '%s', '%d', '%d', '%s', '%s', '%d' ) ))
			$status_message = 'New advertisement, '.stripslashes($_POST['paname']).', has been created.';
		else
			$status_message = 'There was a problem creating your new advertisement in the database - please try again.';
	}else
		$status_message = 'Your new advertisement was not created - please enter a name for the advertisement.';
}
if (isset($_POST['paname']) && isset($_POST['edit-ad']) && isset($paid))
{
	if (trim($_POST['paname']) != "")
	{
		$paid = (int) $_POST['paid'];
		$page_status = 1;
		
		
		if ($wpdb->update( $wpdb->prefix.'amzps_padv', array( 'psid' => $_POST['psid'], 'ppid' => $_POST['ppid'], 'pasid' => 0, 'paname' => $_POST['paname'], 'paasin' => $_POST['paasin'], 'patype' => 0, 'patitletype' => $_POST['patitletype'], 'patitle1' => $_POST['patitle1'], 'patitle2' => $_POST['patitle2'], 'patarget' => $_POST['patarget']), array( 'paid' => $paid ),  array( '%d', '%d', '%d', '%s', '%s', '%d', '%d', '%s', '%s', '%d' ), array( '%d') ))
			$status_message = 'The advertisement, '.stripslashes($_POST['paname']).', has been edited successfully.';
		else
			$status_message = 'There was a problem editing your advertisement in the database - please try again.';
	}else
		$status_message = 'Your advertisement was not edited - you must enter a name for the advertisement.';
}


$styles = $wpdb->get_results('SELECT psid,psname FROM '.$wpdb->prefix.'amzps_pstyle order by psname DESC', ARRAY_A);
$products = $wpdb->get_results('SELECT ppid,pcid,ppname FROM '.$wpdb->prefix.'amzps_pprod order by pcid ASC, ppname DESC', ARRAY_A);

$sites = array();
$sites[0] = "Amazon";

if ($page_status == 1)	
	$ads = $wpdb->get_results('SELECT paid, pasid, paname, paasin, patype FROM '.$wpdb->prefix.'amzps_padv', ARRAY_A);


if ($page_status == 2){
	$ad_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."amzps_padv where paid = %d",$paid), ARRAY_A);
	$ads = $wpdb->get_results('SELECT paid, paname FROM '.$wpdb->prefix.'amzps_padv', ARRAY_A);
	}

?>
<div class="wrap">
<?php echo amzps_admin_header_message(); ?>
<h2>Product Style - Advertisements</h2>
<?php echo amzps_admin_header_menu(); ?>
<?php if ($status_message != "") { ?>
<div id="message" class="updated"><?php echo $status_message; ?></div>
<?php } ?>
Advertisements are the last step to get your Amazon ads running on your site. You will need the Amazon product ID (ASIN) to create an ad using a product and style that you have previously created. <br /><br />Product Style Pro allows ads to be created automatically with it's powerful Auto Amazon features.
<br /><br />

<?php
if ($page_status == 1)
{
?>
<?php
if (count($ads) > 0)
{

	echo '<table class="widefat"><thead><tr><th>Ad Name</th><th>ASIN</th><th>Ad Type</th><th>Ad Site</th><th>Actions</th></tr></thead><tfoot><tr><th>Ad Name</th><th>ASIN</th><th>Ad Type</th><th>Ad Site</th><th>Actions</th></tr></tfoot><tbody>';
	foreach($ads as $var => $row)
	{
		echo '<tr><td>#'.$row['paid'].' - '.stripslashes($row['paname']).'</td><td>'.$row['paasin'].'</td><td>';
		
			echo "Enhanced";
		
		echo '</td><td>';
		$tmp_site_id = $row['pasid'];
		echo $sites[$tmp_site_id].'</td><td>';
		echo '<a class="button-secondary" href="admin.php?page=amzps_ads&paid='.$row['paid'].'&action=edit">Edit Ad</a> <a class="button-secondary" href="admin.php?page=amzps_ads&paid='.$row['paid'].'&action=delete">Delete Ad</a></td></tr6>';
	}
	echo "</tbody></table>";
	
}else
	echo "<b>You do not currently have any ads.</b>";
?><br /><br />
<table class="widefat" style="width:600px !important;"><thead><tr><th colspan="2">Create New Advertisement</th></tr></thead><tbody>

<form method="post" action="admin.php?page=amzps_ads">

<tr><th scope="row">
New Ad Name</th>
        <td align="right"><input type="text" name="paname" value="" size="32" /></td>
        </tr>
		<tr><th scope="row">
Product ASIN / ID</th>
        <td align="right"><input type="text" name="paasin" value="" size="12" /></td>
        </tr>
		<tr><th scope="row">
Ad Site</th>
        <td align="right"><select name="pasid">
		<?php
		$site_option_string = "";
		if (count($sites) > 0)
		{
			foreach ($sites as $var => $row)
			{
				$site_option_string .= '<option value="'.$var.'">'.$row;
			}
		}
		echo $site_option_string;
		?>
		</select></td>
        </tr>

		<tr><th scope="row">
Style</th>
        <td align="right"><select name="psid">
		<?php
		foreach ($styles as $var => $sarr)
		{
			echo '<option value="'.$sarr['psid'].'">'.stripslashes($sarr['psname']);
		}
		?>
		</select></td>
        </tr>
		<tr><th scope="row">
Product</th>
        <td align="right"><select name="ppid">
		<?php
		foreach ($products as $var => $parr)
		{
			echo '<option value="'.$parr['ppid'].'">'.stripslashes($parr['ppname']);
		}
		?>
		</select></td>
        </tr>

		<tr><th scope="row">
Header Titles</th>
        <td align="right"><select name="patitletype">
		<option value="0">Single<option value="1">Double
		</select></td>
        </tr>
		<tr><th scope="row">
Header Title #1</th>
        <td align="right"><input type="text" name="patitle1" value="" size="64" /></td>
        </tr>
		<tr><th scope="row">
Header Title #2<br />(Double Titles Only)</th>
        <td align="right"><input type="text" name="patitle2" value="" size="64" /></td>
        </tr>
		<tr><th scope="row">
Open Links In New Window</th>
        <td align="right"><select name="patarget">
		<option value="0">Yes<option value="1">No
		</select></td>
        </tr>

	</tbody>
	<tfoot><tr><th colspan="2" style="text-align: center !important;">

<input type="hidden" name="new-ad" value="1" />
<input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Create New Ad') ?>" />
</th></tr></tfoot></table></form>

<?php
}
if ($page_status == 2)
{
?><br /><br />
<table class="widefat" style="width:600px !important;"><thead><tr><th colspan="2">Edit Advertisement #<?php echo $ad_info['paid'].': '.stripslashes($ad_info['paname']); ?></th></tr></thead><tbody>

<form method="post" action="admin.php?page=amzps_ads">

<tr><th scope="row">
Ad Name</th>
        <td align="right"><input type="text" name="paname" value="<?php echo htmlspecialchars(stripslashes($ad_info['paname'])); ?>" size="32" /></td>
        </tr>
		<tr><th scope="row">
Product ASIN / ID</th>
        <td align="right"><input type="text" name="paasin" value="<?php echo $ad_info['paasin']; ?>" size="12" /></td>
        </tr>
		
		<tr><th scope="row">
Ad Site</th>
        <td align="right"><select name="pasid">
		<?php
		$site_option_string = "";
		if (count($sites) > 0)
		{
			foreach ($sites as $var => $row)
			{
				$site_option_string .= '<option value="'.$var.'"';
				if ($ad_info['pasid'] == $var) $site_option_string .= ' selected';
				$site_option_string .= '>'.stripslashes($row);
			}
		}
		echo $site_option_string;
		?>
		</select></td>
        </tr>
					
	
		
		<tr><th scope="row">
Style</th>
        <td align="right"><select name="psid">
		<?php
		foreach ($styles as $var => $sarr)
		{
			echo '<option value="'.$sarr['psid'].'"';
			if ($ad_info['psid'] == $sarr['psid']) echo " selected"; 
			echo '>'.stripslashes($sarr['psname']);
		}
		?>
		</select></td>
        </tr>
		<tr><th scope="row">
Product</th>
        <td align="right"><select name="ppid">
		<?php
		foreach ($products as $var => $parr)
		{
			echo '<option value="'.$parr['ppid'].'"';
			if ($ad_info['ppid'] == $parr['ppid']) echo " selected"; 
			echo '>'.stripslashes($parr['ppname']);
		}
		?>
		</select></td>
        </tr>
		<tr><th scope="row">
Header Titles</th>
        <td align="right"><select name="patitletype">
		<option value="0"<?php if ($ad_info['patitletype'] == 0) echo " selected";?>>Single<option value="1"<?php if ($ad_info['patitletype'] == 1) echo " selected";?>>Double
		</select></td>
        </tr>
		<tr><th scope="row">
Header Title #1</th>
        <td align="right"><input type="text" name="patitle1" value="<?php echo htmlspecialchars(stripslashes($ad_info['patitle1'])); ?>" size="64" /></td>
        </tr>
		<tr><th scope="row">
Header Title #2<br />(Double Titles Only)</th>
        <td align="right"><input type="text" name="patitle2" value="<?php echo htmlspecialchars(stripslashes($ad_info['patitle2'])); ?>" size="64" /></td>
        </tr>
		<tr><th scope="row">
Open Links In New Window</th>
        <td align="right"><select name="patarget">
		<option value="0"<?php if ($ad_info['patarget'] == 0) echo " selected";?>>Yes<option value="1"<?php if ($ad_info['patarget'] == 1) echo " selected";?>>No
		</select></td>
        </tr>

    </tbody>
	<tfoot><tr><th colspan="2" style="text-align: center !important;">

<input type="hidden" name="paid" value="<?php echo $paid; ?>" />
<input type="hidden" name="edit-ad" value="1" />
<input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Save Ad Changes') ?>" />
</th></tr></tfoot></table></form>

<? } ?>

</div>
<?php
}
?>