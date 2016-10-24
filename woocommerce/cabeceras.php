<?php

global $opciones;
global $wp_query;
$cat = $wp_query->get_queried_object();

if ($cat->slug) {
	$categoriaGuionBajo = $cat->slug;
} elseif ($cat->post_name) {
	$categoriaGuionBajo = $cat->post_name;
}else{
	$categoriaGuionBajo = $cat->query_var;
}

$vowels = array("-");
$categoriaGuionBajo = str_replace($vowels, "_", $categoriaGuionBajo);
wp_reset_query();
?>


<?php $bannerImagen = 'cabeceras-'.$categoriaGuionBajo.'-imagen'; ?>


	<div class="bannerPagina">
<?php if ( key_exists($bannerImagen.'-img', $opciones) ): ?>

	<img data-peso="<?php echo pesoFile($opciones[$bannerImagen.'-img']) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $opciones[$bannerImagen.'-id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $opciones[$bannerImagen.'-id'], 't1352')[0] ?>" src="">

<?php endif ?>
	</div>