<?php
//************************************//
//* Main Admin Page For Product Style *//
//************************************//
function amzps_main_page() {
global $wpdb;
$header_menu = amzps_admin_header_menu();
$update_info = $wpdb->get_row("SELECT pures FROM ".$wpdb->prefix."amzps_pupd where puname = 'amzps_update'", ARRAY_A);
if (!isset($update_info['pures']))
{
	update_option("amzps_last_update", time() - (25 * 60 * 60));
	$update_info['pures'] = "Plugin information pending. Please check back soon.";
}
if (isset($_GET['action']))
{
if ($_GET['action'] == "update")
{
	if (get_option("amzps_last_update") > (time() - (60 * 60)))
	{
	$status_message = "You can only try a manual update every 60 minutes.";
	}else{
		global $amzps_key;
		amzps_update($amzps_key, 1);
		$status_message = "Plugin Information refreshed successfully.";
	}
}
}

	
?>
<div class="wrap">
<?php echo amzps_admin_header_message(); ?>
<h2>Product Style Version 1.7 Basic</h2>
<?php echo $header_menu; ?>
<?php if ($status_message != "") { ?>
<div id="message" class="updated"><?php echo $status_message; ?></div>
<?php } ?>
<div style="width:700px;border-top:1px dashed #000000;border-left:1px dashed #000000;border-right:1px dashed #000000;margin:8px;background-color:#FFFFFF;margin-bottom:25px;">
<div style="padding:10px;background-color:#999999;font-size:18px;font-weight:bold;color:#802222;">Product Style General Info & Free Amazon Affiliate Niche Research eBook</div>
<div style="padding:20px;background-color:#FFFFFF;border-bottom:1px dashed #000000;">Hi, My name is Ryan Stevenson, the developer of the <i>Product Style Plugin</i>. If you have questions or problems with this plugin, please feel free to contact me at: <b>ryan@amzps.com</b>
<br /><br />
If you need help with using this plugin, take a look at the included <a href="<?php echo WP_PLUGIN_URL."/product-style-amazon-affiliate-plugin/Product-Style-2-Full-Version-Guidebook.pdf"; ?>" target="_blank">Product Style Guidebook</a>.
<br /><br />
Also, to sort out any confusion about the plugin, there are actually two versions that are quite different. You are using the free version of the Product Style plugin, but there is also a commercial version of the plugin. The free version is completely functional without any kind of limits. The commercial version offers many more powerful features for serious Amazon affiliates (see bottom of page for more information). As a result, you may notice some features in the Guidebook above that are not included in this free version of the plugin.
<br /><br />
<br /><br />
I have been working online for a living for over 15 years. I put together an excellent ebook on how to find a niche Amazon affiliate market that I would like to give to you, absolutely free! This ebook is a superb guide to finding new niche markets as well as building Amazon affiliate websites.
<br /><br />
<br /><br />
Just enter your name and email address in the form below to join my free affiliate tips and strategies newsletter and get instant access to my ebook. You <u>will not</u> get spammed by joining my newsletter, and you can unregister at any time.
<div style="float:left;padding:10px;width:150px;margin-left:10px;margin-right:10px;"><img src="http://supertargeting.com/how-to-find-a-niche-market.jpg" border="0" /></div>
<div style="float:left;width:370px;"><!-- AWeber Web Form Generator 3.0 -->
<style type="text/css">
#af-form-1125978417 .af-body .af-textWrap{width:98%;display:block;float:none;}
#af-form-1125978417 .af-body a{color:#094C80;text-decoration:underline;font-style:normal;font-weight:normal;}
#af-form-1125978417 .af-body input.text, #af-form-1125978417 .af-body textarea{background-color:#FFFFFF;border-color:#919191;border-width:1px;border-style:solid;color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:12px;font-family:Verdana, sans-serif;}
#af-form-1125978417 .af-body input.text:focus, #af-form-1125978417 .af-body textarea:focus{background-color:#FFFAD6;border-color:#030303;border-width:1px;border-style:solid;}
#af-form-1125978417 .af-body label.previewLabel{display:block;float:none;text-align:left;width:auto;color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:12px;font-family:Verdana, sans-serif;}
#af-form-1125978417 .af-body{padding-bottom:15px;padding-top:15px;background-repeat:no-repeat;background-position:inherit;background-image:none;color:#000000;font-size:11px;font-family:Verdana, sans-serif;}
#af-form-1125978417 .af-header{padding-bottom:9px;padding-top:9px;padding-right:10px;padding-left:10px;background-image:url('http://forms.aweber.com/images/auto/body/009/5ff/005/999');background-position:top left;background-repeat:repeat-x;background-color:#005999;border-width:1px;border-bottom-style:none;border-left-style:none;border-right-style:none;border-top-style:none;color:#FFFFFF;font-size:16px;font-family:Verdana, sans-serif;}
#af-form-1125978417 .af-quirksMode .bodyText{padding-top:2px;padding-bottom:2px;}
#af-form-1125978417 .af-quirksMode{padding-right:15px;padding-left:15px;}
#af-form-1125978417 .af-standards .af-element{padding-right:15px;padding-left:15px;}
#af-form-1125978417 .bodyText p{margin:1em 0;}
#af-form-1125978417 .buttonContainer input.submit{background-image:url("http://forms.aweber.com/images/auto/gradient/button/07c.png");background-position:top left;background-repeat:repeat-x;background-color:#0057ac;border:1px solid #0057ac;color:#FFFFFF;text-decoration:none;font-style:normal;font-weight:normal;font-size:14px;font-family:Verdana, sans-serif;}
#af-form-1125978417 .buttonContainer input.submit{width:auto;}
#af-form-1125978417 .buttonContainer{text-align:right;}
#af-form-1125978417 body,#af-form-1125978417 dl,#af-form-1125978417 dt,#af-form-1125978417 dd,#af-form-1125978417 h1,#af-form-1125978417 h2,#af-form-1125978417 h3,#af-form-1125978417 h4,#af-form-1125978417 h5,#af-form-1125978417 h6,#af-form-1125978417 pre,#af-form-1125978417 code,#af-form-1125978417 fieldset,#af-form-1125978417 legend,#af-form-1125978417 blockquote,#af-form-1125978417 th,#af-form-1125978417 td{float:none;color:inherit;position:static;margin:0;padding:0;}
#af-form-1125978417 button,#af-form-1125978417 input,#af-form-1125978417 submit,#af-form-1125978417 textarea,#af-form-1125978417 select,#af-form-1125978417 label,#af-form-1125978417 optgroup,#af-form-1125978417 option{float:none;position:static;margin:0;}
#af-form-1125978417 div{margin:0;}
#af-form-1125978417 fieldset{border:0;}
#af-form-1125978417 form,#af-form-1125978417 textarea,.af-form-wrapper,.af-form-close-button,#af-form-1125978417 img{float:none;color:inherit;position:static;background-color:none;border:none;margin:0;padding:0;}
#af-form-1125978417 input,#af-form-1125978417 button,#af-form-1125978417 textarea,#af-form-1125978417 select{font-size:100%;}
#af-form-1125978417 p{color:inherit;}
#af-form-1125978417 select,#af-form-1125978417 label,#af-form-1125978417 optgroup,#af-form-1125978417 option{padding:0;}
#af-form-1125978417 table{border-collapse:collapse;border-spacing:0;}
#af-form-1125978417 ul,#af-form-1125978417 ol{list-style-image:none;list-style-position:outside;list-style-type:disc;padding-left:40px;}
#af-form-1125978417,#af-form-1125978417 .quirksMode{width:431px;}
#af-form-1125978417.af-quirksMode{overflow-x:hidden;}
#af-form-1125978417{background-color:#F0F0F0;border-color:#CFCFCF;border-width:1px;border-style:solid;}
#af-form-1125978417{overflow:hidden;}
.af-body .af-textWrap{text-align:left;}
.af-body input.image{border:none!important;}
.af-body input.submit,.af-body input.image,.af-form .af-element input.button{float:none!important;}
.af-body input.text{width:100%;float:none;padding:2px!important;}
.af-body.af-standards input.submit{padding:4px 12px;}
.af-clear{clear:both;}
.af-element label{text-align:left;display:block;float:left;}
.af-element{padding:5px 0;}
.af-form-wrapper{text-indent:0;}
.af-form{text-align:left;margin:auto;}
.af-header{margin-bottom:0;margin-top:0;padding:10px;}
.af-quirksMode .af-element{padding-left:0!important;padding-right:0!important;}
.lbl-right .af-element label{text-align:right;}
body {
}
</style>
<form method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl"  >
<div style="display: none;">
<input type="hidden" name="meta_web_form_id" value="1125978417" />
<input type="hidden" name="meta_split_id" value="" />
<input type="hidden" name="listname" value="supertargeting" />
<input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=video" id="redirect_27581813a9cfefb67c288ade8b5490c3" />

<input type="hidden" name="meta_adtracking" value="SuperTargeting_Wordpress_Free_Plugin" />
<input type="hidden" name="meta_message" value="1" />
<input type="hidden" name="meta_required" value="name,email" />

<input type="hidden" name="meta_tooltip" value="" />
</div>
<div id="af-form-1125978417" class="af-form"><div id="af-header-1125978417" class="af-header"><div class="bodyText"><p style="text-align: center;"><strong>Grab My Free Niche Research eBook &amp; Join My Free Niche Affiliate Marketing Newsletter</strong></p></div></div>
<div id="af-body-1125978417" class="af-body af-standards">
<div class="af-element">
<label class="previewLabel" for="awf_field-24294298">Name: </label>
<div class="af-textWrap">
<input id="awf_field-24294298" type="text" name="name" class="text" value=""  tabindex="500" />
</div>
<div class="af-clear"></div></div>
<div class="af-element">
<label class="previewLabel" for="awf_field-24294299">Email: </label>
<div class="af-textWrap"><input class="text" id="awf_field-24294299" type="text" name="email" value="" tabindex="501"  />
</div><div class="af-clear"></div>
</div>
<div class="af-element buttonContainer">
<input name="submit" class="submit" type="submit" value="Submit" tabindex="502" />
<div class="af-clear"></div>
</div>
</div>
</div>
<div style="display: none;"><img src="http://forms.aweber.com/form/displays.htm?id=jIxMrJzsHCyM7A==" alt="" /></div>
</form>
<script type="text/javascript">
    <!--
    (function() {
        var IE = /*@cc_on!@*/false;
        if (!IE) { return; }
        if (document.compatMode && document.compatMode == 'BackCompat') {
            if (document.getElementById("af-form-1125978417")) {
                document.getElementById("af-form-1125978417").className = 'af-form af-quirksMode';
            }
            if (document.getElementById("af-body-1125978417")) {
                document.getElementById("af-body-1125978417").className = "af-body inline af-quirksMode";
            }
            if (document.getElementById("af-header-1125978417")) {
                document.getElementById("af-header-1125978417").className = "af-header af-quirksMode";
            }
            if (document.getElementById("af-footer-1125978417")) {
                document.getElementById("af-footer-1125978417").className = "af-footer af-quirksMode";
            }
        }
    })();
    -->
</script>

<!-- /AWeber Web Form Generator 3.0 -->
</div><div style="clear:both;"></div>
</div></div>
<div style="width:700px;border-top:1px dashed #000000;border-left:1px dashed #000000;border-right:1px dashed #000000;margin:8px;background-color:#FFFFFF;margin-bottom:25px;">
<div style="padding:10px;background-color:#999999;font-size:18px;font-weight:bold;color:#802222;">Upgrade to Product Style 2</div>
<div style="padding:20px;background-color:#FFFFFF;border-bottom:1px dashed #000000;">
The <i>Product Style Plugin</i> is something I originally developed for my <u>own</u> Amazon affiliate websites, but I have now made it available to the general public.
<br /><br />
You are using the free (basic) version of the plugin, but there is also a commercial version available that does so much more.
<br /><br />
The basic version gives you an idea of what the full version can do, except the full version has many more <u>powerful</u> features and capabilities.
<br /><br />
<b>What do you get for upgrading to the full version of the <i>Product Style Plugin?</i></b><br />
<ul style="list-style-type:circle;"><li style="margin-bottom:5px;"><b>Amazon API</b> - There are other plugins that use Amazon API, but you've never seen it like this before. Quickly create <u>customized</u> Amazon affiliate ads with the click of a button.</li>
<li style="margin-bottom:5px;"><b>Comparison Charts</b> - Combined product ads into comparison charts that can be styled just like ads.</li>
<li style="margin-bottom:5px;"><b>More Ad Types</b> - Create image or text ads instead of Amazon Enhanced ads.</li>
<li style="margin-bottom:5px;"><b>More Affiliate Networks</b> - Product Style's Auto Amazon features work with any of the Amazon country sites. You can also manually create ads with Clickbank, Commission Junction or any other affiliate program.</li>
<li style="margin-bottom:5px;"><b>Link Localization</b> - Want to promote Amazon.com products to USA visitors, Amazon.co.uk products to UK & Europe visitors, and Clickbank products to everyone else? Product Style can do it!</li>
</ul>

<center><a href="http://stargeting.amzps.hop.clickbank.net/?tid=wp" target="_blank" title="Buy Product Style Pro Here" style="text-decoration:none;"><img src="http://supertargeting.com/down-arrows.gif" border="0" style="margin-bottom:10px;"><br /><span style="font-weight:bold;font-size:30px;">Buy Product Style Full Version Here</span></a></center>
</div></div>
<div style="border-top:1px dashed #000000;border-left:1px dashed #000000;border-right:1px dashed #000000;margin:8px;background-color:#FFFFFF;">
<div style="padding:10px;background-color:#999999;font-size:18px;font-weight:bold;color:#802222;">Plugin Information <span style="font-size:14px;font-weight:normal;"> - Refreshed Every 24 Hours<br />(Last Updated: <?php echo date("m/d/Y H:i:s", get_option("amzps_last_update")); ?> - <a href="admin.php?page=amzps&action=update">Try Now</a>)</span></div>
<div style="padding:10px;background-color:#FFFFFF;border-bottom:1px dashed #000000;">
<?php echo html_entity_decode($update_info['pures']); ?>
</div></div>
</div>
<?php
}
?>