<?php
/*
Template Name: locales
*/

include('header.php');
?>



	<?php $bannerImagen = 'cabeceras-locales-imagen'; ?>


		<div class="bannerPagina">
	<?php if ( key_exists($bannerImagen.'-img', $opciones) ): ?>

		<img data-peso="<?php echo pesoFile($opciones[$bannerImagen.'-img']) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $opciones[$bannerImagen.'-id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $opciones[$bannerImagen.'-id'], 't1352')[0] ?>" src="">

	<?php endif ?>
	</div>

<div id="pagina-galeria">
		<div class="contenedor">
			<div class="headerMap">
				<h1 class=""><?php idioma('POINTS OF SALE','PUNTOS DE VENTA',''); ?></h1>
				<h2><?php idioma('Find our clothes at the following locations.','Encontrá nuestra indumentaria en los siguientes lugares. ',''); ?></h2>
			</div>
			<div class="bordeMap">
				<div id="map"></div>
			</div>
		</div>


		<?php
			$args = array(
			'post_type' => 'locales',
			'posts_per_page' => -1,
			/*'tax_query' => array(
			      array(
			          'taxonomy' => 'category',
			          'field'    => 'slug',
			          'terms'    => 'anclar-al-fin-de-home',

			      ),
			  ),*/
			);

			$loop = new WP_Query( $args );
			wp_reset_query();
		?>
		<div class="contenedor">

			<div class="contenedorGaleria">
				<?php

				$coord = array();
				$cont = 1;

				while ( $loop->have_posts() ) : $loop->the_post();


					$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 't768')[0];
					 $rawCoor= get_post_meta( $post->ID, 'map', true );
					$auxArr = explode(',',$rawCoor);
					$x = $auxArr[0];
					$y = $auxArr[1];
					$telefono = get_post_meta( $post->ID, 'telefono', true );
					$direccion = get_post_meta( $post->ID, 'address', true );
					$urlSitiio = get_post_meta( $post->ID, 'urlSitio', true );
					$coord[$cont] = array('<img src="'.$imgDestacada.'" style="width: 11em; float: left; margin: 1.6em 1.6em 3em 0; "><h2 style="color:#000">'.get_the_title().'</h2> <p style="color:#000">Tel: '.$telefono.'</p><p style="color:#000">'.$direccion.'</p><p style="color:#000"><a style="color:#000" target="_blank" href="'.$urlSitiio.'">'.$urlSitiio.'</a></p>', $x, $y);
					?>

				   <div class="galeria" data-coor="<?php echo $rawCoor?>">

						<div>
								<?php if (!empty($imgDestacada)){ ?>
								<img data-imgCel="<?php echo $imgCel ?>" data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" src="">
								<?php } ?>
							<p class="titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title()?></p>

							<p class="texAlignCenter"> Tel: <?php echo $telefono; ?></p>
							<p class="texAlignCenter"> <?php echo $direccion; ?></p>
							<p class="texAlignCenter"><a target="_blank" href="<?php echo $urlSitiio?>"><?php echo $urlSitiio?></a></p>
						</div>
						<span class="vermasGaleria"><?php echo idioma('See Location','Ver Ubicación',''); ?></span>
				</div>

				<?php $cont++; endwhile; ?>
			</div>

		</div>

</div>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?&key=AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA"></script>

<!-- <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA&amp;callback=initMap"></script> -->






<?php include('footer.php');  ?>


   <script type="text/javascript">
   var map;
   function initialize() {

     var marcadores = <?php echo json_encode($coord) ?>;


     /*[
       ['León', 42.603, -5.577],
       ['Salamanca', 40.963, -5.669],
       ['Zamora', 41.503, -5.744]
     ];*/
     map = new google.maps.Map(document.getElementById('map'), {
       zoom: 4,
       scrollwheel: false,
       center: new google.maps.LatLng(-39.4538989,-63.1386414),
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });
     var infowindow = new google.maps.InfoWindow();
     var marker, i;
     var cantidad = Object.keys(marcadores).length;
     for (i = 1; i <= cantidad; i++) {


	       marker = new google.maps.Marker({
	         position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
	         map: map
	       });
	       google.maps.event.addListener(marker, 'click', (function(marker, i) {
	         return function() {
	           infowindow.setContent(marcadores[i][0]);
	           infowindow.open(map, marker);
	         }
	       })(marker, i));
	     }
	   }
   google.maps.event.addDomListener(window, 'load', initialize);

   $('.galeria').click(function(){
   		var rawcoor = $(this).attr('data-coor');
   		var x = parseFloat(rawcoor.split(',')[0]);
   		var y = parseFloat(rawcoor.split(',')[1]);
		var nuevoCentro = new google.maps.LatLng(x,y);
		var scrollTo = 0;
		if ( $('.bannerPagina').length) {
		    scrollTo = parseInt($('.bannerPagina').position().top) + parseInt($('.bannerPagina').css('height'));
		}
		$('body').animate({'scrollTop': scrollTo }, 900, 'swing', function(){
	   		map.panTo(nuevoCentro);

			map.setZoom(17);
		});
   });

   </script>