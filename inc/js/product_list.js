jQuery(document).ready( function($) {
	var delField = function() {
		var li = $(this).closest('li');
		$( "#delete-field" ).dialog({
			autoOpen: true,
			width: 300,
			modal: true,
			buttons: {
				"Delete Field": function() {
					//var bValid = true;
					//allFields.removeClass( "ui-state-error" );

					//bValid = bValid && checkLength( pcname, "Category Name", 1, 128 );
					//bValid = bValid && checkLength( email, "email", 6, 80 );
					//bValid = bValid && checkLength( password, "password", 5, 16 );

					//bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

					//if ( bValid ) {
					$.post(ajaxurl, {
						action: "amzps_products_delete_field",
						pfid: li.attr("id").substr(13)
					}, function(data) {
						li.fadeOut('slow', function() {$(this).remove();});
					});
									
						$( this ).dialog( "close" );
					//}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		
	}
	var delProduct = function() {
		var li = $(this).parent();
		$( "#delete-product" ).dialog({
			autoOpen: true,
			width: 300,
			modal: true,
			buttons: {
				"Delete Product": function() {
					//var bValid = true;
					//allFields.removeClass( "ui-state-error" );

					//bValid = bValid && checkLength( pcname, "Category Name", 1, 128 );
					//bValid = bValid && checkLength( email, "email", 6, 80 );
					//bValid = bValid && checkLength( password, "password", 5, 16 );

					//bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

					//if ( bValid ) {
					$.post(ajaxurl, {
						action: "amzps_products_delete_product",
						ppid: li.attr("id").substr(8)
					}, function(data) {
						$("#product-" + li.attr("id").substr(8)).fadeOut('slow', function() {$(this).remove();});
					});
												
						$( this ).dialog( "close" );
					//}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
	
	}
	

	
	
	
	
	
	
	
	var editProduct = function() {	
					var li = $(this).parent();
					//var ul = li.parent();
					$.post(ajaxurl, {
						action: "amzps_products_edit_products",
						ppid:  li.attr("id").substr(8)//,
						//pcid:  ul.attr("id").substr(13)
					}, function(data) {
						//jQuery("#category-list").hide();
						jQuery("#product-edit").show();
						
						$("#product-edit").html(data);
						//$("#product-edit").html($(data));
						//$('.ajaxsave').hide();
						 var fieldList = $('#productfield_list');
						 fieldList.sortable({ });
						 
						$("li.fieldproduct-name-new a").button().click( function() {
							var li = $(this).parent();
							$.post(ajaxurl, {
								action: "amzps_products_create_field",
								pcid:  li.attr("id").substr(17)//,
								//pcid:  ul.attr("id").substr(13)
							}, function(response) {
								$("#productfield_list").append(response);
								$( "a.fieldproduct-delete" ).click(delField);
							});
						});
						$( "a.fieldproduct-delete" ).click(delField);
						$( "#product-edit" ).dialog( "open" );
					});

				}
				
			
	var catAccOptions = {
		autoHeight:false,
		clearStyle:true,
		collapsible:true,
		active:false,
		
		changestart: function(e, ui) {
			var cID = ui.newHeader.find("a").attr('id').substr(11);
			$.post(ajaxurl, {
				action: "amzps_products_list_categories",
				catID:  cID
			  }, function(data) {
				//$("#cat-div-" + cID).html($(data));
				$("#cat-div-" + cID).html(data);
				$( "li.product-name a.product-name-link" )
					.click(editProduct); 
				$( "li.product-name a.product-name-link-button" ).button().click(editProduct); 
				$( "li.product-name a.product-delete-link-button" ).button().click(delProduct);
				
				$( "li.product-hover" ).bind("mouseover", function(){         
            $(this).stop();
			$(this).css('background-color',"#EEEEEE");             
			 }).bind("mouseout", function(){         
				// $(this).stop();
				 $(this).animate({ 
					  backgroundColor: "#CCCCCC"
				}, 'normal' ); 
				});
			});			
		},
		change: function(e, ui) {
			
		}
	};	
	
	
	$( "li.product-name a.product-name-link" ).click(editProduct); 
	$( "li.product-name a.product-name-link-button" ).button().click(editProduct); 
	$( "li.product-name a.product-delete-link-button" ).button().click(delProduct);
	$( "li.product-hover" ).bind("mouseover", function(){         
           $(this).stop();
			$(this).css('background-color',"#CCCCCC");             
			 }).bind("mouseout", function(){         
				 //$(this).stop();
				 $(this).animate({ 
					  backgroundColor: "#999999"
				}, 'normal' ); 
				});
	
	
	$( "#product-edit" ).dialog({
							autoOpen: false,
							width: 650,
							modal: true,
							buttons: {
								"Save Product": function() {
									var bValid = true;
									//allFields.removeClass( "ui-state-error" );
									$("#ppnameError").hide();
									
									
									var ppname = jQuery("#ppname").val();
									var pcid = jQuery("#pcid").val();
									var ppid = jQuery("#ppid").val();
									var productState = jQuery("#productState").val();
									
									if (ppname == "")
										bValid = false;
									
									//bValid = bValid && checkLength( jQuery("#ppname"), "Product Name", 1, 255 );
									//bValid = bValid && checkLength( email, "email", 6, 80 );
									//bValid = bValid && checkLength( password, "password", 5, 16 );

									//bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
									// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
									//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
									//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

									if ( bValid ) {
										//var saveError = false;
										
										
										/*if (nameData == '')
										{
											saveError = true;
											$("#pcpname_error").show();
										}*/
													
										var fieldidData = '';
										$(".fieldid").each(function() {
										
											fieldidData = fieldidData + $(this).val() + ',';
										
										});
										if (fieldidData == '')
										{
											//saveError = true;
											//$("#field_error").show();
										}else{
											fieldidData = fieldidData.substr(0, fieldidData.length - 1);
											
											var fieldData = '';
											$(".fieldname").each(function() {
											
												fieldData = fieldData + $(this).val() + ',,,';
											
											});
											if (fieldData == '')
											{
											//	saveError = true;
											//	$("#field_error").show();
											}else
											fieldData = fieldData.substr(0, fieldData.length - 3);
											
											var adData = '';
											$(".fielddata").each(function() {
											
												adData = adData + $(this).val() + ',,,';
											
											});
											if (adData == '')
											{
												//saveError = true;
												//$("#ad_error").show();
											}else
											adData = adData.substr(0, adData.length - 3);
											
										}
										
										
										/*if (saveError)
										{
											
											jQuery(".ajaxsave").hide();
											jQuery("#productFormSubmit").show();
											jQuery("#productFormCancel").show();
											$("createProduct_error").show();
											return false;
										}*/
										
										if (productState == "edit")
										{
													var data2 = {
														action: 'amzps_save_product',
														fieldData: fieldData,
														fieldidData: fieldidData,
														adData: adData,
														ppname: ppname,
														pcid: pcid,
														ppid: ppid,
														productState: productState
													};
										}else{
													var data2 = {
														action: 'amzps_save_product',
														fieldData: fieldData,
														fieldidData: fieldidData,
														adData: adData,
														ppname: ppname,
														pcid: pcid,
														productState: productState
													};
										}
											
										jQuery.post(ajaxurl, data2,
													function(response){	
														//jQuery("#chartFormSubmit").show();
														//jQuery("#product-edit").hide();
														//jQuery("#category-list").show();
														if (productState == "edit")
															$("#product-" + pcid + "-" + ppid).remove();
														jQuery("#product-list-" + pcid).append(response);
														//jQuery(".ajaxsave").hide();
														
														$( "li.product-name a.product-name-link" )
																	.click(editProduct); 
														$( "li.product-name a.product-name-link-button" ).button().click(editProduct); 
														$( "li.product-name a.product-delete-link-button" ).button().click(delProduct);			
														$( "li.product-hover" ).bind("mouseover", function(){         
														$(this).stop();
														$(this).css('background-color',"#EEEEEE");             
														 }).bind("mouseout", function(){         
															// $(this).stop();
															 $(this).animate({ 
																  backgroundColor: "#CCCCCC"
															}, 'normal' ); 
															});
													});	
													
										
									
										
													
										$( this ).dialog( "close" );
									}else
										$("#ppnameError").show();
								},
								Cancel: function() {
									$( this ).dialog( "close" );
								}
							},
							close: function() {
								//allFields.val( "" ).removeClass( "ui-state-error" );
							}
						});

						

	
	$("#category-accordion").accordion(catAccOptions);
  
  
		//$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		//var pcname = $( "#pcname" );
		/*
			allFields = $( [] ).add( pcname ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		*/
		$( "#category-create" ).dialog({
			autoOpen: false,
			width: 450,
			modal: true,
			buttons: {
				"Save New Category": function() {
					var bValid = true;
					$("#catNameError").hide();
					//allFields.removeClass( "ui-state-error" );
					if ($("#pcname").val() == "")
						bValid = false;
					//bValid = bValid && checkLength( pcname, "Category Name", 1, 128 );
					//bValid = bValid && checkLength( email, "email", 6, 80 );
					//bValid = bValid && checkLength( password, "password", 5, 16 );

					//bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
					//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

					if ( bValid ) {
						var cdata = {
										action: 'amzps_products_create_category',
										pcname: $("#pcname").val()
									};
							
						jQuery.post(ajaxurl, cdata,
									function(response){	
										$("#category-accordion").append(response).accordion('destroy').accordion(catAccOptions);;
										$( "li.product-name a.product-name-link" ).click(editProduct); 
										$( "li.product-name a.product-name-link-button" ).button().click(editProduct); 
										$( "li.product-name a.product-delete-link-button" ).button().click(delProduct);
										$( "li.product-hover" ).bind("mouseover", function(){         
										$(this).stop();
										$(this).css('background-color',"#EEEEEE");             
										 }).bind("mouseout", function(){         
											// $(this).stop();
											 $(this).animate({ 
												  backgroundColor: "#CCCCCC"
											}, 'normal' ); 
											});
									});	
									
						$( this ).dialog( "close" );
					}else
						$("#catNameError").show();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( ".new-category a" )
			.button()
			.click(function() {
				$( "#category-create" ).dialog( "open" );
			});


});

						

