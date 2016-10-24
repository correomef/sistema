<?php 
 
// Display an "Add to cart" Button along with "Quantity" input 
// for WooCommerce products using a custom Loop
// Reference: https://gist.github.com/webaware/6260468
 
 
global $product; 
 
// not for variable, grouped or external products
    if (!in_array($product->product_type, array('variable', 'grouped', 'external'))) {
        // only if can be purchased
        if ($product->is_purchasable()) {
            // show qty +/- with button
            ob_start();
            woocommerce_simple_add_to_cart();
            $button = ob_get_clean();
 
            // modify button so that AJAX add-to-cart script finds it
            $replacement = sprintf('data-product_id="%d" data-quantity="1" $1 add_to_cart_button product_type_simple ', $product->id);
            $button = preg_replace('/(class="single_add_to_cart_button)/', $replacement, $button);
        }
    }
 	// output the button
    	echo $button;
    ?>
    
