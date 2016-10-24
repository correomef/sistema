<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>

	<p class="woocommerce-result-count">
		<?php
		$paged    = max( 1, $wp_query->get( 'paged' ) );
		$per_page = $wp_query->get( 'posts_per_page' );
		$total    = $wp_query->found_posts;
		$first    = ( $per_page * $paged ) - $per_page + 1;
		$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		/*if ( 1 == $total ) {
			_e( 'Showing the single result', 'woocommerce' );
		} elseif ( $total <= $per_page || -1 == $per_page ) {
			printf( __( 'Showing all %d results', 'woocommerce' ), $total );
		} else {
			idioma('Showing '.$first.'-'.$last.' of '.$total. ' products', 'Mostrando '.$first.'-'.$last.' de '.$total. ' resultados', 'pt', 'Showing '.$first.'-'.$last.' of '.$total. ' products');


		}*/
		echo idioma('Products: ','Productos: ','Produtos: ') . $total;
		?>
	</p>
