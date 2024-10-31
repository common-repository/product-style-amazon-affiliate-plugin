<?php
/*
Plugin Name: Product Style Amazon Affiliate Plugin
Plugin URI: http://productstyleplugin.com/
Description: An easy to use but complex Amazon affiliate advertising Wordpress plugin that goes way beyond traditional Amazon Associates ads. Instead of showing a standard affiliate advertisement, you can style them to match the look of any website design. These styled Amazon affiliate ads are then displayed with product information to deliver extremely useful ads to your website visitors that also boost search engine rankings. This Wordpress plugin is designed to work with the Amazon.com Associates Program to give affiliates a convenient way to create ads with useful, search engine optimized content that help encourage better search rankings, click through rates, and conversion rates compared with standard ad types available from Amazon.
Version: 1.7
Author: Ryan Stevenson
Author URI: http://supertargeting.com/
License: GPLv2
Copyright (C) 2011 Ryan Stevenson

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

You must give attribution to the author if you reuse this work: Ryan Stevenson - SuperTargeting.com

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
?>
<?php
include("inc/functions.inc.php");
include("inc/update.php");
include("amzps-settings.php");
include("amzps-ads.php");
include("amzps-categories.php");
include("amzps-main.php");
include("amzps-styles.php");
include("amzps-help.php");
include("inc/update2.php");
global $amzps_key;
if (is_admin())
	amzps_update($amzps_key);
	
add_action('wp_head', 'amzps_wp_head');
//add_action('init', 'amzps_addbuttons');
add_action('admin_init', 'amzps_addbuttons');
add_action('wp_ajax_amzps_tinymce_html', 'amzps_tinymce_html');
add_action('wp_ajax_amzps_products_list_categories', 'amzps_products_list_categories');
add_action('wp_ajax_amzps_products_edit_products', 'amzps_products_edit_products');
add_action('wp_ajax_amzps_save_product', 'amzps_save_product');
add_action('wp_ajax_amzps_products_create_category', 'amzps_products_create_category');
add_action('wp_ajax_amzps_products_create_field', 'amzps_products_create_field');
add_action('wp_ajax_amzps_products_delete_field', 'amzps_products_delete_field');
add_action('wp_ajax_amzps_products_delete_product', 'amzps_products_delete_product');
add_action('wp_footer', 'amzps_footer');
add_shortcode('amzps', 'amzps_shortcode');
add_filter('widget_text', 'do_shortcode');
add_filter('admin_footer', 'amzps_adminFoot');
register_activation_hook(__FILE__,'amzps_install');
?>
