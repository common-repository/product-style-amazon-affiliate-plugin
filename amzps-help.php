<?php
//******************************************//
//* Help Admin Page For Product Style *//
//******************************************//
function amzps_help_page() {


?>
 <style>

  </style>

<div class="wrap">
<?php echo amzps_admin_header_message(); ?>
<h2>Product Style - Help</h2>
<?php echo amzps_admin_header_menu(); ?>
<?php if ($status_message != "") { ?>
<div id="message" class="updated"><?php echo $status_message; ?></div>
<?php } ?>

<h3>F.A.Q.</h3>
<div id="help-accordion" style="font-size:120%;">
		
		<h3><a href="#" id="help-9">
			Extended Plugin Help & Information
		</a></h3>
		<div id="help-div-9">
			<u>Readme.pdf</u><br />
			There is a readme.pdf file included with this plugin - <a href="<?php echo WP_PLUGIN_URL."/product-style-amazon-affiliate-plugin/Product-Style-2-Full-Version-Guidebook.pdf"; ?>" target="_blank">Product Style Guidebook</a>. It contains complete information about this plugin including installation instructions, upgrade instructions, and information about all plugin features.
			<br /><br />
			If you find a bug with the plugin or have any other questions that are not answered here or in the readme.pdf file, please feel free to contact me at ryan@amzps.com
		</div>
		
		
		<h3><a href="#" id="help-9">
			How do I get the Commercial Version of the Product Style Plugin?
		</a></h3>
		<div id="help-div-9">
			<a href="http://stargeting.amzps.hop.clickbank.net/?tid=wphelp" target="_blank">Click Here To Get Product Style Commercial Version</a>
			<br /><br />
			The Commercial Version of the Product Style Plugin is a very robust tool that has an enormous amount of features beyond what is offered in this free version! Licenses are available for single domains or unlimited domains for a one-time fee.
			<br /><br />
			What can the Commercial Version do that the free version can't do?
			<br />
			<ul><li>Auto Amazon - Quickly create highly customized Amazon affiiate ads with images, automatically updating prices, and product information through your Wordpress site!</li>
			<li>Create More Ad Types - Image, Text Link, Buy Now Buttons & More.</li>
			<li>More Affiliate Sites - Supports all Amazon country sites, Clickbank, Commission Junction and even custom HTML code.</li>
			<li>Country Based Link Localization - Show different ads to your visitors based on their country!</li>
			<li>Create Comparison Charts - Using your existing product information and ads, easily generate complete comparison charts that can link to internal pages or directly to the affiliate products!</li>
			<li>Lifetime Upgrade Access - Product Style Plugin is still actively developed, so all plugin customers will receive all future updates for free.</li></ul>
		</div>
		
		<h3><a href="#" id="help-1">
			What do I do when I first install the Product Style plugin?
		</a></h3>
		<div id="help-div-1">
			<u>Initial Plugin Set Up</u>
			<ol><li>Enter your Amazon.com affiliate account information on the <i>Settings</i> page.</li>
			<li>Enter ClickBank affiliate ID to promote the Pro version of the Product Style plugin (optional).</li>
			<li>Create style settings for displaying your advertisements using the <i>Styles</i> page.</li>
			<li>Publish <i>Styles</i> when changes have been made or after new version updates. Check the box beside each <i>Style</i> that you want to make live on your site and click the Publish button to save.</li>
			</ol>
			<br /><br /><b>At the very least, you will need to specify your Amazon.com affiliate ID on the settings page and Publish the default Styles on the Styles page to get ads running with the plugin.</b>
		</div>
		<h3><a href="#" id="help-2">
			How do I create an Advertisement?
		</a></h3>
		<div id="help-div-2">
			<u>Creating Advertisements</u>
			<br />When you create an ad with the plugin, you will need to select Product Information and a Style to use for the ad.
			<br />There are default Styles that you can use, but you must create an entry on the Products page to use with each ad. One Product entry can be used on numerous ads.
			
			<br /><br />
			<u>Minimum Ad Information Required</u>
			<ul><li><b>Ad Name</b> - A name for your own reference</li>
			<li><b>Product ASIN / ID</b> - Product identification. For Amazon products, this is the ASIN for the product.</li>
			<li><b>Ad Site</b> - Automatically set to Amazon.com (others available in <a href="http://amzps.com/" target="_blank">Pro Version</a>)</li>
			<li><b>Style</b> - Select the saved Style the use for this ad.</li>
			<li><b>Product</b> - Select the saved Product information to use for this ad.</li>
			<li><b>Ad Type</b> - <a href="http://amzps.com/" target="_blank">Pro Version</a> Only - Basic Version Uses Enhanced Amazon Ads Only</li>
			<li><b>Header Title #1</b> - This text will be displayed in the head of the ad box that the plugin generates (may also display Header Title #2 if Double Header Titles is set).</li>
			</ul>
		</div>
		<h3><a href="#" id="help-3">
			How do I create Product Information?
		</a></h3>
		<div id="help-div-3">
			<u>Creating Product Information</u>
			<br />All ads and comparison charts are generated from saved product information, so you need to create product information for each affiliate item that you wish to promote.
			<br />This process was heavily modified in version 1.5.0.
			<ol><li>Go to the <i>Products</i> page.</li>
			<li>Create a Product Category (Click the "New Category" button, then provide a Category Name).</li>
			<li>Click on the new Category that appears to expose a "New Product" button - click it to enter information for a new Product.</li>
			<li>Provide a Product Name.</li>
			<li>Click on "New Field" to create a new information field for the Category/Product. All Fields that you create apply to all Products within the same Category, so create a new Category when you need to use different Fields.</li>
			<li>Name the Field. For example, if this Field will be showing the wattage of a microwave, you would probably name the Field "Watts". This information goes in the first box that appears, which says "New Field".</li>
			<li>Enter the Field Information in the blank box to the right of the Field name that you just entered. Using the previous example, you might enter something like "250" or "250w" for the Field Information.</li>
			<li>Save the Product once you have entered the information you want displayed with this Product.</li>
			</ol>
		</div>
		<h3><a href="#" id="help-4">
			Do I have to enter Product Information for every ad I create?
		</a></h3>
		<div id="help-div-4">
			<u>Product Information For Ads</u><br />
			Yes. You should create product information for each ad you create, although multiple ads can use the same product information.
			<br /><br />
			The only time you will not need product information for an ad is if the specified Style for that ad does not show the product information, however, you still need to select a product information entry (any will do because it won't be displayed).
			<br /><br />
			The <a href="http://amzps.com/" target="_blank">Pro Version of the Product Style Plugin</a> has many more ad type options that allows ads to be created without product information.
		</div>
		<h3><a href="#" id="help-5">
			How do I create a Comparison Chart?
		</a></h3>
		<div id="help-div-5">
			<u>Creating Comparison Charts</u><br />
			Comparison Charts are only enabled in the <a href="http://amzps.com/" target="_blank">Pro Version of the Product Style Plugin</a>.
		</div>
		<h3><a href="#" id="help-6">
			I have created ads. How do I show them on my website?
		</a></h3>
		<div id="help-div-6">
			<u>Ad & Chart Display</u><br />
			Once you have created an advertisement with the plugin or comparison charts, it's extremely easy to insert them anywhere you want on your site.
			<br /><br />
			<u>Insert Into Posts & Pages</u>
			<br />
			There is a Product Style icon button located in the Wordpress editor in the "View" tab and also an "Insert Style Ad..." drop down box in the "HTML" tab.
			<br />
			<br />
			<u>Insert Into Text Widgets</u>
			<br />
			The plugin supports ads in text widgets, but you will have to enter the shortcode manually for any ads you want to use in widgets. 
			See the next FAQ on shortcodes for more information.
		</div>
		<h3><a href="#" id="help-7">
			What are shortcodes and how are they used with the Product Style plugin?
		</a></h3>
		<div id="help-div-7">
			<u>What is a shortcode?</u>
			<br />A shortcode is a special piece of text that you can type into posts, pages and widgets to display advertisements from this plugin.
			Other plugins can use shortcodes too, so it's really special text within the shortcode that makes everything work. All shortcodes are enclosed in characters that you probably wouldn't use in normal writing: <b>[]</b>
			<br />
			<br /><u>Product Style Shortcodes</u>
			<br />
			Each type of shortcode also has a name, which is put inside of those characters.<br />
			This plugin uses one shortcode.<br />
			<b>Ad Shortcode</b>: [amzps]<br /><br />
			This shortcode requires one parameter, which is the ID number of the ad.
			<br />
			The ID parameter is used with the shortcode like this:
			<b>[amzps id="1"]</b>
			<br /><br />
			<u>Customizing Ad Shortcodes</u>
			<br />This information only applies to ad shortcodes.
			
			There are additional shortcode parameters that can be used to change particular features about an advertisement. These parameters can be extremely useful if you just want to change a few minor things about an ad, so you don't have an create another ad or another style.
			<br /><br /><b>Additional Shortcode Parameters</b>
			<br /><b>header_order</b> - Manual override parameter for the 'Header Order' setting on the Style creation page. Accepts these values: "top", "bottom" or "off" (Value represents the header position
			<br /><b>content_order</b> - Manual override parameter for the 'Ad & Fields Order' setting on the Style creation page. Accepts these values: "ads" or "fields" (Value used will be first box displayed on left)
			<br /><b>content_display</b> - Manual override parameter for the 'Ad & Fields Display' setting on the Style creation page. Accepts these values: "both", "ads" or "fields" (Value determines what content will be shown)
			<br /><b>header_link</b> - Manual override parameter for the 'Turn Header Text Into Link' setting on the Style creation page. Accepts these values: "no", "yes" or "yespv" (Value determines if link is turned into header - "yespv" value is Yes with Amazon Preview link hover)
		</div>
	
		
		<h3><a href="#" id="help-9">
			I love the Product Style plugin, and it's helped me a lot. Can I send the developer a donation?
		</a></h3>
		<div id="help-div-9">
			My name is Ryan Stevenson, the sole developer of the Product Style Plugin. I work online for a living to provide for my wife and three kids, so I greatly appreciate any donations that you may be willing to offer.
			<br /><br />
			However, before you decide to donate something, have you already purchased the <a href="http://stargeting.amzps.hop.clickbank.net/?tid=wpdonation" target="_blank">Commercial Version of the Product Style Plugin</a>? I would honestly prefer if you purchased the plugin instead of making a donation, that way we both receive some kind of benefit. I know you've probably received a lot of use out of the free version, but it's my gift to you!
			<br /><br />
			Still want to send me a donation?
			<br /><br />
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3KX5DB4PU8HTC">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

		</div>
		

	</div>
</div>
<?php } ?>