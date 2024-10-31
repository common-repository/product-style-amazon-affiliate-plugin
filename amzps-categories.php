<?php
//******************************************//
//* Categories Admin Page For Product Style *//
//******************************************//
function amzps_categories_page() {

global $wpdb;
$status_message = "";

$categories = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'amzps_pcat', ARRAY_A);

?>
 <style>
.product-hover {
width:100%;border-bottom:1px solid #999999;padding:5px;background-color:#CCCCCC;
}
.product-name-link-button {
background-image: url(<?php echo WP_PLUGIN_URL; ?>/product-style-amazon-affiliate-plugin/images/pencil.png) !important;background-repeat:no-repeat !important;background-position: 10px 45% !important;padding-left:18px;
}
.product-add-button {
background-image: url(<?php echo WP_PLUGIN_URL; ?>/product-style-amazon-affiliate-plugin/images/add.png) !important;
}
.product-delete-link-button {
background-image: url(<?php echo WP_PLUGIN_URL; ?>/product-style-amazon-affiliate-plugin/images/delete.png) !important;background-repeat:no-repeat !important;background-position: 10px 45% !important;padding-left:18px;
}
.fieldproduct-delete {
background-image: url(<?php echo WP_PLUGIN_URL; ?>/product-style-amazon-affiliate-plugin/images/delete.png) !important;background-repeat:no-repeat !important;background-position: 0px 45% !important;padding-left:18px;
}
.product-name-link {
font-size:16px;margin:10px;line-height:30px;
}
input.text, input.textarea { margin-bottom:12px;padding:2px;margin:5px; }
fieldset { padding:0; border:0; margin-top:25px; }
  </style>

<div class="wrap">
<?php echo amzps_admin_header_message(); ?>
<h2>Product Style - Product Information</h2>
<?php echo amzps_admin_header_menu(); ?>
<?php if ($status_message != "") { ?>
<div id="message" class="updated"><?php echo $status_message; ?></div>
<?php } ?>
Product information is created manually with the basic version of the Product Style Plugin.<br /><a href="http://stargeting.amzps.hop.clickbank.net/?tid=wpcat" target="_blank">Upgrade to Product Style Pro Here For Auto Amazon Ad Creation!</a>
<br /><br />
<div id="category-list">
<?php
	echo '<div class="new-category"><a href="#" style="background-image: url('.WP_PLUGIN_URL.'/product-style-amazon-affiliate-plugin/images/add.png);background-repeat:no-repeat;background-position: 11px 50%;padding-left:16px;">New Category</a></div>';
//	echo '<table class="widefat"><thead><tr><th>Category</th><th>Actions</th></tr></thead></table>';
	echo '<div id="category-accordion">';
	if (count($categories) > 0)
	{
		$cct = 0;
	foreach($categories as $var => $row)
	{
		echo '<h3><a href="#" id="cat-select-'.$row['pcid'].'">'.stripslashes($row['pcname']).'</a></h3>';
		echo '<div id="cat-div-'.$row['pcid'].'">';
		if ($cct == 0) amzps_products_list_categories($row['pcid']);
		echo '</div>';
		$cct++;
		//<a class="button-secondary" href="admin.php?page=amzps_products_main&p=amzps_fields&pcid='.$row['pcid'].'">Edit/Create Fields</a> <a class="button-secondary" href="admin.php?page=amzps_products_main&p=amzps_products&pcid='.$row['pcid'].'">Edit/Create Products</a> <a class="button-secondary" href="admin.php?page=amzps_products_main&p=amzps_categories&pcid='.$row['pcid'].'&action=delete">Delete Category</a></td></tr>';
	}
	} //else
	//echo "<b>You do not currently have any categories - please create at least one.</b>";
	echo "</div>";
	
	

?>
</div>
<div id="product-edit" style="display:none;" title="Product Information"></div>
<div id="category-create" style="display:none;" title="Create New Category">
<form>
<fieldset>
	<label for="pcname">Category Name</label>
	<input type="text" name="pcname" id="pcname" value="" size="32"  class="text ui-widget-content ui-corner-all" />
	<p id="catNameError" class="ui-state-error" style="display:none;">*You must enter a Category Name</p>
</fieldset>
</form>
</div>

<div id="delete-field" style="display:none;" title="Confirm Delete Field?">
<form>
<b>This will permanently DELETE this field from this product and ALL other products in this category!<br /><br >Are you sure you want to delete this field?</b>
</form>
</div>

<div id="delete-product" style="display:none;" title="Confirm Delete Product?">
<form>
<b>This will permanently DELETE this product!<br /><br >Are you sure you want to delete this product?</b>
</form>
</div>


</div>
<?php
}
function amzps_products_delete_product()
{
	global $wpdb;
	$tmpid = explode("-", $_POST['ppid']);
	$ppid = (int) $tmpid[1];
	$pcid = (int) $tmpid[0];
	if ($ppid > 0)
		$wpdb->query($wpdb->prepare('DELETE FROM '.$wpdb->prefix.'amzps_pprod where ppid = %d limit 1', $ppid));
	die();
}
function amzps_products_delete_field()
{
	global $wpdb;
	$pfid = (int) $_POST['pfid'];
	if ($pfid > 0)
		$wpdb->query($wpdb->prepare('DELETE FROM '.$wpdb->prefix.'amzps_pfield where pfid = %d limit 1', $pfid));
	die();
}
function amzps_products_create_category()
{
	global $wpdb;
	$pcname = $_POST['pcname'];
	$table_name = $wpdb->prefix.'amzps_pcat';
	$wpdb->insert( $table_name, array( 'pcname' => $pcname), array( '%s' ) );
	$pcid = $wpdb->insert_id;
	echo '<h3><a href="#" id="cat-select-'.$pcid.'">'.stripslashes($pcname).'</a></h3>';
	echo '<div id="cat-div-'.$pcid.'"></div>';
	die();
}
function amzps_products_create_field()
{
	global $wpdb;
	$pcid = $_POST['pcid'];
	$pftype = 0;
	$pfname = "New Field";
	$pfsort = 100;
	
	$wpdb->insert( $wpdb->prefix.'amzps_pfield', array( 'pcid' => $pcid, 'pfname' => $pfname, 'pftype' => $pftype, 'pfsort' => $pfsort), array( '%d', '%s', '%d', '%d' ) );
	$tpfid = $wpdb->insert_id;
	
	echo '<li id="fieldproduct-'.$tpfid.'" class="fieldproduct-name fieldproduct-'.$tpfid.'">';
	echo '<label for="ppfields['.$tpfid.']"><input type="hidden" class="fieldid" name="fieldidlist" value="'.$tpfid.'" /><a href="#" class="fieldproduct-delete"></a><input type="text" class="fieldname text ui-widget-content ui-corner-all" name="ppfieldname['.$tpfid.']" value="'.$pfname.'" size="24" />:</label>';
	
	echo '<input type="text" class="fielddata text ui-widget-content ui-corner-all" name="ppfields['.$tpfid.']" value="" size="48" class="text ui-widget-content ui-corner-all" />';
	//echo '</div><div style="clear:both;"></div></li>';
	echo '</li>';
	die();
}

function amzps_products_single_product($pcid, $ppid, $ppname)
{
echo '<li id="product-'.$pcid.'-'.$ppid.'" class="product-name product-hover"><a href="#" class="product-name-link">'.stripslashes($ppname).'</a><div id="pdctdiv-'.$pcid.'-'.$ppid.'" style="width:200px;text-align:center;float:right;margin-right:20px;"><a href="#" class="product-name-link-button" title="Edit Product">Edit</a><a href="#" class="product-delete-link-button" title="Delete Product">Delete</a></div><div style="clear:both;"></div></li>';

}


function amzps_products_list_categories($pcid = "") 
{ 
	global $wpdb;
	$pcid_source = "internal";
	if ($pcid == ""){
		$pcid = (int) $_POST['catID'];
		$pcid_source = "external";
	}
	if ($pcid > 0)
	{
		echo '<ul id="product-list-'.$pcid.'">';
		echo '<li id="product-'.$pcid.'-0" class="product-name"><a href="#" class="product-name-link-button product-add-button">New Product</a></li>';
		$products = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'amzps_pprod where pcid = %d', $pcid), ARRAY_A);
		if (count($products) > 0)
		{

			foreach($products as $var => $row)
			{
				amzps_products_single_product($pcid, $row['ppid'], $row['ppname']);
				//<tr><td>'.stripslashes($row['ppname']).'</td><td><a class="button-secondary" href="admin.php?page=amzps_products_main&p=amzps_products&pcid='.$pcid.'&ppid='.$row['ppid'].'&action=edit">Edit Product</a> <a class="button-secondary" href="admin.php?page=amzps_products_main&p=amzps_products&pcid='.$pcid.'&ppid='.$row['ppid'].'&action=delete">Delete Product</a></td></tr>';
			}
			
			
		}
		echo '</ul>';
		if ($pcid_source == "external") die();
	}else{
		if ($pcid_source == "external") die();
	}


}

function amzps_products_edit_products()
{
	global $wpdb;
	$tmpid = explode("-", $_POST['ppid']);
	$ppid = (int) $tmpid[1];
	$pcid = (int) $tmpid[0];
	if ($pcid > 0)
	{
		$fields = $wpdb->get_results($wpdb->prepare('SELECT pfid, pfname, pftype FROM '.$wpdb->prefix.'amzps_pfield where pcid = %d ORDER BY pfsort ASC, pfid ASC', $pcid), ARRAY_A);
		if ($ppid > 0)
		{
			$product_info = $wpdb->get_row($wpdb->prepare("SELECT ppid, ppname, ppfields FROM ".$wpdb->prefix."amzps_pprod where ppid = %d", $ppid), ARRAY_A);
			$ppfields_tmp = explode("|||", $product_info['ppfields']);
			$a = 0;
			$ppfields = array();
			$num_to_set = "";
			foreach ($ppfields_tmp as $var => $val)
			{
				$a++;
				if ($a == 1 && trim($val) != "")
				{
					$ppfields[$val] = "";
					$num_to_set = $val;
				}
				if ($a == 2)
				{
					$a = 0;
					$ppfields[$num_to_set] = $val;
					$num_to_set = "";
				}
			}
		}else
			$ppid = "New";
			
		?>
		<form id="productForm">
		<u><b><?php if ($ppid != "New") { ?>Editing Product #<?php echo $product_info['ppid'].': '.stripslashes($product_info['ppname']); }else{ echo 'Create New Product'; } ?></b></u>
		<fieldset>
		<label for="ppname">
		Product Name:
		</label>
		
		<input type="text" id="ppname" name="ppname" value="<?php echo htmlspecialchars(stripslashes($product_info['ppname'])); ?>"  class="text ui-widget-content ui-corner-all" />
		<p id="ppnameError" class="ui-state-error" style="display:none;">*You must enter a Product Name</p>
		<div id="product_field_list_container">

				<?php
					echo '<ul class="productfields_list" id="productfield_list">';
					if (count($fields) > 0)
					{
						foreach ($fields as $var => $row)
						{	
							$tpfid = $row['pfid'];
							echo '<li id="fieldproduct-'.$tpfid.'" class="fieldproduct-name fieldproduct-'.$tpfid.'">';
							echo '<label for="ppfields['.$tpfid.']"><input type="hidden" class="fieldid" name="fieldidlist" value="'.$tpfid.'" /><a href="#" class="fieldproduct-delete"></a><input type="text" class="fieldname text ui-widget-content ui-corner-all" name="ppfieldname['.$tpfid.']" value="'.stripslashes($row['pfname']).'" size="24" />:</label>';
							//echo '<div style="width:350px;margin:0px;padding:5px;">';
							if ($row['pftype'] == 0)
								echo '<input type="text" class="fielddata text ui-widget-content ui-corner-all" name="ppfields['.$tpfid.']" value="'.htmlspecialchars(stripslashes($ppfields[$tpfid])).'" size="48" />';
							if ($row['pftype'] == 1)
								echo '<textarea class="fielddata textarea ui-widget-content ui-corner-all" name="ppfields['.$tpfid.']" rows="6" cols="48">'.stripslashes($ppfields[$tpfid]).'</textarea>';
							//echo '</div><div style="clear:both;"></div></li>';
							echo '</li>';
						}
					}
					echo '</ul>';
					echo '<ul class="productfields_list" id="productfield_new"><li id="fieldproduct-new-'.$pcid.'" class="fieldproduct-name-new">';
					echo '<a href="#" style="background-image: url('.WP_PLUGIN_URL.'/product-style-amazon-affiliate-plugin/images/add.png);background-repeat:no-repeat;background-position: 10px 45%;padding-left:18px;">New Field</a></li></ul>';
					
				?>
				
		</div>
		<input type="hidden" name="pcid" id="pcid" value="<?php echo $pcid; ?>" />
		<?php if ($ppid != "New") { ?>
		<input type="hidden" name="ppid" id="ppid" value="<?php echo $ppid; ?>" />
		<input type="hidden" name="edit-product" id="productState" value="edit" />
		<?php }else{ ?>
		<input type="hidden" name="edit-product" id="productState" value="new" />
		<?php } ?>
		</fieldset>
		</form>
		<?php
		die();
	}else
		die();



}

function amzps_save_product()
{
	global $wpdb;
	if ($_POST['action'] != "amzps_save_product") exit;
	$ppid = (int) $_POST['ppid'];
	$pcid = (int) $_POST['pcid'];
	$ppname = $_POST['ppname'];
	$pState = $_POST['productState'];
	
	// Process Field Names, Orders & New Fields
	$fID = $_POST['fieldidData'];
	$fName = $_POST['fieldData'];
	$fInfo = $_POST['adData'];
	
	$tfid = explode(",", $fID);
	$tfname = explode(",,,", $fName);
	$tfinfo = explode(",,,", $fInfo);
	
	$tct = count($tfid) - 1;
	
	$ppfields = "";
	
	
	for ($a = 0; $a <= $tct; $a++)
	{
		$tfinfo_ct = strlen($tfinfo[$a]);
		$tfinfo_type = 0;
		if ($tfinfo_ct > 36)
			$tfinfo_type = 1;
		
		$tf_sort = $a * 5;
		
		if ($tfid[$a] > 0)
			$wpdb->update( $wpdb->prefix.'amzps_pfield', array( 'pcid' => $pcid, 'pfname' => $tfname[$a], 'pftype' => $tfinfo_type, 'pfsort' => $tf_sort), array( 'pfid' => $tfid[$a] ), array( '%d', '%s', '%d', '%d' ), array( '%d') );
		//else{
		//	$wpdb->insert( $wpdb->prefix.'amzps_pfield', array( 'pcid' => $pcid, 'pfname' => $tfname[$a], 'pftype' => $tfinfo_type, 'pfsort' => $tf_sort), array( '%d', '%s', '%d', '%d' ) );
		//	$tfid[$a] = $wpdb->insert_id;
		//}
		
		if ($tfid[$a] > 0 && $tfinfo[$a] != "")
			$ppfields .= $tfid[$a]."|||".$tfinfo[$a];
			
		if ($a != $tct) $ppfields .= "|||";
	}
	
	if ($pState == "new")
	{
		$wpdb->insert( $wpdb->prefix.'amzps_pprod', array( 'pcid' => $pcid, 'ppname' => $ppname, 'ppfields' => $ppfields), array( '%d', '%s', '%s' ) );
		$ppid = $wpdb->insert_id;
	}else
		$wpdb->update( $wpdb->prefix.'amzps_pprod', array( 'pcid' => $pcid, 'ppname' => $ppname, 'ppfields' => $ppfields), array( 'ppid' => $ppid ), array( '%d', '%s', '%s' ), array( '%d') );
	

	amzps_products_single_product($pcid, $ppid, $ppname);
	
	die();
}



?>