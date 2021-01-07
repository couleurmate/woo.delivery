<?php
/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 * PHP version 5.6
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author couleurmate
 * @author     Another Author PasLoin, alexsegura
 * @copyright  2019-2020
 * @license    GNU General Public License v3.0
 * @version    SVN: $Id$
 * @link       
 * @see        
 * @since      File available since Release  
 * @deprecated File deprecated in Release 
  */

//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

 function aurayonbio_add_woocommerce_support() {
   add_theme_support('woocommerce');
 }
 add_action('after_setup_theme', 'aurayonbio_add_woocommerce_support');

 function aurayonbio_styles() {
   wp_enqueue_style('google-fonts-lato-montserrat', 'https://fonts.googleapis.com/css?family=Lato:300,400,700|Montserrat:300,400,700');
 }
 add_action('wp_enqueue_scripts', 'aurayonbio_styles');

//Remove catalog ordering field

//add_action('init','delay_remove');
//function delay_remove() {
//    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
//    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
//}

// Remove-storefront-search-box-header.php

//function remove_sf_actions() {

//	remove_action( 'storefront_header', 'storefront_product_search', 40 );

//}
//add_action( 'init', 'remove_sf_actions' );

// Change the placeholder image

add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

function custom_woocommerce_placeholder_img_src( $src ) {
	$upload_dir = wp_upload_dir();
	$uploads = untrailingslashit( $upload_dir['baseurl'] );
	// replace with path to your image
	$src = $uploads . '/2018/placeholder.png';

	return $src;
}

// Hide SKU on product page
add_filter( 'wc_product_sku_enabled', 'bbloomer_remove_product_page_sku' );

function bbloomer_remove_product_page_sku( $enabled ) {
    if ( !is_admin() && is_product() ) {
        return false;
    }

    return $enabled;
}

// afficher la date de livraison dans le mail de confirmation
 add_action( 'woocommerce_email_order_details', 'ts_email_order_details', 10, 4);

 function ts_email_order_details( $order, $sent_to_admin, $plain_text, $email ) {
   echo '<p><strong>Votre commande sera livrée le : </strong>'. get_post_meta( $order->get_id(), "shipping_date", true ) .'</p>';

}
