<?php

function amzps_wp_head () {
	global $amzps_amazon_country;
	

	$countries_tag = array("us" => "");

	$ct=1;
	

	$country = "us";
	
	$amzps_amazon_country = $country;
	echo get_option('amzps_styles');
}

function amzps_darken_color($color, $dif=20){
 
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return '000000'; }
    $rgb = '';
 
    for ($x=0;$x<3;$x++){
        $c = hexdec(substr($color,(2*$x),2)) - $dif;
        $c = ($c < 0) ? 0 : dechex($c);
        $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
    }
 
    return '#'.$rgb;
}


function amzps_styles($styles)
{
	global $wpdb;
	$style_string = "";
	if (count($styles) == 0)
	{
		return 0;
		exit;
	}
	$ct = 0;
	foreach ($styles as $var => $styleid)
	{
		$ct++;
		if ($ct != 1) $style_string .= " OR ";
		$style_string .= "psid = ".$styleid;
	}
	$style_id_list = implode(",",$styles);
	update_option("amzps_style_ids", $style_id_list);

	$styles = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'amzps_pstyle where '.$style_string, ARRAY_A);
	$style_ct = count($styles);
	if ($style_ct > 0)
	{
		
		$style_display = '<style type="text/css">';
		$style_display2 = '';
		foreach ($styles as $var => $row)
		{
			$ad_width = $row['pswidth'];
			$left_width = $row['psleftwidth'];
			$field_wrap = $row['psfieldinfowrap'];
			$bandm_totals = $row['psborder'] + $row['psborder'] + $row['psmidborder'];
			$info_width = $ad_width - $left_width;
			$info_right_full = $ad_width - $bandm_totals;
			$info_left_full = $ad_width - $bandm_totals;
			$detail_box_wrap = "text-align: left;";

			$link_text_decoration = "none";
			if ($row['pslinktextstyle'] == 1)
				$link_text_decoration = "underline";
			if ($row['psadfloat'] == 0)
				$ad_float = "margin:auto";
			if ($row['psadfloat'] == 1)
				$ad_float = "float:left";
			if ($row['psadfloat'] == 2)
				$ad_float = "float:right";
		
			$dark_bgcolorleft = amzps_darken_color($row['psbgcolorleft']);
			$dark_bgcolortop = amzps_darken_color($row['psbgcolortop']);
			$dark_bgcolorright = amzps_darken_color($row['psbgcolorright']);
			$dark_linkcolor = amzps_darken_color($row['pslinktextcolor']);
			$dark_textcolor = amzps_darken_color($row['pstexttopcolor']);
			$dark_fieldcolor = amzps_darken_color($row['psfieldcolor']);
			
			$style_display .= '.amzps-tab-'.$row['psid'].' a, .amzps-tab-'.$row['psid'].' a:link, .amzps-tab-'.$row['psid'].' a:hover, .amzps-tab-'.$row['psid'].' a:visited, .amzps-tabc-'.$row['psid'].' a, .amzps-tabc-'.$row['psid'].' a:link, .amzps-tabc-'.$row['psid'].' a:hover, .amzps-tabc-'.$row['psid'].' a:visited { font-size: '.$row['pslinktextsize'].'px !important; color: #'.$row['pslinktextcolor'].' !important; text-decoration: '.$link_text_decoration.' !important; }
			.amzps-text-link-'.$row['psid'].' a, .amzps-text-link-'.$row['psid'].' a:link, .amzps-text-link-'.$row['psid'].' a:hover, .amzps-text-link-'.$row['psid'].' a:visited { font-size: '.$row['pslinktextsize'].'px !important; color: #'.$row['pslinktextcolor'].' !important; text-decoration: '.$link_text_decoration.' !important; }
			.amzps-tabc-'.$row['psid'].' { margin: 0px !important; width:100%; border:0px !important; border-collapse: collapse !important; }
			.amzps-border-left-'.$row['psid'].' { border-left: '.$row['psborder'].'px solid #'.$row['psbordercolor'].' !important; }
			.amzps-border-bottom-'.$row['psid'].' { border-bottom: '.$row['psborder'].'px solid #'.$row['psbordercolor'].' !important; }
			.amzps-border-right-'.$row['psid'].' { border-right: '.$row['psborder'].'px solid #'.$row['psbordercolor'].' !important; }
			.amzps-border-top-'.$row['psid'].' { border-top: '.$row['psborder'].'px solid #'.$row['psbordercolor'].' !important; }
			.amzps-border-mid-'.$row['psid'].' { border-left: '.$row['psmidborder'].'px solid #'.$row['psmidbordercolor'].' !important; }
			.amzps-border-midtop-'.$row['psid'].' { border-bottom: '.$row['psmidborder'].'px solid #'.$row['psmidbordercolor'].' !important; }
			.amzps-border-midright-'.$row['psid'].' { border-right: '.$row['psmidborder'].'px solid #'.$row['psmidbordercolor'].' !important; }
			.amzps-border-midtop2-'.$row['psid'].' { border-top: '.$row['psmidborder'].'px solid #'.$row['psmidbordercolor'].' !important; }
			.amzps-ad-'.$row['psid'].' { width: '.$left_width.'px !important; background-color: #'.$row['psbgcolorleft'].' !important; padding-bottom: 8px !important; padding-top: 5px !important; text-align: center !important; }
			.amzps-adsolo-'.$row['psid'].' { width: '.$info_left_full.'px !important; background-color: #'.$row['psbgcolorleft'].' !important; padding-bottom: 8px !important; padding-top: 5px !important; text-align: center !important; }
			.amzps-info-'.$row['psid'].' { vertical-align: top !important; width: '.$info_width.'px !important; background-color: #'.$row['psbgcolorright'].' !important; padding-bottom: 15px !important; padding-top: 15px; padding-left: 10px !important; padding-right: 10px !important; }
			.amzps-infosolo-'.$row['psid'].' { vertical-align: top !important; width: '.$info_right_full.'px !important; background-color: #'.$row['psbgcolorright'].' !important; padding-bottom: 15px !important; padding-top: 15px; padding-left: 15px !important; padding-right: 15px !important; }
			.amzps-tab-'.$row['psid'].' { '.$ad_float.' !important; border: 0px !important; margin-bottom: 10px !important; width: '.$ad_width.'px !important; border-collapse: separate !important; }
			.amzps-tab-'.$row['psid'].' img { margin:0px !important; padding:0px !important; border: 0 !important;}
			.amzps-detail-box-'.$row['psid'].' {'.$detail_box_wrap.' margin-bottom: 3px !important; font-size: '.$row['psfieldtextsize'].'px !important; color: #'.$row['psfieldtextcolor'].' !important;  background-color: #'.$row['psbgcolorright'].' !important; border: 0px !important; }
			.amzps-detail1-'.$row['psid'].' { width: '.$info_width.'px !important; background-color: #'.$row['psbgcolorright'].' !important; border: 0px !important;}
			.amzps-detail2-'.$row['psid'].' { width: '.$info_right_full.'px !important; background-color: #'.$row['psbgcolorright'].' !important; border: 0px !important;}
			.amzps-detail-title-'.$row['psid'].' { margin-bottom: -3px !important; margin-right: 5px; font-weight: bold !important; font-size: '.$row['psfieldsize'].'px !important; color: #'.$row['psfieldcolor'].' !important; float: left !important; }
			.amzps-price-header2-'.$row['psid'].' { font-family: Tahoma; font-weight: bold; background-color: #'.$row['psbgcolortop'].' !important; }
			.amzps-h1-'.$row['psid'].' { background: #'.$row['psbgcolortop'].' !important; text-align:center !important; font-size: '.$row['pstexttopsize'].'px !important; color: #'.$row['pstexttopcolor'].' !important; width: '.$left_width.'px !important; padding-top: 10px !important; padding-bottom: 10px !important; padding-left: 5px !important; padding-right: 0px !important; text-shadow: 1px 1px 1px '.$dark_textcolor.';}
			.amzps-h1b-'.$row['psid'].' { background: #'.$row['psbgcolortop'].' !important; text-align:center !important; font-size: '.$row['pstexttopsize'].'px !important; color: #'.$row['pstexttopcolor'].' !important; padding-top: 10px !important; padding-bottom: 10px !important; padding-left: 10px !important; padding-right: 10px !important; text-shadow: 1px 1px 1px '.$dark_textcolor.'; }
			.amzps-h2-'.$row['psid'].' { background: #'.$row['psbgcolortop'].' !important; text-align:center !important; font-size: '.$row['pstexttopsize'].'px !important; color: #'.$row['pstexttopcolor'].' !important; padding: 10px !important; text-shadow: 1px 1px 1px '.$dark_textcolor.';}
			.amzps-content-'.$row['psid'].' { font-weight: normal !important; }
			.amzps-adsoloc-'.$row['psid'].' {  background: #'.$row['psbgcolorright'].' !important; text-align: center !important; font-size: '.$row['psfieldtextsize'].'px !important; font-weight: normal !important; color: #'.$row['psfieldtextcolor'].' !important; padding: 0px !important; }
			.amzps-price-header2c-'.$row['psid'].' { font-family: Tahoma; font-weight: bold; }
			.amzps-h2c-'.$row['psid'].' { background: #'.$row['psbgcolortop'].'; text-align:center !important; font-size: '.$row['pstexttopsize'].'px !important; font-weight: bold !important; color: #'.$row['pstexttopcolor'].' !important; padding: 0px !important; }
			.amzps-h1c-'.$row['psid'].' { background: #'.$row['psbgcolorleft'].'; text-align:center !important; font-size: '.$row['psfieldsize'].'px !important; font-weight: bold !important; color: #'.$row['psfieldcolor'].' !important; padding: 0px !important; margin:-1px !important;}
			.amzps-h3c-'.$row['psid'].' { text-align:center !important; font-size: '.$row['pstexttopsize'].'px !important; font-weight: bold; color: #'.$row['pstexttopcolor'].' !important;  padding: 0px !important;  }
			.amzps-contentc-'.$row['psid'].' { font-weight:normal !important; background: transparent; }
			.amzps-tabc-container-'.$row['psid'].' { float:left; padding:0px; vertical-align: middle !important; margin-bottom:10px !important; }
			.amzps-tabc-container-'.$row['psid'].' img { margin:0px !important; padding:0px !important; border: 0 !important;}
			.amzps-tabc-container-small-'.$row['psid'].' { color: #'.$row['pstexttopcolor'].' !important; margin:0px !important; text-align:center !important; padding: 10px; overflow:hidden; }
			.amzps-border-head-bg1-'.$row['psid'].' { font-size: '.$row['pstexttopsize'].'px !important; font-weight: bold; color: #'.$row['pstexttopcolor'].' !important; background: #'.$row['psbgcolortop'].'; text-shadow: 1px 1px 1px '.$dark_textcolor.'; }
			.amzps-border-head-bg2-'.$row['psid'].' { font-size: '.$row['psfieldsize'].'px !important; font-weight: bold; color: #'.$row['psfieldcolor'].' !important; background: #'.$row['psbgcolorleft'].'; text-shadow: 1px 1px 1px '.$dark_fieldcolor.'; }
			.amzps-border-bg-left-'.$row['psid'].' { background: -webkit-gradient(linear, left top, left bottom, from(#'.$row['psbgcolorleft'].'), to('.$dark_bgcolorleft.')); /* for webkit browsers */
											background: -moz-linear-gradient(top,  #'.$row['psbgcolorleft'].',  '.$dark_bgcolorleft.'); /* for firefox 3.6+ */ 
											filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#'.$row['psbgcolorleft'].'", endColorstr="'.$dark_bgcolorleft.'"); /* for IE */
											}
			.amzps-border-bg-top-'.$row['psid'].' { background: -webkit-gradient(linear, left top, left bottom, from(#'.$row['psbgcolortop'].'), to('.$dark_bgcolortop.')); /* for webkit browsers */
											background: -moz-linear-gradient(top,  #'.$row['psbgcolortop'].',  '.$dark_bgcolortop.'); /* for firefox 3.6+ */
											filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#'.$row['psbgcolortop'].'", endColorstr="'.$dark_bgcolortop.'"); /* for IE */
 											}
			.amzps-border-bg-left2-'.$row['psid'].' { background: -webkit-gradient(linear, left top, left bottom, from('.$dark_bgcolorleft.'), to(#'.$row['psbgcolorleft'].')); /* for webkit browsers */
											background: -moz-linear-gradient(top,  '.$dark_bgcolorleft.',  #'.$row['psbgcolorleft'].'); /* for firefox 3.6+ */
											filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="'.$dark_bgcolorleft.'", endColorstr="#'.$row['psbgcolorleft'].'"); /* for IE */
											 }
			.amzps-border-bg-top2-'.$row['psid'].' { background: -webkit-gradient(linear, left top, left bottom, from('.$dark_bgcolortop.'), to(#'.$row['psbgcolortop'].')); /* for webkit browsers */
											background: -moz-linear-gradient(top,  '.$dark_bgcolortop.',  #'.$row['psbgcolortop'].'); /* for firefox 3.6+ */
											filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="'.$dark_bgcolortop.'", endColorstr="#'.$row['psbgcolortop'].'"); /* for IE */
											}
			.amzps-border-bg-right-'.$row['psid'].' { background: -webkit-gradient(linear, left top, left bottom, from(#'.$row['psbgcolorright'].'), to('.$dark_bgcolorright.')); /* for webkit browsers */
											background: -moz-linear-gradient(top,  #'.$row['psbgcolorright'].',  '.$dark_bgcolorright.'); /* for firefox 3.6+ */
											filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#'.$row['psbgcolorright'].'", endColorstr="'.$dark_bgcolorright.'"); /* for IE */
											 }
			.amzps-border-all-none-'.$row['psid'].' { border:0px !important; }
			.amzps-border-all2-'.$row['psid'].' { border: '.$row['psmidborder'].'px solid #'.$row['psmidbordercolor'].' !important; }
			.amzps-border-all-'.$row['psid'].' { border: '.$row['psborder'].'px solid #'.$row['psbordercolor'].' !important; }
			.amzps-border-round-'.$row['psid'].' { -moz-border-radius:10px; /* FF1+ */  -webkit-border-radius:10px; /* Saf3-4 */  border-radius:10px; -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2); }
			.amzps-border-round-topleft-'.$row['psid'].' { border-radius-top-left:5px; -moz-border-radius-topleft:5px; -webkit-border-top-left-radius:5px; /* Saf3-4 */ }
			.amzps-border-round-topright-'.$row['psid'].' { border-radius-top-right:5px; -moz-border-radius-topright:5px; -webkit-border-top-right-radius:5px; /* Saf3-4 */ }
			.amzps-border-round-bottomleft-'.$row['psid'].' { border-radius-bottom-left:5px;  -moz-border-radius-bottomleft:5px; -webkit-border-bottom-left-radius:5px; /* Saf3-4 */ }
			.amzps-border-round-bottomright-'.$row['psid'].' {  border-radius-bottom-right:5px; -moz-border-radius-bottomright:5px; -webkit-border-bottom-right-radius:5px; /* Saf3-4 */ }
			';
			$style_display2 .= '<!--[if lt IE 9]>
		<style type="text/css" media="screen">
			.amzps-tabc-container-small-'.$row['psid'].',.amzps-h2c-'.$row['psid'].',.amzps-h1c-'.$row['psid'].' 
			{
				filter:none;
			}
		</style>
		<![endif]-->';
//-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2); }
//border: '.$row['psborder'].'px solid #'.$row['psbordercolor'].';
		}
		//table cell css override info to use for charts
		//$fields_display .= '<tr class="amzps-detail-box-<<PSID>>" style="padding:1px !important;"><td class="amzps-detail-title-<<PSID>>'.$ad_no_wrap.'" style="border:0px !important;padding:1px !important;">'.stripslashes($row['pfname']).':</td><td style="border:0px !important;text-align:left;padding:1px !important;font-weight:normal !important;">'.stripslashes($ppfields[$tmp_pfid]).'</td></tr>';	
		$style_display .= '
		.amzps-nowrap { white-space:nowrap;}
		.amzps-div-border { margin:0 !important; padding: 10px !important; }
		</style>'.$style_display2;
		update_option('amzps_styles', $style_display);
		return 2;
	}else{
		return 1;
		exit;
	}
	

}

// Ad Shortcode Handler Gateway
function amzps_shortcode($attr, $content = NULL) {  

     $attr = shortcode_atts(array('id'   => '',  
								  
								  'box_width' => '', //pswidth
								  
								  'ad_width' => '', // psleftwidth
								  
								  'ad_order' => '', // pstextimageorder
								  
								  'header_order' => '', // psheaderorder
								  
								  'content_order' => '', // pscontentorder
								  
								  'content_display' => '', // pscontentdisplay
								  
								  'header_link' => '' // pstextlinkheader  
								  
								  ), $attr);  

		if ($attr['id'] > 0)
		{
			return amzps_shortcode_byid($attr['id'], $attr['box_width'], $attr['ad_width'], $attr['ad_order'], $attr['header_order'], $attr['content_order'], $attr['content_display'], $attr['header_link']);
			exit;
		}
		
		return "Ad Shortcode Error";
} 

// Ad Shortcode Handler
function amzps_shortcode_byid($paid, $box_width = "", $ad_width = "", $ad_order = "", $header_order = "", $content_order = "", $content_display = "", $header_link = "" )
{
	global $wpdb;
	global $amzps_amazon_country;
	
	//include("amazon-ad-settings.php");
	$text_link = "";

	$amz = array();
	$amz['container'] = array();
	$amz['header'] = array();
	$amz['content'] = array();
/*
	$amz['container'][1] = '<div class="amzps-tab-<<PSID>>">';
	$amz['container'][2] = '</div>';

	$amz['header'][1] = '<div class="amzps-price-header2-<<PSID>>">';
	$amz['header'][2] = '<div class="amzps-h1-<<PSID>>">';
	$amz['header'][3] = '</div><div class="amzps-h2-<<PSID>>">';
	$amz['header'][4] = '<div class="amzps-h1b-<<PSID>>">';
	$amz['header'][5] = '</div></div>';

	$amz['content'][1] = '<div class="amzps-content-<<PSID>>">';
	$amz['content'][2] = '<div class="amzps-adsolo-<<PSID>>">';
	$amz['content'][3] = '<div class="amzps-ad-<<PSID>>">';
	$amz['content'][4] = '</div>';
	$amz['content'][5] = '<div class="amzps-infosolo-<<PSID>>">';
	$amz['content'][6] = '<div class="amzps-info-<<PSID>>">';
*/
	$amz['container'][1] = '<table cellspacing="0" cellpadding="0" class="amzps-tab-<<PSID>><<TABLE-CLASS>>">';
	$amz['container'][2] = '</table>';

	$amz['header'][1] = '<tr class="amzps-price-header2-<<PSID>>" style="border-collapse: separate !important;">';
	$amz['header'][2] = '<th class="amzps-h1-<<PSID>><<H1-CLASS>>" style="border-collapse: separate !important;">';
	$amz['header'][3] = '</th><th class="amzps-h2-<<PSID>><<H2-CLASS>>" style="border-collapse: separate !important;">';
	$amz['header'][4] = '<th colspan="2" class="amzps-h1b-<<PSID>><<H1B-CLASS>>" style="border-collapse: separate !important;">';
	$amz['header'][5] = '</th></tr>';

	$amz['content'][1] = '<tr class="amzps-content-<<PSID>><<CONTENT-CLASS>>" style="border-collapse: separate !important;">';
	$amz['content'][2] = '<th colspan="2" class="amzps-adsolo-<<PSID>><<ADSOLO-CLASS>>" style="border-collapse: separate !important;">';
	$amz['content'][3] = '<th class="amzps-ad-<<PSID>><<AD-CLASS>>" style="border-collapse: separate !important;">';
	$amz['content'][4] = '</th>';
	$amz['content'][5] = '<th colspan="2" class="amzps-infosolo-<<PSID>><<INFOSOLO-CLASS>>" style="border-collapse: separate !important;">';
	$amz['content'][6] = '<th class="amzps-info-<<PSID>><<INFO-CLASS>>" style="border-collapse: separate !important;">';
	$amz['content'][7] = '</tr>';
	$amz['content'][8] = '</th>';
	// AMZ-TARGET
	// _blank or _top
	// ENH-BCOLOR
	// 000000 to show and the background color to turn off
	// ENH-IMAGE
	// IS1 = smaller, IS2 = larger
	// ENH-PRICE
	// "" = show all prices
	// "&nou=1" = show new prices
	// "&npa=1" = hide prices
	// ENH-BGCOLOR = background color
	// ENH-TCOLOR = text color
	// ENH-LCOLOR = link color
	
	include("amazon_settings.php");
	
	// end contents of settings
	
	$amzps_images_url = WP_PLUGIN_URL.'/amzps/images/';
	$buynow_button_url = $amzps_images_url.'buy-now-button-amazon.png';
	

		$country = $amzps_amazon_country;


		
	if ($country == 1)
		$country = "us";
	
		
		
	
	$ad_info = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."amzps_padv as adv,".$wpdb->prefix."amzps_pstyle as sty,".$wpdb->prefix."amzps_pprod as pro,".$wpdb->prefix."amzps_pcat as cat where adv.paid = %d and adv.psid = sty.psid and adv.ppid = pro.ppid and pro.pcid = cat.pcid",$paid), ARRAY_A);
	
	if ($ad_info['paid'] != $paid)
	{	
		return "";
		exit;	
	}
		
	$product_asin = $ad_info['paasin'];

	$optional_array = array( 'box_width' => 'pswidth', 'ad_width' => 'psleftwidth', 'ad_order' => 'pstextimageorder', 'header_order' => 'psheaderorder', 'content_order' => 'pscontentorder', 'content_display' => 'pscontentdisplay', 'header_link' => 'pstextlinkheader' );
	$opt['ad_type'] = array('enhanced' => 0, 'image' => 1, 'text' => 2, 'imagetext' => 3);
	$opt['ad_order'] = array('image' => 0, 'text' => 1);
	$opt['header_order'] = array('top' => 0, 'bottom' => 1, 'off' => 2);
	$opt['content_order'] = array('ads' => 0, 'fields' => 1);
	$opt['content_display'] = array('both' => 0, 'ads' => 1, 'fields' => 2);
	$opt['header_link'] = array('no' => 0, 'yes' => 1, 'yespv' => 2);
	$opt['box_width'] = array('equal_value' => 0);
	$opt['ad_width'] = array('equal_value' => 0);
	
	foreach ($optional_array as $newvar => $var)
	{
		if ($$newvar != "")
		{
			if (isset($opt[$newvar]['equal_value']))
				$ad_info[$var] = $$newvar;
			else{
				$newvartmp = $$newvar;
				$ad_info[$var] = $opt[$newvar][$newvartmp];
			}
		}
	}
	
	$product_asin = $ad_info['paasin'];
	$pcid = $ad_info['pcid'];
	
	$fields = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'amzps_pfield where pcid = %d ORDER BY pfsort ASC, pfid ASC', $pcid), ARRAY_A);
	
	if (count($fields) == 0)
	{
		return "";
		exit;
	}
	
	$ppfields_tmp = explode("|||", $ad_info['ppfields']);
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
	
	$fields_display = "";
	$detail_info_class = 1;
	if ($ad_info['pscontentdisplay'] == 2)
		$detail_info_class = 2;
			
	if ($ad_info['psfieldinfowrap'] == 0)
		$fields_display .= '<table class="amzps-detail'.$detail_info_class.'-<<PSID>>">';
	
	$ad_no_wrap = "";
	
	if ($ad_info['psfieldtitlewrap'] == 1)
		$ad_no_wrap = " amzps-nowrap";
	
	foreach ($fields as $var => $row)
	{
	
		$tmp_pfid = $row['pfid'];
		
		if ($row['pfname'] != "" && isset($ppfields[$tmp_pfid]) && $ppfields[$tmp_pfid] != "")
		{
			if ($ad_info['psfieldinfowrap'] == 0)
				$fields_display .= '<tr class="amzps-detail-box-<<PSID>>" style="padding:1px !important;"><td class="amzps-detail-title-<<PSID>>'.$ad_no_wrap.'" style="border:0px !important;padding:1px !important;">'.stripslashes($row['pfname']).':</td><td style="border:0px !important;text-align:left;padding:1px !important;font-weight:normal !important;">'.stripslashes($ppfields[$tmp_pfid]).'</td></tr>';
			else
				$fields_display .= '<div class="amzps-detail-box-<<PSID>> amzps-detail'.$detail_info_class.'-<<PSID>>"><div class="amzps-detail-title-<<PSID>>'.$ad_no_wrap.'">'.stripslashes($row['pfname']).':</div><span style="font-weight:normal !important;">'.stripslashes($ppfields[$tmp_pfid]).'</span><div style="clear:both;"></div></div>';
		}
		//$fields_display .= '<span class="amzps-detail-title-<<PSID>>">'.stripslashes($row['pfname']).':</span><span class="amzps-detail-info'.$detail_info_class.'-<<PSID>>">'.stripslashes($ppfields[$tmp_pfid]).'</span><div style="clear:both;"></div>';
			//$fields_display .= '<div class="amzps-detail-entry-<<PSID>>"><span class="amzps-detail-title-<<PSID>>">'.$row['pfname'].':</span><span class="amzps-detail-info-<<PSID>>">'.$ppfields[$tmp_pfid].'</span><div style="clear:both;"></div></div>';
	
	}
	
	if ($ad_info['psfieldinfowrap'] == 0)
		$fields_display .= '</table>';
		
		
	$amz_ad_target = "_blank";
	if ($ad_info['patarget'] == 1)
		$amz_ad_target = "_top";
		
	$ad_string = "";
	
	// Revised 1.3

		$amz_assoc_id = get_option('amzps_assoc_id');



		$amz_price_display = "";
		if ($ad_info['psenhpricedisplay'] == 1)
			$amz_price_display = "&nou=1";
		if ($ad_info['psenhpricedisplay'] == 2)
			$amz_price_display = "&npa=1";
			
		$aenh = $amzenh[$country];
		$enh_search = array("<<AMZ-TARGET>>", "<<ENH-BCOLOR>>", "<<ENH-IMAGE>>", "<<ENH-PRICE>>", "<<ENH-BGCOLOR>>", "<<ENH-TCOLOR>>", "<<ENH-LCOLOR>>", "<<AID>>");
		$enh_replace = array($amz_ad_target, $ad_info['psenhbordercolor'], $ad_info['psenhimagesize'], $amz_price_display, $ad_info['psenhbgcolor'], $ad_info['psenhtextcolor'], $ad_info['psenhlinkcolor'], $ad_info['paasin']);
		
		// Recoded 1.3
		$upper_country = strtoupper($country);
		$enh_search[] = "<<AMZ-ASSOC-".$upper_country.">>";
		$enh_replace[] = $amz_assoc_id;
		

		$ad_string = str_replace($enh_search, $enh_replace, $aenh);

	
	
	
	
	




	$final_ad_string = $amz['container'][1];
	$header_string = "";
	$content_string = "";
	$content_ad_string = "";
	$content_field_string = "";

	$amz_class = array("H1" => array(),"H1B" => array(),"H2" => array(),
					"AD" => array(),"ADSOLO" => array(),"INFO" => array(),"INFOSOLO" => array(), "CONTENT" => array(), "TABLE" => array());

	$amz_class_unused = array();
	
	$header_string .= $amz['header'][1];

	if ($ad_info['patitletype'] == 0)
	{
		$amz_class['H1B'][] = "left";
		$amz_class['H1B'][] = "right";
		if ($ad_info['psgradient'] == 1)
			$amz_class['H1B'][] = "bg-top";
		$amz_class_unused['H1'] = "H1";
		$amz_class_unused['H2'] = "H2";
		$header_string .= $amz['header'][4];
		if ($ad_info['pstextlinkheader'] == 0)
			$header_string .= stripslashes($ad_info['patitle1']);
		else{
	
			$atext_backup = $amztext[$country];
			
			
		$amz_text_search = array("<<AID>>", "<<AMZ-TARGET>>", "<<TEXT>>");
		$amz_text_replace = array($ad_info['paasin'], $amz_ad_target, stripslashes($ad_info['patitle1']));
		
		//Recoded 1.3
		$upper_country = strtoupper($country);
		$amz_text_search[] = "<<AMZ-ASSOC-".$upper_country.">>";
		$amz_text_replace[] = $amz_assoc_id;
	
		
		$header_string  .= str_replace($amz_text_search, $amz_text_replace, $atext_backup);
		
		if ($ad_info['pstextlinkheader'] == 2 && $external_ad == 0 && $amzbottom[$country] != "")
			$header_string .= str_replace($amz_preview_search, $amz_preview_replace, $amzbottom[$country]);
		}
		$header_string .= $amz['header'][5];
	}

	if ($ad_info['patitletype'] == 1)
	{
		$amz_class_unused['H1B'] = "H1B";
		$amz_class['H1'][] = "left";
		$amz_class['H2'][] = "right";
		if ($ad_info['psgradient'] == 1)
		{
			$amz_class['H1'][] = "bg-top";
			$amz_class['H2'][] = "bg-top";
		}	
		$header_string .= $amz['header'][2];
		$header_string .= stripslashes($ad_info['patitle1']);
		$header_string .= $amz['header'][3];
		$header_string .= stripslashes($ad_info['patitle2']);
		$header_string .= $amz['header'][5];
	}

	if ($ad_info['pscontentdisplay'] == 0 || $ad_info['pscontentdisplay'] == 1)
	{
		if ($ad_info['pscontentdisplay'] == 0)
		{
			$amz_class_unused['ADSOLO'] = "ADSOLO";
			$amz_class_unused['INFOSOLO'] = "INFOSOLO";
			$content_ad_string .= $amz['content'][3];
		}else{
			$amz_class_unused['AD'] = "AD";
			$amz_class_unused['INFO'] = "INFO";
			$amz_class_unused['INFOSOLO'] = "INFOSOLO";
			$content_ad_string .= $amz['content'][2];
		}
		$content_ad_string .= $ad_string.$amz['content'][4];
	}
	if ($ad_info['pscontentdisplay'] == 0 || $ad_info['pscontentdisplay'] == 2)
	{
		if ($ad_info['pscontentdisplay'] == 0)
			$content_field_string .= $amz['content'][6];
		else{
			$amz_class_unused['AD'] = "AD";
			$amz_class_unused['INFO'] = "INFO";
			$amz_class_unused['ADSOLO'] = "ADSOLO";
			$content_field_string .= $amz['content'][5];
		}
		
		$content_field_string .= $fields_display.$amz['content'][8];
	}


	$content_string = $amz['content'][1];

	if ($ad_info['pscontentorder'] == 0)
	{
		$amz_class['AD'][] = "left";
		$amz_class['ADSOLO'][] = "left";
		$amz_class['ADSOLO'][] = "right";
		$amz_class['INFO'][] = "mid";
		//$amz_class['CONTENT'][] = "right";
		$amz_class['INFO'][] = "right";
		$amz_class['INFOSOLO'][] = "left";
		$amz_class['INFOSOLO'][] = "right";
		$content_string .= $content_ad_string.$content_field_string;
	}else{
		$amz_class['AD'][] = "right";
		$amz_class['AD'][] = "mid";
		
		$amz_class['ADSOLO'][] = "left";
		$amz_class['ADSOLO'][] = "right";
		$amz_class['INFO'][] = "left";
		$amz_class['INFOSOLO'][] = "left";
		$amz_class['INFOSOLO'][] = "right";
		$content_string .= $content_field_string.$content_ad_string;
	}
	
	$content_string .= $amz['content'][7];

	//if ($ad_info['psroundcorners'] == 1)
	//	$amz_class['TABLE'][] = "round";
	//else
		$amz_class_unused['TABLE'] = "TABLE";
		
	if ($ad_info['psheaderorder'] == 0)
	{	
		$amz_class['H1'][] = "top";
		$amz_class['H1'][] = "midtop";
		$amz_class['H1B'][] = "top";
		$amz_class['H1B'][] = "midtop";
		$amz_class['H2'][] = "top";
		$amz_class['H2'][] = "midtop";
		$amz_class['AD'][] = "bottom";
		$amz_class['ADSOLO'][] = "bottom";
		$amz_class['INFO'][] = "bottom";
		$amz_class['INFOSOLO'][] = "bottom";
		$final_ad_string .= $header_string.$content_string;
	}
	if ($ad_info['psheaderorder'] == 1)
	{	
		$amz_class['H1'][] = "bottom";
		$amz_class['H1B'][] = "bottom";
		$amz_class['H2'][] = "bottom";
		//$amz_class['CONTENT'][] = "top";
		$amz_class['AD'][] = "top";
		$amz_class['AD'][] = "midtop";
		$amz_class['ADSOLO'][] = "top";
		$amz_class['ADSOLO'][] = "midtop";
		$amz_class['INFO'][] = "top";
		$amz_class['INFO'][] = "midtop";
		$amz_class['INFOSOLO'][] = "top";
		$amz_class['INFOSOLO'][] = "midtop";
		$final_ad_string .= $content_string.$header_string;
	}
	if ($ad_info['psheaderorder'] == 2)
	{
		//$amz_class['CONTENT'][] = "top";
		$amz_class['AD'][] = "top";
		$amz_class['ADSOLO'][] = "top";
		$amz_class['INFO'][] = "top";
		$amz_class['INFOSOLO'][] = "top";
		$amz_class['AD'][] = "bottom";
		$amz_class['ADSOLO'][] = "bottom";
		$amz_class['INFO'][] = "bottom";
		$amz_class['INFOSOLO'][] = "bottom";
		$amz_class_unused['H1'] = "H1";
		$amz_class_unused['H1B'] = "H1B";
		$amz_class_unused['H2'] = "H2";
		$final_ad_string .= $content_string;
	}
	$final_ad_string .= $amz['container'][2];

	
	
	$final_search = array("<<PSID>>");
	$final_replace = array($ad_info['psid']);
	
	foreach ($amz_class as $class_name => $class_array)
	{
		
		
		if (!isset($amz_class_unused[$class_name]))
		{
			$tmp_class = "";
			if (is_array($class_array))
			{
			foreach ($class_array as $var => $class_short)
			{
				$tmp_class .= " ";
				$tmp_class .= "amzps-border-".$class_short."-".$ad_info['psid'];
				
			}
			}
			$final_search[] = "<<".$class_name."-CLASS>>";
			$final_replace[] = $tmp_class;
		}else{
			$final_search[] = "<<".$class_name."-CLASS>>";
			$final_replace[] = "";
		}
	}

	
	$final_ad_string = str_replace($final_search, $final_replace, $final_ad_string);
	
	return $final_ad_string;
}






function amzps_adminFoot () {
    $url = $_SERVER['REQUEST_URI'];
	if (strpos($url, 'post.php') || strpos($url, 'post-new.php') || strpos($url, 'page.php') || strpos($url, 'page-new.php') || strpos($url, 'bookmarklet.php')) {
       
		global $wpdb;
$ads = $wpdb->get_results('SELECT paid, paname FROM '.$wpdb->prefix.'amzps_padv', ARRAY_A);

?>
<script language="JavaScript" type="text/javascript">
<!--
	var amzps_select = document.createElement('select');
	amzps_select.setAttribute('onchange', 'amzps_add_post_ad(this)');
	amzps_select.setAttribute('class', 'ed_button');
	amzps_select.setAttribute('title', 'Insert Product Style Ad');
	amzps_select.setAttribute('id', 'amzps_select');

	var amzps_option = document.createElement('option');
	amzps_option.value='';
	amzps_option.innerHTML='Insert Style Ad...';
	amzps_option.style.fontWeight='bold';
	amzps_select.appendChild(amzps_option);
	
	<?php
					if (count($ads) > 0)
					{
					
						foreach ($ads as $var => $row)
						{
						?>
	amzps_option = document.createElement('option');
	amzps_option.value='<?php echo $row['paid']; ?>';
	amzps_option.innerHTML='#<?php echo $row['paid'].'-'.$row['paname']; ?>';
	amzps_select.appendChild(amzps_option);
						<?php
						}
											
					}
					
	?>

	var amzps_tb = document.getElementById('ed_toolbar');
	if (amzps_tb) {
		amzps_tb.insertBefore(amzps_select, document.getElementById('ed_spell'));
		if (navigator.appName == 'Microsoft Internet Explorer') {
			amzps_tb.innerHTML = amzps_tb.innerHTML; 
		}
	}	
	
	function amzps_add_post_ad(element)
	{
		if (element.selectedIndex != 0) {
			var amzps_code = (element.value == '') ? '[amzps]' : '[amzps id="' + element.value + '"]';
			var amzps_content = document.getElementById('content');
			if (document.selection && !window.opera) {
				amzps_content.value += amzps_code;
			} else {
				if (amzps_content.selectionStart || amzps_content.selectionStart == '0') {
						var startPos = amzps_content.selectionStart;
						var endPos = amzps_content.selectionEnd;
						amzps_content.value = amzps_content.value.substring(0, startPos) + amzps_code + amzps_content.value.substring(endPos, amzps_content.value.length);
				} else {
					amzps_content.value += amzps_code;
				}
				element.selectedIndex = 0;
			}
		}
	}
// -->
</script>
<?php


    }
}

function amzps_install() {

	global $wpdb;
	global $amzps_key;
	
	$successful_install = 1;
	$i2 = true;
	if ($i2 === true)
	{
	$table_name = $wpdb->prefix . "amzps_pcat";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		
	$sql = "CREATE TABLE `" . $table_name . "` (
	  `pcid` mediumint( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	  `pcname` varchar( 48 ) NOT NULL ,
	  INDEX (`pcname`)
	);";
	
	$wpdb->query($sql);

	}else
		$successful_install = 0;

		
		
	$table_name = $wpdb->prefix . "amzps_pfield";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		
	$sql = "CREATE TABLE " . $table_name . " (
	  `pfid` mediumint( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	  `pcid` mediumint( 9 ) DEFAULT '0' NOT NULL ,
	  `pfname` varchar( 128 ) NOT NULL ,
	  `pftype` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `pfsort` mediumint( 9 ) DEFAULT '0' NOT NULL ,
	  INDEX (`pcid`)
	);";
	
	$wpdb->query($sql);

	}else
		$successful_install = 0;

		
		
	$table_name = $wpdb->prefix . "amzps_pprod";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		
	$sql = "CREATE TABLE " . $table_name . " (
	  `ppid` mediumint( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	  `pcid` mediumint( 9 ) DEFAULT '0' NOT NULL ,
	  `ppname` varchar( 128 ) NOT NULL ,
	  `ppfields` TEXT NOT NULL ,
	  INDEX (`pcid`)
	);";
	
	$wpdb->query($sql);

	}else
		$successful_install = 0;		
		
		
	$table_name = $wpdb->prefix . "amzps_pstyle";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		
	$sql = "CREATE TABLE " . $table_name . " (
	  `psid` mediumint( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	  `psname` varchar( 128 ) NOT NULL ,
	  `psborder` smallint( 2 ) DEFAULT '0' NOT NULL ,
	  `psbordercolor` varchar( 6 ) NOT NULL ,
	  `psmidborder` smallint( 2 ) DEFAULT '0' NOT NULL ,
	  `psmidbordercolor` varchar( 6 ) NOT NULL ,
	  `psmidbordertop` smallint( 2 ) DEFAULT '0' NOT NULL ,
	  `psmidbordertopcolor` varchar( 6 ) NOT NULL ,
	  `psbgcolortop` varchar( 6 ) NOT NULL ,
	  `psbgcolorleft` varchar( 6 ) NOT NULL ,
	  `psbgcolorright` varchar( 6 ) NOT NULL ,
	  `pstexttopsize` smallint( 3 ) DEFAULT '0' NOT NULL ,
	  `pstexttopcolor` varchar( 6 ) NOT NULL ,
	  `psfieldsize` smallint( 3 ) DEFAULT '0' NOT NULL ,
	  `psfieldcolor` varchar( 6 ) NOT NULL ,
	  `psfieldtextsize` smallint( 3 ) DEFAULT '0' NOT NULL ,
	  `psfieldtextcolor` varchar( 6 ) NOT NULL ,
	  `pslinktextstyle` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `pslinktextsize` smallint( 3 ) DEFAULT '0' NOT NULL ,
	  `pslinktextcolor` varchar( 6 ) NOT NULL ,
	  `pswidth` smallint( 3 ) DEFAULT '0' NOT NULL ,
	  `psadfloat` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `psleftwidth` smallint( 3 ) DEFAULT '0' NOT NULL ,
	  `psfieldinfowrap` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `psfieldtitlewrap` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `pstextimageorder` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `psheaderorder` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `pscontentorder` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `pscontentdisplay` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `pstextlinkheader` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `psenhbordercolor` varchar( 6 ) NOT NULL ,
	  `psenhimagesize` varchar( 3 ) NOT NULL ,
	  `psenhpricedisplay` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `psenhbgcolor` varchar( 6 ) NOT NULL ,
	  `psenhtextcolor` varchar( 6 ) NOT NULL ,
	  `psenhlinkcolor` varchar( 6 ) NOT NULL ,
	  `psroundcorners` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `psgradient` tinyint( 1 ) DEFAULT '0' NOT NULL
	);";
	
	$wpdb->query($sql);

	}else
		$successful_install = 0;

		
	$table_name = $wpdb->prefix . "amzps_padv";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		
	$sql = "CREATE TABLE " . $table_name . " (
	  `paid` mediumint( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	  `psid` mediumint( 9 ) DEFAULT '0' NOT NULL ,
	  `ppid` mediumint( 9 ) DEFAULT '0' NOT NULL ,
	  `pasid` mediumint( 9 ) DEFAULT '0' NOT NULL ,
	  `paname` varchar( 128 ) NOT NULL ,
	  `paasin` varchar( 255 ) NOT NULL ,
	  `patype` tinyint( 1 ) DEFAULT '0' NOT NULL ,

	  `patitletype` tinyint( 1 ) DEFAULT '0' NOT NULL ,
	  `patitle1` varchar( 255 ) NOT NULL ,
	  `patitle2` varchar( 255 ) NOT NULL ,
	  
	  `patarget` tinyint( 1 ) DEFAULT '0' ,


	  INDEX (`psid`),
	  INDEX (`ppid`),
	  INDEX (`paname`)
	);";
	
	$wpdb->query($sql);

	}else
		$successful_install = 0;			
		

		
	$table_name = $wpdb->prefix . "amzps_pupd";

	//if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	
	$query = "CREATE TABLE ".$table_name." (
			`puname` VARCHAR( 128 ) NOT NULL PRIMARY KEY ,
			`pures` BLOB NOT NULL  );
			";
	$wpdb->query($query);		
	//if(!$wpdb->query($query)) $successful_install = 0;
	//}else
	//	$successful_install = 0;

	
	if ($successful_install == 1)
	{
	
	register_setting( 'amzps_settings_group', 'amzps_assoc_id' );
	
	register_setting( 'amzps_settings_group', 'amzps_cb_assoc_id' );
	//1.5.4
	register_setting( 'amzps_settings_group', 'amzps_footer_link' );
	
		add_option("amzps_db_version", "01.5.4");
		
		
		add_option("amzps_assoc_id", "");
		
		//Added in 1.1
		add_option("amzps_last_update", time() - (60 * 60 * 25));
		//Added in 1.2
		add_option("amzps_cb_assoc_id", "");
		add_option("amzps_style_ids", "");
		add_option("amzps_styles", "");
		add_option("amzps_version_available", "1.5.5");
		//1.5.4
		add_option("amzps_footer_link", "0");
		
	$sql = "INSERT INTO `".$wpdb->prefix."amzps_pstyle` (`psid`, `psname`, `psborder`, `psbordercolor`, `psmidborder`, `psmidbordercolor`, `psmidbordertop`, `psmidbordertopcolor`, `psbgcolortop`, `psbgcolorleft`, `psbgcolorright`, `pstexttopsize`, `pstexttopcolor`, `psfieldsize`, `psfieldcolor`, `psfieldtextsize`, `psfieldtextcolor`, `pslinktextsize`, `pslinktextcolor`, `pslinktextstyle`, `pswidth`, `psadfloat`, `psleftwidth`, `psfieldinfowrap`, `psfieldtitlewrap`, `pstextimageorder`, `psheaderorder`, `pscontentorder`, `pscontentdisplay`, `pstextlinkheader`, `psenhbordercolor`, `psenhimagesize`, `psenhpricedisplay`, `psenhbgcolor`, `psenhtextcolor`, `psenhlinkcolor`) VALUES
(1, 'Default', 3, '9F8B72', 1, '9F8B72', 3, '9F8B72', 'F2DEC5', 'FFFFFF', 'F2F2F2', 15, '000000', 13, '000000', 12, '000000', 15, '0000FF', 0, 350, 0, 130, 0, 0, 0, 0, 0, 0, 1, 'FFFFFF', 'IS2', 1, 'FFFFFF', '000000', '000000'),
(2, 'Minimal', 0, 'FFFFFF', 1, '000000', 1, '8C8C93', 'FFFFFF', 'FFFFFF', 'FFFFFF', 16, '060625', 14, '01010F', 12, '02021E', 14, '0A0A43', 0, 400, 0, 150, 1, 0, 0, 0, 0, 0, 0, 'FFFFFF', 'IS2', 1, 'FFFFFF', '02021E', '0A0A43'),
(3, 'Style1', 3, '01010F', 0, 'FFFFFF', 1, '02021E', '060625', 'FFFFFF', 'CDCCC7', 24, 'FFFFFF', 14, '01010F', 12, '02021E', 24, 'FFFFFF', 0, 400, 0, 150, 1, 0, 0, 1, 0, 0, 1, 'FFFFFF', 'IS2', 1, 'FFFFFF', '02021E', '0A0A43'),
(4, 'Style2', 1, 'B3B296', 0, 'B3B296', 1, 'B3B296', 'EAE9D4', 'EAE9D4', 'DBDBDA', 24, '9698B3', 14, '0F102E', 12, '181A46', 24, '9698B3', 0, 400, 0, 150, 1, 0, 0, 2, 0, 0, 1, 'FFFFFF', 'IS2', 1, 'FFFFFF', '02021E', '0A0A43'),
(5, 'Style3', 1, '566807', 1, 'EAE9D4', 1, 'EAE9D4', '686207', 'ffffff', '566807', 24, 'FEEF07', 14, 'F2EC88', 12, 'FCF8AE', 24, 'FFFFFF', 0, 200, 0, 150, 1, 0, 0, 1, 0, 1, 1, 'FFFFFF', 'IS2', 1, 'FFFFFF', '02021E', '0A0A43')";


	
	$wpdb->query($sql);
	
	}
	
	}
	
}

function amzps_convert_version($version_number)
{
	$new_version = str_replace(".","", $version_number);
	return $new_version;
}

//Added in 1.4.0
function amzps_addbuttons() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
  // if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_amzps_tinymce_plugin");
     add_filter('mce_buttons', 'register_amzps_button');
  // }
}
 //Added in 1.4.0
function register_amzps_button($buttons) {
   array_push($buttons, "|", "amzps_button");
   return $buttons;
}
 
//Added in 1.4.0
function add_amzps_tinymce_plugin($plugin_array) {
	$amzps_site_url = site_url();
	$amzps_site_url .= '/';
	$amzps_url = str_replace($amzps_site_url, "", WP_PLUGIN_URL);
	$amzps_url = $amzps_url.'/product-style-amazon-affiliate-plugin/images/';
   $plugin_array['amzps'] = plugins_url("/js/amzps_tinymce.php?purl=".$amzps_url, __FILE__);
   return $plugin_array;
}

//Added in 1.4.0

function amzps_tinymce_html()
{
global $wpdb;
$ads = $wpdb->get_results('SELECT paid, paname FROM '.$wpdb->prefix.'amzps_padv', ARRAY_A);

echo '<div id="amzps-form"><table id="amzps-table" class="form-table">
			<tr>
				<th><label for="amzps-ad">Insert Ad</label></th>
			
			</tr>
			<tr>
				<td style="vertical-align:top;"><select name="ad" id="amzps-ad"><option value="">--Select an Advertisement';
					if (count($ads) > 0)
					{
						foreach ($ads as $var => $row)
						{
							echo '<option value="'.$row['paid'].'">#'.$row['paid'].'-'.stripslashes($row['paname']);
						}					
					}
				echo '</select><br />
				<small>select a styled ad to insert</small></td>
			</tr>
		</table>
		<p class="submit">
			<input type="button" id="amzps-submit" class="button-primary" value="Insert Ad" name="submit" />
		</p>
		</div>';
		
die();

					
}

function amzps_product_list_scripts(  ) {
 // wp_deregister_script('jquery'); 																			// using wp_deregister_script() to disable the version that comes packaged with WordPress
		wp_deregister_script('jquery-ui-core');
		//wp_deregister_script('jquery-ui-tabs');
		//wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'); 			// using wp_register_script() to register updated libraries (this example uses the CDN from Google but you can use any other CDN or host the scripts yourself)
		wp_register_script('jquery-ui-core', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js');
		//wp_enqueue_script('jquery');																				// using wp_enqueue_script() to load the updated libraries
		wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-tabs');
	  //wp_enqueue_script('jquery-ui-core');
	  wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-sortable');
  wp_enqueue_script('jquery-ui-draggable');
  wp_enqueue_script('jquery-ui-dialog');
 wp_enqueue_script( "amzps-product-list", plugins_url("/js/product_list.js", __FILE__), array( 'jquery' ), "1.0.46" );
}
function amzps_product_list_styles() {
 // wp_enqueue_style('jquery-ui-overcast', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-overcast/jquery-ui.css', '1.8.0');
   wp_register_style( "amzps-product-list-sort", 'http://jquery-ui.googlecode.com/svn/tags/1.8.12/themes/overcast/jquery-ui.css'); //plugins_url("/css/overcast/jquery-ui-1.8.12.custom.css", __FILE__), );
	wp_enqueue_style("amzps-product-list-sort");
	
   
}
function amzps_help_list_scripts(  ) {
	wp_deregister_script('jquery-ui-core');
	wp_register_script('jquery-ui-core', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script( "amzps-help-list", plugins_url("/js/help_list.js", __FILE__), array( 'jquery' ), "1.0.0" );
}
function amzps_help_list_styles() {
 // wp_enqueue_style('jquery-ui-overcast', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-overcast/jquery-ui.css', '1.8.0');
   wp_register_style( "amzps-help-styles", 'http://jquery-ui.googlecode.com/svn/tags/1.8.12/themes/overcast/jquery-ui.css'); //plugins_url("/css/overcast/jquery-ui-1.8.12.custom.css", __FILE__), );
	wp_enqueue_style("amzps-help-styles"); 
}
function amzps_footer(){
	global $wpdb;
	$show_link = get_option("amzps_footer_link");
	$cbid = get_option("amzps_cb_assoc_id");
	if ($show_link == "1" && $cbid != "")
		echo '<p style="text-align:center;">Powered by <a href="http://'.$cbid.'.amzps.hop.clickbank.net/?tid=pluginfooter" target="_blank">Amazon Wordpress Plugin - Product Style</a></p>';
	
	if ($show_link == "1" && $cbid == "")
		echo '<p style="text-align:center;">Powered by <a href="http://amzps.com/" target="_blank">Amazon Wordpress Plugin - Product Style</a></p>';
}
?>