// Trigger Holiday Mode

// add_action ('init', 'bbloomer_woocommerce_holiday_mode');


// Disable Cart, Checkout, Add Cart

// function bbloomer_woocommerce_holiday_mode() {
   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
   remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
   remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
   remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
   add_action( 'woocommerce_before_main_content', 'bbloomer_wc_shop_disabled', 5 );
   add_action( 'woocommerce_before_cart', 'bbloomer_wc_shop_disabled', 5 );
   add_action( 'woocommerce_before_checkout_form', 'bbloomer_wc_shop_disabled', 5 );
}
// Show Holiday Notice

function bbloomer_wc_shop_disabled() {
        wc_print_notice( 'Votre magasin est en vacances du 19/07 au 04/08', 'error');
} 
