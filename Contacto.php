<?php

/*
Template Name: contacto
*/

include('header.php');


 include ('woocommerce/cabeceras.php') ?>


<div id="paginaContacto">

	<div class="contenedor" >


			<div class="infoContacto">

				<h1><?php idioma('Contact','Contacto') ?></h1>

				<h2 class="DesapareceEnMovil"><?php echo get_bloginfo('name') ?></h2>

				<?php if ($opcionesArray['contacto']['postal']): ?>
					<p class="direccionPostal">
						<?php $cont =  1; foreach ($opcionesArray['contacto']['postal'] as $key => $value): ?>
							<?php $coma = ($cont < count($opcionesArray['contacto']['postal'])) ? ', ' : '' ?>
							<span><?php echo $value.$coma; ?></span>
						<?php $cont++; endforeach; ?>
					</p>
				<?php endif ?>

				<p class="bold"><?php echo $opciones['contacto-telefonos'] ?></p>

				<p><?php idioma('Complete the form , send your inquiry to :','Complete el Formulario, envíenos su consulta a: ','Preencher o formulário, envie sua pergunta para a: '); ?><?php echo $opciones['contacto-mails-formularios'] ?>
					<?php idioma('and shortly we will contact you . Thank you so much.','y en la brevedad nos comunicaremos con usted. Muchas gracias.','e logo entraremos em contato. Obrigado.'); ?> </p>

					<div class="formulario">

					<form id="formContacto">

						<input type="hidden" name="mailDestino" value="<?php echo $opciones['contacto-mails-formularios'] ?>">
						<input type="hidden" name="nombreEmpresa" value="<?php echo get_bloginfo('name') ?>">

						<div class="obligatorio">
							<input type="text" name="Nombre_y_Apellido" placeholder="<?php idioma('Full Name','Nombre y Apellido','Nome e sobrenome'); ?> ">
						</div>
						<div>
							<input type="text" name="Empresa" placeholder="<?php idioma('Company','Empresa','Companhia'); ?> ">
						</div>
						<div class="obligatorio">
							<input type="text" name="Email" placeholder="Email">
						</div>
						<div>
							<input type="text" name="Telefono" placeholder="<?php idioma('Phone','Telefono','Telefone'); ?> ">
						</div>
						<div>
							<input type="text" name="Direccion" placeholder="<?php idioma('Address','Direccion','Endereço'); ?> ">
						</div>

						<textarea  type="Comentario" placeholder="<?php idioma('Comment','Comentario','Comentário'); ?>" name="Comentario" id="Comentario"></textarea>
						<div class="enviar clearfix">
							<div type="submit" class="boton send"> <?php idioma('Send','Enviar','Enviar') ?></div>

							<div class="estado" id="estado" class="bloque">

								<div class="error" id="err-form"></div>

								<div class="error" id="err-timedout">Error de conexión. Intente nuevamente.</div>

								<div class="error" id="err-state"></div>

								<div id="ajaxsuccess"><?php idioma('Your message has been sent!!','Su mensaje ha sido enviado!!','Sua mensagem foi enviado!!') ?></div>

							</div>

						</div>
					</form>
				</div>

			</div>

			<div class="mapaContenedor">
			<h3><?php idioma('Location','Ubicación','Localização'); ?></h3>
				<!-- <div id="mapaContacto" class="mapa"></div> -->
				<?php ;
				$xy = explode(',', $opciones['contacto-coordenadas-coordenadas']);
				$x = $xy[0];
				$y = $xy[1];
				$coord = array(get_bloginfo('name'), $x,$y);
				?>
				<div id="map" class="mapa"></div>


				<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8097.111390623014!2d-64.509611642386!3d-31.43021337149742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x942d6637b526d871%3A0xa0a9d49d12788674!2sAtahualpa+261%2C+Villa+Carlos+Paz%2C+C%C3%B3rdoba!5e0!3m2!1ses!2sar!4v1467907832490" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6815.1033839791435!2d<?php echo $y ?>1301089!3d<?php echo $x ?>48049205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sar!4v1467906656937" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>  --></div>

	</div>
</div>




<?php include('footer.php');  ?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?&key=AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA"></script>
<!--  <script type="text/javascript">
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
    for (i = 0; i <= cantidad; i++) {


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





<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>-->
<script>


	coorSede2 = '<?php echo $opciones['contacto-coordenadas-coordenadas']?>';
	arrSede2 = coorSede2.split(',');
	console.log(arrSede2);
	var x = arrSede2[0];
	var y = arrSede2[1];


	var mapOptions = {
		zoom: 17,

		scrollwheel: false,


	  center: new google.maps.LatLng(x,y), // New York

	};

	var mapElement = document.getElementById('map');

	var map = new google.maps.Map(mapElement, mapOptions);



	var marker = new google.maps.Marker({

		position: new google.maps.LatLng(x,y),
		map: map,

	});
</script>

