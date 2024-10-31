<?php header('Content-type: text/javascript');
if ($_GET['purl'] == "") exit;
$imageURL = "../".$_GET['purl']."photo.png";
?>// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.amzps', {
		// creates control instances based on the control's id.
		// our button's id is "amzps_button"
		createControl : function(id, controlManager) {
			if (id == 'amzps_button') {
				// creates the button
				var c=this;
				var button = controlManager.createButton('amzps_button', {
					title : 'Insert Ads', // title of the button
					image : '<?php echo $imageURL; ?>',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 1200 < width ) ? 1200 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert Product Style Ads', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=amzps-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	tinymce.PluginManager.add('amzps', tinymce.plugins.amzps);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		jQuery.post(ajaxurl, {
			action: "amzps_tinymce_html"								
			}, function(data) {
							  
							  
							  
							  
								
		var form = jQuery(data);
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#amzps-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			/*var options = { 
				'id'         : '',
				'size'       : 'thumbnail',
				'orderby'    : 'menu_order ASC, ID ASC',
				'itemtag'    : 'dl',
				'icontag'    : 'dt',
				'captiontag' : 'dd',
				'link'       : '',
				'include'    : '',
				'exclude'    : '' 
				};
			*/
			var shortcode = '';
			var scbase = '[amzps';
			
			/*for( var index in options) {
				var value = table.find('#amzps-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			*/
			
			var adID = jQuery("#amzps-ad").val();
		
			if (adID != '')
			{
				shortcode = scbase + ' id="' + adID + '"'; 
	
				shortcode += ']';
			}
	
			jQuery('#amzps-ad').find('option:first').attr('selected', 'selected').parent('select');

			//shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
			 });
		});
	});
})()