<?php
//**************************************//
//* Styles Admin Page For Product Style *//
//**************************************//
			function style_input($style_name, $style_arr)
			{
				$to_show = "";
				$to_show .= '<tr><th scope="row">'.$style_arr['name'].'</th><td align="right">';
				$to_show .= '<input type="text" name="'.$style_name.'" value="" size="'.$style_arr['limit'].'" maxlength="'.$style_arr['limit'].'" />';
				$to_show .= '</td></tr>';
				return $to_show;
			}
			function style_select($style_name, $style_arr, $options_arr)
			{
			
				$to_show = "";
				$to_show .= '<tr><th scope="row">'.$style_arr['name'].'</th><td align="right">';
				$to_show .= '<select name="'.$style_name.'">';
				if (count($options_arr) > 0)
				{
					foreach($options_arr as $var => $arr)
					{
						$to_show .= '<option value="'.$arr[0].'">'.$arr[1];
					}
				}
				$to_show .= '</select></td></tr>';
				return $to_show;
			
			}
					function style_input2($style_name, $style_arr, $style_value)
			{
				$to_show = "";
				$to_show .= '<tr><th scope="row">'.$style_arr['name'].'</th><td align="right">';
				$to_show .= '<input type="text" name="'.$style_name.'" value="'.htmlspecialchars(stripslashes($style_value)).'" size="'.$style_arr['limit'].'" maxlength="'.$style_arr['limit'].'" />';
				$to_show .= '</td></tr>';
				return $to_show;
			}
			function style_select2($style_name, $style_arr, $options_arr, $style_value)
			{
			
				$to_show = "";
				$to_show .= '<tr><th scope="row">'.$style_arr['name'].'</th><td align="right">';
				$to_show .= '<select name="'.$style_name.'">';
				if (count($options_arr) > 0)
				{
					foreach($options_arr as $var => $arr)
					{
						$to_show .= '<option value="'.$arr[0].'"';
						if ($style_value == $arr[0]) $to_show .= " selected";
						$to_show .= '>'.$arr[1];
					}
				}
				$to_show .= '</select></td></tr>';
				return $to_show;
			
			}
			
			
function amzps_styles_page() {

global $wpdb;
$status_message = "";
$page_status = 1;

if (isset($_GET['psid']))
	$psid = (int) $_GET['psid'];
if (isset($_POST['psid']))
	$psid = (int) $_POST['psid'];
	
$style_borders_array = array( 		'psborder' => array( 'name' => 'Main Border Width', 'limit' => 2),
									'psbordercolor' => array( 'name' => 'Main Border Color', 'limit' => 6),
									'psmidborder' => array( 'name' => 'Ad/Field Divider Border Width', 'limit' => 2),
									'psmidbordercolor' => array( 'name' => 'Ad/Field Divider Border Color', 'limit' => 6),
									'psmidbordertop' => array( 'name' => 'Header/Content Divider Border Width', 'limit' => 2),
									'psmidbordertopcolor' => array( 'name' => 'Header/Content Divider Border Color', 'limit' => 6),
									'psroundcorners' => array( 'name' => 'Round Main Border Corners', 'limit' => 1));
$style_backgrounds_array = array( 	'psbgcolortop' => array( 'name' => 'Header Background Color', 'limit' => 6),
									'psbgcolorleft' => array( 'name' => 'Ad Box Background Color', 'limit' => 6),
									'psbgcolorright' => array( 'name' => 'Field Box Background Color', 'limit' => 6),
									'psgradient' => array( 'name' => 'Header Background Gradient', 'limit' => 1));
$style_text_array = array( 			'pstexttopsize' => array( 'name' => 'Header Text Size', 'limit' => 3),
									'pstexttopcolor' => array( 'name' => 'Header Text Color', 'limit' => 6),
									'psfieldsize' => array( 'name' => 'Field Name Text Size', 'limit' => 3),
									'psfieldcolor' => array( 'name' => 'Field Name Text Color', 'limit' => 6),
									'psfieldtextsize' => array( 'name' => 'Field Value Text Size', 'limit' => 3),
									'psfieldtextcolor' => array( 'name' => 'Field Value Text Color', 'limit' => 6),
									'pslinktextsize' => array( 'name' => 'Text Link Size', 'limit' => 3),
									'pslinktextcolor' => array( 'name' => 'Text Link Color', 'limit' => 6),
									'pslinktextstyle' => array( 'name' => 'Text Link Style', 'limit' => 1));
$style_arrangement_array = array( 	'pswidth' => array( 'name' => 'Total Box Width', 'limit' => 3),
									'psleftwidth' => array( 'name' => 'Ad Box Width (When Used With Fields)', 'limit' => 3),
									'psadfloat' => array( 'name' => 'Ad Box Alignment', 'limit' => 1),
									'psfieldtitlewrap' => array( 'name' => 'Field Name Text Wrap', 'limit' => 1),
									'psfieldinfowrap' => array( 'name' => 'Field Value Text Wrap', 'limit' => 1),
									'pstextimageorder' => array( 'name' => 'Text & Image Ad Order', 'limit' => 1),
									'psheaderorder' => array( 'name' => 'Header Order', 'limit' => 1),
									'pscontentorder' => array( 'name' => 'Ad & Fields Order', 'limit' => 1),
									'pscontentdisplay' => array( 'name' => 'Ad & Fields Display', 'limit' => 1),
									'pstextlinkheader' => array( 'name' => 'Turn Header Text Into Link', 'limit' => 1));
$style_enhanced_array = array( 	'psenhbordercolor' => array( 'name' => 'Border Color', 'limit' => 6),
									'psenhimagesize' => array( 'name' => 'Image Size', 'limit' => 1),
									'psenhpricedisplay' => array( 'name' => 'Price Display', 'limit' => 1),
									'psenhbgcolor' => array( 'name' => 'Background Color', 'limit' => 6),
									'psenhtextcolor' => array( 'name' => 'Text Color', 'limit' => 6),
									'psenhlinkcolor' => array( 'name' => 'Link Color', 'limit' => 6));									
			

if (isset($_GET['action']))
{

	if ($_GET['action'] == "edit" && isset($psid))
		$page_status = 2;
		
	if ($_GET['action'] == "delete" && isset($psid))
	{
		if ($wpdb->query($wpdb->prepare('DELETE FROM '.$wpdb->prefix.'amzps_pstyle where psid = %d', $psid)) == 1)
			$status_message = "The product style was deleted successfully.";
		else
			$status_message = "There was a problem deleting the product style - please try again.";
		
	}

}
if (isset($_POST['publish_styles']))
{
	$style_publish_results = amzps_styles($_POST['style_display']);
	$published_style_id_string = "";
	$published_ct = count($_POST['style_display']);
	$ct=0;
	if ($published_ct > 0)
	{
	foreach ($_POST['style_display'] as $var => $val)
	{
		$ct++;
		if ($ct > 1)
			$published_style_id_string .= ",";
		$published_style_id_string .= $val;
	}
	}
	//if ($published_style_id_string != "")
	//	update_option("amzps_style_ids", $published_style_id_string);
		
	if ($style_publish_results == 2)
		$status_message = "The product style changes have successfully been published.";
	else
		$status_message = "You must select at least one product style to publish.";
	
}
if (isset($_POST['psname']) && isset($_POST['new-style']))
{
	if (trim($_POST['psname']) != "")
	{

			$styles_input_array = array('psname' => $_POST['psname']);
			$styles_input_array2 = array('%s');
			foreach ($style_borders_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_backgrounds_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_text_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_arrangement_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_enhanced_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			if ($wpdb->insert( $wpdb->prefix.'amzps_pstyle', $styles_input_array, $styles_input_array2 ))
				$status_message = 'New product style, '.stripslashes($_POST['psname']).', has been created.';
			else
				$status_message = 'There was a problem creating your new product style in the database - please try again.';
				

			
	}else
		$status_message = 'Your new product style was not created - please enter a name for the product style.';
		
}
if (isset($_POST['psname']) && isset($_POST['edit-style']) && isset($psid))
{
	if (trim($_POST['psname']) != "")
	{
			$styles_input_array = array('psname' => $_POST['psname']);
			$styles_input_array2 = array('%s');
			foreach ($style_borders_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_backgrounds_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_text_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_arrangement_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			foreach ($style_enhanced_array as $style_name => $style_arr)
			{
				$styles_input_array[$style_name] = $_POST[$style_name];
				$styles_input_array2[] = '%s';
			}
			
			
			if ($wpdb->update( $wpdb->prefix.'amzps_pstyle', $styles_input_array, array( 'psid' => $psid ), $styles_input_array2, array( '%d') ))
				$status_message = 'The product style, '.stripslashes($_POST['psname']).', has been edited successfully.';
			else
				$status_message = 'There was a problem editing your product style in the database - please try again.';
	
	}else
		$status_message = 'Your product style was not edited - you must enter a name for the product style.';
}




if ($page_status == 1){	
	$styles = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'amzps_pstyle', ARRAY_A);
	$tmp_id_list = get_option("amzps_style_ids");
	$tmp_id_list_arr = array();
	if ($tmp_id_list != "") $tmp_id_list_arr = explode(",", $tmp_id_list);	
	$published_style_ids = array();
	if (count($tmp_id_list_arr) > 0)
	{
		foreach ($tmp_id_list_arr as $blank_var => $id_to_save)
		{
			$published_style_ids[$id_to_save] = $id_to_save;
		}
	}
}

if ($page_status == 2)
	$style_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."amzps_pstyle where psid = %d", $psid), ARRAY_A);
	

?>
<div class="wrap">
<?php echo amzps_admin_header_message(); ?>
<h2>Product Style - Product Styles</h2>
<?php echo amzps_admin_header_menu(); ?>
<?php if ($status_message != "") { ?>
<div id="message" class="updated"><?php echo $status_message; ?></div>
<?php } ?>

Product Styles are predefined ad displays that can each have their own look, colors, size and more. You will be able to link each ad that you create with a product style.
<br />
If you are not familiar with website design, you may want to play around with some of the settings on the default style until you are comfortable enough to create a new style.
<br />
The plain text input boxes may be the most confusing for inexperienced people. If you input incorrect values, your style will not display properly.
<br /><br />
Please see the included readme file if you do not know what to do here.<br /><br />
<a href="http://infohound.net/colour/" target="_blank">Color Code Lookup</a>
<br /><br />
Five default styles are available, but you can also create your own.
<br /><br />
<b>Whenever you make a style change that you want to make live to your website visitors, simply check all Styles that your site uses and then click the 'Publish Styles' button.</b>
<?php
if ($page_status == 1)
{
?>
<?php
if (count($styles) > 0)
{
	echo '<form method="post" action="admin.php?page=amzps_styles"><table class="widefat" style="padding-bottom:15px;"><thead><tr><th>Build Style Changes</th></tr></thead><tbody><tr><th>';
	foreach ($styles as $var => $row)
	{
		echo '<div style="width:150px;padding:5px;float:left;height:50px;"><input type="checkbox" name="style_display[]" value="'.$row['psid'].'"';
		$tmp_row_id = $row['psid'];
		if (isset($published_style_ids[$tmp_row_id])) echo ' checked';
		echo'> '.stripslashes($row['psname']).'</div>';
	}
	echo '<div style="clear:both;"></div></tbody><tfoot><tr><th><input type="submit" class="button-primary" style="padding:5px;" name="publish_styles" value="Publish Styles" /></th></form></tr></tfoot></table>';
	echo '<table class="widefat"><thead><tr><th>Style Name</th><th>Actions</th></tr></thead><tfoot><tr><th>Style Name</th><th>Actions</th></tr></tfoot><tbody>';
	foreach($styles as $var => $row)
	{
		echo '<tr><td>'.stripslashes($row['psname']).'</td><td><a class="button-secondary" href="admin.php?page=amzps_styles&psid='.$row['psid'].'&action=edit">Edit Style</a> <a class="button-secondary" href="admin.php?page=amzps_styles&psid='.$row['psid'].'&action=edit&saction=copy">Copy as New Style</a> <a class="button-secondary" href="admin.php?page=amzps_styles&psid='.$row['psid'].'&action=delete">Delete Style</a></td></tr>';
	}
	echo "</tbody></table>";
	
}else
	echo "<b>You do not currently have any styles - please create at least one.</b>";
?><br /><br />
<table class="widefat" style="width:450px !important;"><thead><tr><th colspan="2">Create New Style</th></tr></thead><tbody>

<form method="post" action="admin.php?page=amzps_styles">

<tr><th scope="row">
New Style Name</th>
        <td align="right"><input type="text" name="psname" value="" size="32" /></td>
        </tr>
		<tr><th colspan="2"><center>

					
		<?php
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Border Sizes & Colors</th></tr></thead><tbody>';
			foreach ($style_borders_array as $style_name => $style_arr)
			{
				if ($style_name == "psroundcorners")
				echo '<input type="hidden" name="psroundcorners" value="0">';
				else{
				if ($style_arr['limit'] != 1)
					echo style_input($style_name, $style_arr);
				else
					echo style_select($style_name, $style_arr, array( array("0", "Off"), array("1", "On") ));
				}
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Background Colors</th></tr></thead><tbody>';
			foreach ($style_backgrounds_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input($style_name, $style_arr);
				else
					echo style_select($style_name, $style_arr, array( array("0", "Off"), array("1", "On") ));
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Text Sizes & Colors</th></tr></thead><tbody>';
			foreach ($style_text_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input($style_name, $style_arr);
				else{
					if ($style_name == "pslinktextstyle")
						echo style_select($style_name, $style_arr, array( array("0", "None"), array("1", "Underlined") ));
				}
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Amazon "Enhanced" Ad Settings</th></tr></thead><tbody>';
			foreach ($style_enhanced_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input($style_name, $style_arr);
				else{
					
					if ($style_name == "psenhimagesize")
						echo style_select($style_name, $style_arr, array( array("IS2", "Larger Image"), array("IS1", "Smaller Image") ));
					if ($style_name == "psenhpricedisplay")
						echo style_select($style_name, $style_arr, array( array("0", "Show All Prices"), array("1", "Show New Price Only"), array("2", "Hide All Prices") ));
				}
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Ad Display Settings</th></tr></thead><tbody>';
			foreach ($style_arrangement_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input($style_name, $style_arr);
				else{
					if ($style_name == "psadfloat")
						echo style_select($style_name, $style_arr, array( array("0", "Center"), array("1", "Left"), array("2", "Right") ));
					if ($style_name == "psfieldtitlewrap")
						echo style_select($style_name, $style_arr, array( array("0", "Allow Text Wrap"), array("1", "Do Not Allow Text Wrap") ));
					if ($style_name == "psfieldinfowrap")
						echo style_select($style_name, $style_arr, array( array("0", "Partial Text Wrap"), array("1", "Full Text Wrap") ));
					if ($style_name == "pstextimageorder")
						echo style_select($style_name, $style_arr, array( array("0", "Image On Top"), array("1", "Text On Top") ));
					if ($style_name == "psheaderorder")
						echo style_select($style_name, $style_arr, array( array("0", "Header On Top"), array("1", "Header On Bottom"), array("2", "No Header") ));
					if ($style_name == "pscontentorder")
						echo style_select($style_name, $style_arr, array( array("0", "Show Ad First"), array("1", "Show Fields First") ));
					if ($style_name == "pscontentdisplay")
						echo style_select($style_name, $style_arr, array( array("0", "Show Ad & Fields"), array("1", "Only Show Ad"), array("2", "Only Show Fields") ));
					if ($style_name == "pstextlinkheader")
						echo style_select($style_name, $style_arr, array( array("0", "No"), array("1", "Yes"), array("2", "Yes w/Amazon Preview") ));		
							
				}
			}
			echo '</tbody></table><br /></center>';
			
		?>
    </td></tr>
	</tbody>
	<tfoot><tr><th colspan="2" style="text-align: center !important;">

<input type="hidden" name="new-style" value="1" />
<input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Create New Style') ?>" />
</th></tr></tfoot></table>
</form>

<?php
}
if ($page_status == 2)
{
$page_special = 0;
if (isset($_GET['saction']))
{
	if ($_GET['saction'] == "copy")
		$page_special = 1;
}
?><br /><br />
<table class="widefat" style="width:450px !important;"><thead><tr><th colspan="2">Editing <?php if ($page_special == 1) echo "COPY of ";?>Style #<?php echo $style_info['psid'].': '.stripslashes($style_info['psname']); ?></th></tr></thead><tbody>

<form method="post" action="admin.php?page=amzps_styles">

<tr><th scope="row">
Style Name</th>
        <td align="right"><input type="text" name="psname" value="<?php echo htmlspecialchars(stripslashes($style_info['psname'])); ?>" size="32" /></td>
        </tr>
		<tr><th colspan="2"><center>
		
		<?php

			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Border Sizes & Colors</th></tr></thead><tbody>';
			foreach ($style_borders_array as $style_name => $style_arr)
			{
				if ($style_name == "psroundcorners")
				echo '<input type="hidden" name="psroundcorners" value="0">';
				else{
				if ($style_arr['limit'] != 1)
					echo style_input2($style_name, $style_arr, $style_info[$style_name]);
				else
					echo style_select2($style_name, $style_arr, array( array("0", "Off"), array("1", "On") ), $style_info['psroundcorners']);
				}
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Background Colors</th></tr></thead><tbody>';
			foreach ($style_backgrounds_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input2($style_name, $style_arr, $style_info[$style_name]);
				else
					echo style_select2($style_name, $style_arr, array( array("0", "Off"), array("1", "On") ), $style_info['psgradient']);
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Text Sizes & Colors</th></tr></thead><tbody>';
			foreach ($style_text_array as $style_name => $style_arr)
			{
			
				if ($style_arr['limit'] != 1)
					echo style_input2($style_name, $style_arr, $style_info[$style_name]);
				else{
					if ($style_name == "pslinktextstyle")
						echo style_select2($style_name, $style_arr, array( array("0", "None"), array("1", "Underlined") ), $style_info['pslinktextstyle']);
				}
				
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Amazon "Enhanced" Ad Settings</th></tr></thead><tbody>';
			foreach ($style_enhanced_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input2($style_name, $style_arr, $style_info[$style_name]);
				else{
					
					if ($style_name == "psenhimagesize")
						echo style_select2($style_name, $style_arr, array( array("IS2", "Larger Image"), array("IS1", "Smaller Image") ), $style_info['psenhimagesize']);
					if ($style_name == "psenhpricedisplay")
						echo style_select2($style_name, $style_arr, array( array("0", "Show All Prices"), array("1", "Show New Price Only"), array("2", "Hide All Prices") ), $style_info['psenhpricedisplay']);
				}
			}
			echo '</tbody></table>';
			
			echo '<br /><table class="widefat" style="width:425px !important;"><thead><tr><th colspan="2">Ad Display Settings</th></tr></thead><tbody>';
			foreach ($style_arrangement_array as $style_name => $style_arr)
			{
				if ($style_arr['limit'] != 1)
					echo style_input2($style_name, $style_arr, $style_info[$style_name]);
				else{
					if ($style_name == "psadfloat")
						echo style_select2($style_name, $style_arr, array( array("0", "Center"), array("1", "Left"), array("2", "Right") ), $style_info['psadfloat']);
					if ($style_name == "psfieldtitlewrap")
						echo style_select2($style_name, $style_arr, array( array("0", "Allow Text Wrap"), array("1", "Do Not Allow Text Wrap") ), $style_info['psfieldtitlewrap']);
					if ($style_name == "psfieldinfowrap")
						echo style_select2($style_name, $style_arr, array( array("0", "Partial Text Wrap"), array("1", "Full Text Wrap") ), $style_info['psfieldinfowrap']);
					if ($style_name == "pstextimageorder")
						echo style_select2($style_name, $style_arr, array( array("0", "Image On Top"), array("1", "Text On Top") ), $style_info['pstextimageorder']);
					if ($style_name == "psheaderorder")
						echo style_select2($style_name, $style_arr, array( array("0", "Header On Top"), array("1", "Header On Bottom"), array("2", "No Header") ), $style_info['psheaderorder']);
					if ($style_name == "pscontentorder")
						echo style_select2($style_name, $style_arr, array( array("0", "Show Ad First"), array("1", "Show Fields First") ), $style_info['pscontentorder']);
					if ($style_name == "pscontentdisplay")
						echo style_select2($style_name, $style_arr, array( array("0", "Show Ad & Fields"), array("1", "Only Show Ad"), array("2", "Only Show Fields") ), $style_info['pscontentdisplay']);
					if ($style_name == "pstextlinkheader")
						echo style_select2($style_name, $style_arr, array( array("0", "No"), array("1", "Yes"), array("2", "Yes w/Amazon Preview") ), $style_info['pstextlinkheader']);		
							
				}
			}
			echo '</tbody></table><br /></center>';
		?>
</td></tr>
</tbody>
	<tfoot><tr><th colspan="2" style="text-align: center !important;">
	
<?php
if ($page_special == 0) { ?>
<input type="hidden" name="psid" value="<?php echo $psid; ?>" />
<input type="hidden" name="edit-style" value="1" />
<input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Save Style Changes') ?>" />
<?php }else{ ?>
<input type="hidden" name="new-style" value="1" />
<input type="submit" class="button-primary" style="padding: 5px;" value="<?php _e('Save Copy As New Style') ?>" />
<?php } ?>
</th></tr></tfoot></table>
</form>

<? } ?>

</div>
<?php
}
?>