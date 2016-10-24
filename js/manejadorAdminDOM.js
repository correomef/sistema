jQuery(document).ready(function() {

	jQuery('.switch-tmce').trigger( "click" );

	/*jQuery('.AdminCostoEnvio').keyup(function(e){

		if (e.which === 188) {
			console.log(e.which);
			anterior = jQuery(this).val();
			nuevo = anterior.toString().replace(/\,/g,'.');
			jQuery(this).val(nuevo);
		}
	});*/

	jQuery('.AdminCostoEnvio').keydown(function(e) {

	        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A, Command+A
	            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
	             // Allow: home, end, left, right, down, up
	            (e.keyCode >= 35 && e.keyCode <= 40)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }


	    });

	jQuery('.link-to option:last-child').trigger('click');
	jQuery('#catalogo_ifr').css({'height':'900px','background-color':'#000'});

/*	cantCarTitulo = 51;

	jQuery('#title-prompt-text').html('Nombre del Producto ('+cantCarTitulo+' caracteres)');

	jQuery('#title').css({'width':'auto'}).attr('size',(cantCarTitulo+4)).after('<p id="cantCaracter">cantidad de caracteres: 0</p>');



	jQuery('#title').keyup(function(){
		jQuery('#cantCaracter').html('cantidad de caracteres: '+jQuery(this).val().length);

		anterior = jQuery(this).val();

		if (anterior.length >= cantCarTitulo) {
			nuevo = anterior.substring(0, cantCarTitulo);
			jQuery(this).val(nuevo);
			jQuery(this).css({'color':'red'});
			jQuery('#cantCaracter').append('<span id="basta"><b> No mas de '+cantCarTitulo+'</b></span>');
			jQuery('#cantCaracter').html('cantidad de caracteres: '+cantCarTitulo);
		} else {

			jQuery(this).css({'color':'black'});
		}

	});
*/
	if (jQuery('#order_data').length) {
		jQuery('.wrap > h1').css({'display':'none'});
	}

	if (jQuery('#tipo-de-entrada').length ) {

		if ((jQuery('[name="tipoDeEntrada"]:checked').val() === 'B' ) || (jQuery('[name="tipoDeEntrada"]:checked').val() === 'C' ) ){
			jQuery('#videos-tipo-a').hide();
			jQuery('.cfs_input').show();
			if (jQuery(this).val() === 'C') {
				jQuery('.cfs_input > h2 > span').text('Grupos tipo C');
			}else{
				jQuery('.cfs_input > h2 > span').text('Grupos tipo B');

			}
		}else{
			jQuery('#videos-tipo-a').show();
			jQuery('.cfs_input').hide();
		}

		jQuery('[name="tipoDeEntrada"]').change(function(){
			console.log('cambió');
			var tipoDeEntrada = jQuery(this).val();

			if ( jQuery(this).is(':checked') && ( jQuery(this).val() === 'B' || jQuery(this).val() === 'C' ) ){
				jQuery('#videos-tipo-a').hide();
				jQuery('.cfs_input').show();
				if (jQuery(this).val() === 'C') {
					jQuery('.cfs_input > h2 > span').text('Grupos tipo C');
				}else{
					jQuery('.cfs_input > h2 > span').text('Grupos tipo B');

				}
			}else{
				jQuery('#videos-tipo-a').show();
				jQuery('.cfs_input').hide();
			}
		});
	}





});
