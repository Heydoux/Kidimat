<?php
/**
 * Lapin
 * 
 * The sidebar containing the secondary widget area, displays on shop pages (Woocommerce)
 *
 * @package WordPress
 * @subpackage Lapin Boutique Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */
?>

<!-- BEGIN col-3 -->
<div class="col-md-3">

	<!-- BEGIN #sidebar -->
	<div id="shop-sidebar" role="complementary">
		<h2>Affiner</h2>
		<aside id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
			<div class="widget-header">
				<h3 class="widget-title">Catégories</h3>
			</div>
			<?php $args = array(
				'orderby' 		=> 'name',
				'order'				=> 'asc',
				'hide_empty'	=> false,
				'exclude'			=> array()
			);
			$categories = get_terms('product_cat', $args);

			if(!empty($categories)){
				echo '<ul class="product-categories">';
				foreach ($categories as $key => $cat){
					echo '<li class="cat-item cat-item-23"><a href="' .get_term_link($cat). '">' .$cat->name.'</a></li>';
				}
			}
			?>
			
				<li class="cat-item cat-item-23"><a href="http://localhost/Kidimat/categorie-produit/deco__amenagement/">Déco &amp; Aménagement</a></li>
				<li class="cat-item cat-item-18 cat-parent"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/">Granulats Sables Graviers</a>
					<ul class="children">
						<li class="cat-item cat-item-29"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/galets/">Galets</a></li>
						<li class="cat-item cat-item-28 cat-parent"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/">Gravier</a>	
							<ul class="children">
								<li class="cat-item cat-item-37"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/gravier_blanc/">Gravier blanc</a></li>
								<li class="cat-item cat-item-33"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/gravier_bleu/">Gravier bleu</a></li>
								<li class="cat-item cat-item-34"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/gravier_gris/">Gravier gris</a></li>
								<li class="cat-item cat-item-32"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/gravier_jaune/">Gravier jaune</a></li>
								<li class="cat-item cat-item-35"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/gravier_rose/">Gravier rose</a></li>
								<li class="cat-item cat-item-36"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier/gravier_rouge/">Gravier rouge</a></li>
							</ul>
						</li>
						<li class="cat-item cat-item-19 cat-parent"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier_deco/">Gravier Déco</a>	
							<ul class="children">
								<li class="cat-item cat-item-38"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier_deco/concasse/">Concassé</a></li>
								<li class="cat-item cat-item-21"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/gravier_deco/roule/">Roulé</a></li>
							</ul>
						</li>
						<li class="cat-item cat-item-30"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/materiaux_empierrement/">Matériaux d'empierrement</a></li>
						<li class="cat-item cat-item-31"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/materiaux_vegetales/">Matériaux végétales</a></li>
						<li class="cat-item cat-item-22"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/pierres_decoratives/">Pierres décoratives</a></li>
						<li class="cat-item cat-item-27"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/poussier/">Poussier</a></li>
						<li class="cat-item cat-item-26"><a href="http://localhost/Kidimat/categorie-produit/granulats_sables_graviers/sable/">Sable</a></li>
					</ul>
				</li>
				<li class="cat-item cat-item-47 cat-parent"><a href="http://localhost/Kidimat/categorie-produit/locations/">Locations</a>
					<ul class="children">
						<li class="cat-item cat-item-49"><a href="http://localhost/Kidimat/categorie-produit/locations/materiels_excavations/">Matériels d'excavations</a></li>
						<li class="cat-item cat-item-48"><a href="http://localhost/Kidimat/categorie-produit/locations/materiels_cylindrages/">Matériels de cylindrages</a></li>
					</ul>
				</li>
				<li class="cat-item cat-item-24 cat-parent"><a href="http://localhost/Kidimat/categorie-produit/maconnerie/">Maçonnerie</a>
					<ul class="children">
						<li class="cat-item cat-item-40"><a href="http://localhost/Kidimat/categorie-produit/maconnerie/elements_betons/">Éléments bétons</a></li>
						<li class="cat-item cat-item-39"><a href="http://localhost/Kidimat/categorie-produit/maconnerie/ferraillage/">Ferraillage</a></li>
					</ul>
				</li>
				<li class="cat-item cat-item-25 cat-parent"><a href="http://localhost/Kidimat/categorie-produit/reseaux/">Réseaux</a>
					<ul class="children">
						<li class="cat-item cat-item-44"><a href="http://localhost/Kidimat/categorie-produit/reseaux/accessoires/">Accessoires</a></li>
						<li class="cat-item cat-item-43"><a href="http://localhost/Kidimat/categorie-produit/reseaux/gaine/">Gaine</a></li>
						<li class="cat-item cat-item-41"><a href="http://localhost/Kidimat/categorie-produit/reseaux/pehd/">PEHD</a></li>
						<li class="cat-item cat-item-42"><a href="http://localhost/Kidimat/categorie-produit/reseaux/pvc/">PVC</a></li>
					</ul>
				</li>
			</ul>
		</aside>
		<!--
		<?php if ( ! dynamic_sidebar( 'shop-sidebar' ) ) : ?>
			<aside>
				<?php get_product_search_form(); ?>
			</aside>
		<?php endif; ?>
		-->
	</div>
	<!-- END #sidebar -->

<!-- END col-3 -->
</div>
