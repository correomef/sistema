<?php
/*
Template Name: Ubicacion
*/
 ?>
<?php $pagina = 'Ubicacion' ?>

<?php include('header.php'); ?>

<aside>
	<div class="lineaMarron">
	    <div class="contenedor"></div>
	</div>
	<div class="contenedor">

		<img class="fondoAside" data-url="<?php echo get_bloginfo('template_url')?>/img/Ubicacion-Mapa.jpg" src="<?php echo get_bloginfo('template_url')?>/img/Ubicacion-Mapa.jpg">
 	</div>

 	<div class="lineaMarron">
 		<div class="contenedor"></div>
 	</div>
</aside>


<main>
	<div class="contenedor">
		<div class="apretador">

			<h2><?php echo idioma('Location:','Ubicación:','','Stelle:'); ?></h1>
			<p><?php echo idioma(
			'We have distributors in Germany, United States and Argentina. Pass the cursor of your mouse over the country to contact the dealer.',
			'Poseemos distribuidores en Estados Unidos y en Latinoamérica en Argentina. Desplaza el mouse sobre el pías para ver los datos del distribuidor.',
			'',
			'Wir haben Händler in den Vereinigten Staaten und Lateinamerika in Argentinien. Bewegen Sie die Maus über die Frommen Händler anzuzeigen.'); ?></p>

		</div>
	</div>
</main>

<?php include('footer.php');  ?>
