<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<p class="woocommerce-result-count mr-4">
	<?php
	if ( 1 === $total ) {
		//_e( '1 résultat affiché', 'woocommerce' );
		printf( '');
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		//printf( _n( 'Afficher tous les %d résultats triés par', 'Afficher tous les %d résultats triés par', $total, 'woocommerce' ), $total );
		printf( '');
	} else {
		$first = ( $per_page * $current ) - $per_page + 1;
		$last  = min( $total, $per_page * $current );
		/* translators: 1: first result 2: last result 3: total results */
		//printf( _nx( 'Affichage de  %1$d&ndash;%2$d sur %3$d résultats triés par', 'Affichage de %1$d&ndash;%2$d sur %3$d résultats triés par', $total, 'with first and last result', 'woocommerce' ), $first, $last, $total );
		printf( '');
	}
	?>
</p>


