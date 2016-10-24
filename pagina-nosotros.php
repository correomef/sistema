<?php

/*
Template Name: nosotros
*/
include('header.php');
 ?>
<?php
	$seccion = 'nosotros';
	$modulo = 'slide';
	$sliderClase = 'bxslider';
	$SliderId = 'inicio-sliderTop' ;

	include('slider.php')  ?>

	<div class="contenedor" id="pagina-nosotros">

	    	<h1><?php idioma('Our company','Nuestra Empresa','Nossa empresa'); ?></h1>
		    <p><?php echo str_replace("\n", "<br>", $opciones['nosotros-texto']);  ?></p>


	</div>

<?php include('footer.php');  ?>