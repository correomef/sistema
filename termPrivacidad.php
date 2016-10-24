<?php
/*
Template Name: avisosLegales
*/

include('header.php');
?>
<div class="contenedor">
	<div class="avisosLegales">
		<?php
		if (is_page('terminos-de-privacidad'))
			echo textareaEntreTexto($opciones['avisosLegales-termPrivacidad'],'','<br>');

		if (is_page('terminos-y-condidiones' ))
			echo textareaEntreTexto($opciones['avisosLegales-termYcond'],'','<br>');

		if (is_page('legal' ))
			echo textareaEntreTexto($opciones['avisosLegales-legal'],'','<br>');

		?>

	</div>
</div>




<?php include('footer.php');  ?>
