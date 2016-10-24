var $ = jQuery.noConflict();

window.anchoVentana = $(window).width();

var anchoDocumento = $(document).width();

var bp0 = 1920;
var bp1 = 1400;
var bp2 = 780;
var bp3 = 768;


function ResizeFont(claseElemento, afectados, ratio, actuaHasta, ratio2, actuaHasta2) {

    ratio2 = ratio2 || 'no';
    actuaHasta2 = actuaHasta2 || 'no';
    var anchoVentana = $(window).width();

    if (actuaHasta >= anchoVentana) {

        if ($(claseElemento).length !== 0) {
            if (ratio2 !== 'no' && actuaHasta2 >= anchoVentana) {


                nuevaFontSize = $(claseElemento).width() / ratio2;

            } else {


                nuevaFontSize = $(claseElemento).width() / ratio;
            }

            if (ratio2 === 'no' && actuaHasta2 >= anchoVentana)
                $(afectados).attr('style', '');
            else
                $(afectados).css({
                    'font-size': nuevaFontSize + 'px'
                });
        }
    } else {

        $(afectados).attr('style', '');
    }
}

function cambiaImagenes() {
    $('img').each(function() {
        var brackPoint = bp3;
        switch ($(this).attr('data-bp')) {
            case 'bp1':
            brackPoint = bp1;
            break;
            case 'bp2':
            brackPoint = bp2;
            break;
            case 'bp3':
            brackPoint = bp3;
            break;
            default:
            brackPoint = bp3;
        }


        var imgCel = $(this).attr('data-imgcel');
        var imgGrande = $(this).attr('data-imggrande');


        if ($(document).width() <= brackPoint) {
            srcAnteriro = $(this).attr('src');
            if (imgCel !== '' && typeof imgCel !== 'undefined') {
                $(this).attr('src', imgCel);
            } else {
                $(this).attr('src', imgGrande);
            }
        }
        if ($(document).width() > brackPoint) {

            srcAnteriro = $(this).attr('src');
            if (imgGrande !== '' && typeof imgGrande !== 'undefined') {
                $(this).attr('src', imgGrande);
            } else {
                $(this).attr('src', imgCel);
            }

        }
    });
}


function productHover(){

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('.apapareceOnHover').css({'display':'none'});
    } else{
        if ($(window).width() > bp3) {
            $('.product').hover(
            function(){
                var padre = $(this);
                /*var switchColorPanel = padre.find('.nicescroll-cursors');
                if (switchColorPanel.length) {
                    switchColorPanel.trigger('click');
                    console.log('hay foco!!'+switchColorPanel.attr('class'));
                }*/
                var hijos = padre.find('.apapareceOnHover');
                hijos.each(
                    function(){
                        /*$(this).addClass('fadeIn');*/
                        $(this).css({'display':'flex'});
                        padre.css({'z-index':'20'});
                    }
                    );},
                function(){
                    var padre = $(this);
                    var hijos = padre.find('.apapareceOnHover');
                    hijos.each(function(){
                        /*$(this).removeClass('fadeIn');*/
                        $(this).hide();
                        padre.css({'z-index':'0'});
                    });
                }
                );
        }
    }
}

function verScroll() {

    if ($(document).scrollTop() > 175) {
        $('#carritoActual').addClass('carritoFlotante fadeIn');
    } else {
        $('#carritoActual').removeClass('carritoFlotante fadeIn');
    }
}

jQuery('#TabNav > li > a').click(function(event) {
    event.preventDefault();


    var activa = "div#option-" + $('#miCompra .options_tabs li a.active').attr("id");

    var validaContinuar = validaCamposMiCompra($(activa).find('input'));

    if (jQuery(this).attr('class') != 'active' && validaContinuar.valido === true) {

        moduloActivo = jQuery(this).attr('id');

        jQuery('#TabNav li ul').slideUp(350);
        jQuery(this).next().slideToggle(350);
        jQuery('#TabNav li a').removeClass('active');
        jQuery(this).addClass('active');

        jQuery('ul.options_tabs li').removeClass('active');
        jQuery(this).parent().addClass('active');
        var divid = jQuery(this).attr("id");
        var add = "div#option-" + divid;
        var strlenght = add.length;

        jQuery('div.ui-tabs-panel').addClass('deactive').fadeIn(300);
        jQuery('div.ui-tabs-panel').removeClass('active');
        jQuery(add).removeClass('deactive');
        jQuery(add).addClass('active');

    } else {

        $(activa).prepend(validaContinuar.tipoError);
    }

    if ($(this).attr('id') === 'confirmacion') {

        var values = {};

        datos = $('form[name="checkout"]').serializeArray();

        $.each(datos, function(i, field) {
            values[field.name] = field.value;
        });


        if (values.payment_method === 'bacs') {
            $('#dR-mdp-mercadopago').css({
                'display': 'none'
            });
            $('#dR-mdp-transferencia').css({
                'display': 'block'
            });
            //$('#place_order').val($('#payment_method_bacs').attr('data-order_button_text'));

        } else {
            var metodoPagoSelecto = $('input[name="payment_method"]:checked');
            var imagenPago = metodoPagoSelecto.next('label').find('img').attr('src');
            console.log(metodoPagoSelecto);
            console.log(imagenPago);
            $('#dR-mdp-mercadopago').html('<span style="text-transform: uppercase;">'+values.payment_method+' </span><span><img src="'+imagenPago+'" alt="'+values.payment_method+'"></span>');
            $('#dR-mdp-transferencia').css({
                'display': 'none'
            });
            //$('#place_order').val($('#payment_method_mercadopago').attr('data-order_button_text'));
        }

        $('#dR-nombre').html(values.billing_first_name);
        $('#dR-dni').html(values.billing_DNICUIT);
        $('#dR-tel').html(values.billing_phone);
        $('#dR-email').html(values.billing_email);

        var evioSelecto = $('input[name="shipping_metodoEnvio"]:checked');

        if (evioSelecto.length) {
            var arr_evioSelecto = evioSelecto.val().split('-');
            var valor_evioSelecto = arr_evioSelecto[0] + '-' + arr_evioSelecto[1];
            var evioSelectoId = evioSelecto.attr('id');
            var envioSelectoImg = $('label[for="' + evioSelectoId + '"] img').attr('src');
            if (typeof envioSelectoImg === 'undefined') {
                $('#dR-envioPor img').hide();
            } else {
                $('#dR-envioPor img').attr('src', envioSelectoImg).show();
            }

            var labelDelInput = evioSelecto.next('label');
            var selecSucursales = labelDelInput.find('select.sucursales');
            var tieneSucursales = (selecSucursales.length) ? true : false;

            if (tieneSucursales) {
                $('#sucrsalSelcionada').html(arr_evioSelecto[1]+'<br>'+selecSucursales.val());
            }else{
                $('#sucrsalSelcionada').html(arr_evioSelecto[1]);
            }

            sucursal = 'shipping-metodoEnvio-sucursal-' + valor_evioSelecto;

            if (typeof values[sucursal] !== 'undefined') {

                evioSelecto.val(valor_evioSelecto + '-' + values[sucursal]);
            } else {
                evioSelecto.val(valor_evioSelecto);
            }
        }

        $('#dR-miDireccion').hide();
        if (values.shipping_address_1 !=='---') {
            $('#dR-miDireccion').show();

            $('#quienRecibe').html(values.shipping_quien_recibe);
            $('#direccion').html(values.shipping_address_1);
            $('#numero').html(values.shipping_address_numero);
            $('#ciudad').html(values.shipping_city);
            $('#codigoPosta').html(values.shipping_postcode);
            $('#provincia').html(values.shipping_state);
        }



        $('#datosRecopilados .cambiar').click(function() {
            tab = $(this).attr('data-tab');

            $('.options_tabs ' + tab).trigger('click');
            $('html, body').animate({'scrollTop': ($('#paginaMiCompra').position().top) + ($('.banner').height()) }, 900, 'swing');
        });


        var valuesNuevas = {};

        datosNuevos = $('form[name="checkout"]').serializeArray();

        $.each(datosNuevos, function(i, field) {
            valuesNuevas[field.name] = field.value;
        });




    }
});


function validaCamposMiCompra(ValThis) {

    if ($('.avisoError').length) {
        $('.avisoError').each(function(){
            $(this).remove();
        });
        $('.has-error').each(function(){
            $(this).removeClass('has-error');
        });

    }

    var validaContinuar = true;
    var error = '<span id="err-form" class="avisoError" style="text-align: center; width: 100%; display: block; color: #51504f;">Revise o complete los campos resaltados</span>';


    ValThis.each(function() {
        if ($(this).attr('type') === 'text' || $(this).attr('type') === 'email' || $(this).attr('type') === 'tel'){

            if ($(this).val() === '' && $(this).attr('id') !== 'trap') {

                if ($(this).attr('class') !== 'select2-input' && !$(this).hasClass('select2-offscreen')) {
                    $(this).addClass('has-error');
                    validaContinuar = false;

                }


            }
        }

        if ($(this).attr('type') === 'radio'){
            var chequeado = $('[name="shipping_metodoEnvio"]:checked').val();
            var chequeadoEl = $('[name="shipping_metodoEnvio"]:checked');
            var labelDelInput = chequeadoEl.next('label');
            var selecSucursales = labelDelInput.find('select.sucursales');
            var tieneSucursales = (selecSucursales.length) ? true : false;
            if (tieneSucursales) {
                if (selecSucursales.val() === null) {
                    selecSucursales.addClass('has-error');
                    validaContinuar = false;
                    error = '<span id="err-form" class="avisoError" style="text-align: center; width: 100%; display: block; color: #51504f;">Seleccione una sucursal</span>';
                }
            }
        }
    });


    return {valido: validaContinuar, tipoError: error};
}


$('.continuar').click(function() {

    var continuarApretado = $(this);
    console.log(continuarApretado);
    var validaContinuar = validaCamposMiCompra(continuarApretado.parent().parent('.active').find('input'));
    console.log(continuarApretado.parent().parent('.active').find('input'));


    if (validaContinuar.valido === true) {
        if ($(this).attr('data-direccion') === 'anterior') {
            $('.options_tabs li a.active').parent().prev().find('a').trigger("click");
        }else{
            $('.options_tabs li a.active').parent().next().find('a').trigger("click");
        }

        $('html, body').animate({'scrollTop': ($('#paginaMiCompra').position().top) + ($('.banner').height()) }, 900, 'swing');
    }else {
        var activa = "div#option-" + $('#miCompra .options_tabs li a.active').attr("id");
        $(activa).append(validaContinuar.tipoError);
    }


});

$('.scrollTop').click(function(){
 $('html, body').stop().animate({'scrollTop': 0 }, 900, 'swing');
});

$('.abreModal').click(function(e) {
    e.preventDefault();
    var modalID = $(this).attr('data-modal');
    var modal = $(modalID);
    var trancicion = 'fadeIn';

    if (typeof(modal.attr('data-transicion')) !== 'undefined') {
        trancicion = modal.attr('data-transicion');
    }else{
        modal.attr('data-transicion','fadeIn');
    }

    $('.abreModal').each(function(eq) {
        modalaOcultar = $($(this).attr('data-modal'));
        if (typeof(modalaOcultar.attr('data-transicion')) !== 'undefined') {
            modalaOcultar.removeClass(modalaOcultar.attr('data-transicion'));
        } else{
            if (modalaOcultar.hasClass('fadeIn')){
                modalaOcultar.removeClass('fadeIn');
            }
        }
        $(modalaOcultar).css({
            'display': 'none'
        });
        $('.fondoModal').remove();
    });


    $('body').append('<div class="fondoModal"></div>');

    $('.fondoModal').fadeIn(700, function() {
        if ($(window).height() > modal.outerHeight()) {
            top2 = ($(window).height() / 2) - (modal.outerHeight() / 2) + $(document).scrollTop();
        } else {
            top2 = 40 + $(document).scrollTop();

        }
        left2 = ($(window).width() / 2) - (modal.outerWidth(true) / 2);
        modal.css({
            'top': top2,
            'left': left2
        });
        modal.addClass(trancicion);
    });

    $('.close, .fondoModal').click(function() {
        modal.removeClass(trancicion);
        modal.fadeOut(700, function() {
            $('.fondoModal').fadeOut(700, function() {
                $('.fondoModal').remove();
            });
        });
    });
});



$('.abreModalInstantaneo').click(function() {
    var modal = '';
    modal = $(this).attr('data-modal');
    $(modal).addClass('instantaneo');
    $('.close').click(function() {
        $(modal).removeClass('instantaneo');
    });

    $(modal).mouseleave(function() {
        $(modal).removeClass('instantaneo');
    });

});

$('.abreModalConFade .close').click(function() {
    var modal = $(this).attr('data-modal');
    $(modal).removeClass('fadeIn');
});

$('.abreModalConFade').click(function() {

    var modal = $(this).attr('data-modal');
    $(modal).addClass('fadeIn');


});

$('.abreModalConFade').hover(
    function() {
        var modal = $(this).attr('data-modal');
        $(modal).addClass('fadeIn');

        $('.close').click(function() {
            $(modal).removeClass('fadeIn');
        });
    }
    );

function validaRegistro(botonApretado) {



    if ($('#err-form').length) {
        $('#err-form').remove();
        $('*').removeClass('has-error');
    }

    email = $('#reg_email').val();
    emailCONF = $('#reg_emailCONF').val();

    password = $('#reg_password').val();
    passwordCONF = $('#reg_passwordCONF').val();


    $('input[name="username"]').val(email);
    $('input[name="_wp_http_referer"]').val(blogURL);
    var email_formato = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/;

    email_formato.test(email);

    if (email_formato.test(email)) {

        if (email === emailCONF) {

            if (password === passwordCONF) {

                if (password.length >= 6 && password.match(/[A-z]/) && password.match(/\d/) && password !== '') {

                    var valida = true;

                    $('.register input').each(function() {


                        if ($(this).val() === '' && $(this).attr('id') !== 'trap') {

                            $(this).addClass('has-error');
                            valida = false;

                        }

                    });

                    if (valida === true) {

                        botonApretado.unbind('click').find('input').trigger("click");

                    } else {

                        botonApretado.after('<span id="err-form">Revise o complete los campos resaltados</span>');
                    }


                } else {

                    botonApretado.after('<span id="err-form">Comprueve que su contraseña contenga almenos 6 caracteres una letra y un número.</span>');
                    $('#reg_password').addClass('has-error');
                }


            } else {

                botonApretado.after('<span id="err-form">Su contraseña no coincide con la confirmacion</span>');
                $('#reg_passwordCONF').addClass('has-error');
            }

        } else {

            botonApretado.after('<span id="err-form">Su email no coincide con la confirmacion</span>');
            $('#reg_emailCONF').addClass('has-error');
        }

    } else {

        botonApretado.after('<span id="err-form">Revise su email</span>');
        $('#reg_email').addClass('has-error');
    }
}

/*$('.abreRegitro').click(function(event) {
    event.preventDefault();

    $('.abreModal').each(function() {
        modalaOcultar = $(this).attr('data-modal');
        $(modalaOcultar).css({
            'display': 'none'
        });
        console.log(modalaOcultar);
        console.log($(modalaOcultar).attr('data-transicion'));

        if (typeof($(modalaOcultar).attr('data-transicion')) !== 'undefined') {
            $(modalaOcultar).removeClass($(modalaOcultar).attr('data-transicion'));
        }else{
         $(modalaOcultar).removeClass('fadeIn');
     }

     $('.fondoModal').remove();
 });

    $('footer').after('<div class="fondoModal"></div><div id="formRegistro" class="modal modalRegistro"></div>');

    $('.fondoModal').fadeIn(700);


    $('.modal').load(blogURL + '/registrarme', function() {
        $('.modal').prepend('<div class="close">×</div>');

        if ($(window).height() < $('.modal').height()) {
            top2 = 0;
        } else {
            top2 = ($(window).height() / 2) - ($('.modal').height() / 2) + $(document).scrollTop();
        }

        marginLeft = ($('.modal').outerWidth() / -2);




        if ($(window).width() > 710) {
            $('.modal').css({
                'top': top2 + 'px',
                'left': '50%',
                'margin-left': marginLeft + 'px',
            });
        } else {
            $('.modal').css({
                'top': top2 + 'px',
                'left': '0',
                'margin-left': '0px'
            });
            $('.close').css({
                'left': '50%',
                'margin-left': '-17px'
            });
        }

        $('.modal').fadeIn(700);

        $('.fondoModal').css({
            'background-image': 'none'
        });


        $('.close, .fondoModal').click(function() {
            $('.modal').fadeOut(700, function() {

                $('.fondoModal').fadeOut(700, function() {

                    $('.fondoModal, .modal').remove();
                });

            });

        });



        $('#formRegistro #botonRegistrase').click(

            function(event) {

                event.preventDefault();

                validaRegistro($(this));



            });

    });
});*/
$('.abreRegitro').click(function(event) {
    event.preventDefault();
    var modalID = '#formRegistro';
    var modal = $('#formRegistro');
    $('body').animate({'scrollTop': 0 }, 900, 'swing', function(){
        var trancicion = 'fadeIn';

        if (typeof(modal.attr('data-transicion')) !== 'undefined') {
            trancicion = modal.attr('data-transicion');
        }else{
            modal.attr('data-transicion','fadeIn');
        }

        $('.abreModal').each(function(eq) {
            modalaOcultar = $($(this).attr('data-modal'));
            if (typeof(modalaOcultar.attr('data-transicion')) !== 'undefined') {
                modalaOcultar.removeClass(modalaOcultar.attr('data-transicion'));
            } else{
                if (modalaOcultar.hasClass('fadeIn')){
                    modalaOcultar.removeClass('fadeIn');
                }
            }
            $(modalaOcultar).css({
                'display': 'none'
            });
            $('.fondoModal').remove();
        });


        $('body').append('<div class="fondoModal"></div>');


        $('.fondoModal').fadeIn(700, function() {

            modal.addClass(trancicion);

            if ($(window).height() < $('#formRegistro').height()) {
                top2 = 0;
            } else {
                top2 = ($(window).height() / 2) - ($('#formRegistro').height() / 2) + $(document).scrollTop();
            }

            marginLeft = ($('#formRegistro').outerWidth() / -2);



            if ($(window).width() > 710) {
                $('#formRegistro').css({
                    'top': top2 + 'px',
                    'left': '50%',
                    'margin-left': marginLeft + 'px',
                });
            } else {
                $('#formRegistro').css({
                    'top': top2 + 'px',
                    'left': '0',
                    'margin-left': '0px'
                });

            }



            $('#formRegistro #botonRegistrase').click(

                function(event) {

                    event.preventDefault();

                    validaRegistro($(this));



                });
        });

        $('.close, .fondoModal').click(function() {
            modal.removeClass(trancicion);
            modal.fadeOut(700, function() {
                $('.fondoModal').fadeOut(700, function() {
                    $('.fondoModal').remove();
                });
            });
        });

    });
});


$('#scroll-down').click(function(){
    var targetID = $(this).attr('data-target');
    var targetOB = $(targetID);
    var mover = parseInt(targetOB.scrollTop()) + parseInt($('.switchColor').css('height')) + parseInt($('.switchColor').css('margin-bottom')) + parseInt($('.switchColor').css('border-bottom-width')) + parseInt($('.switchColor').css('border-top-width'));
    $($(this).attr('data-target')).animate({scrollTop:mover}, 'fast', 'swing');
});

$('#scroll-up').click(function(){
    var targetID = $(this).attr('data-target');
    var targetOB = $(targetID);
    var mover = parseInt(targetOB.scrollTop()) - parseInt($('.switchColor').css('height')) - parseInt($('.switchColor').css('margin-bottom')) - parseInt($('.switchColor').css('border-bottom-width')) - parseInt($('.switchColor').css('border-top-width'));
    $($(this).attr('data-target')).animate({scrollTop:mover}, 'fast', 'swing');
});




$('#RPA').click(

    function(event) {

        event.preventDefault();

        validaRegistro($(this));



    });

$('.send').click(function() {
    botonApretado = $(this);
    validaYenviaMail(botonApretado);
});

function validaFormulario(botonApretado) {
    formulario = (botonApretado.offsetParent().attr('id'));
    $("*").removeClass("has-error");
    $('#err-form').hide();

    var error = false;

    $('#' + formulario + ' .obligatorio input, #' + formulario + ' .obligatorio textarea, #' + formulario + ' .obligatorio select').each(function(item) {
        val = $(this).val();
        id = $(this).attr('id');
        type = $(this).attr('type');
        name = $(this).attr('name');
        var mensajeError = $(this).attr('data-error');

        if (typeof mensajeError === "undefined") {
            var idioma = $('html').attr('lang');
            switch (idioma) {
                case 'en-US':
                mensajeError = 'Complete or check the highlighted data';
                break;
                case 'pt-PT':
                mensajeError = 'Completa ou verificar os dados em destaque';
                break;
                case 'de-DE':
                mensajeError = 'Komplett oder überprüfen Sie die markierten Daten';
                break;
                case 'es-ES':
                mensajeError = 'Complete o revise los datos resaltados';
                break;
            }
        }

        if (val === "" || val === " ") {
            error = true;
            $(this).addClass("has-error");
            $('#' + formulario + ' #err-form').html(mensajeError).fadeIn('slow');
        }

        if (id === 'E_mail') {

            var email_compare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/;

            if (!email_compare.test(val)) {

                $(this).addClass("has-error");
                error = true;
                $('#' + formulario + ' #err-form').html(mensajeError).fadeIn('slow');

            }
        }

        if (id === 'Provincia') {
            if ($(this).val() === '') {
                $(this).addClass("has-error");
                error = true;
                $('#' + formulario + '#err-form').html(mensajeError).fadeIn('slow');
            }
        }

        if (type === 'radio') {

            if (!$("input[type='radio']:checked").length) {
                name = $(this).attr('name');
                error = true;
                $('#' + formulario + ' #err-form').html(mensajeError).fadeIn('slow');
                $(this).parent().addClass("has-error");

            }
        }

    });

    if (error === true) {
        $('#' + formulario + ' #err-form').fadeIn('slow');
        return false;
    }


}


/*$('.login input[type="submit"] ').click(function(event){
    event.preventDefault();
    var botonApretado = $(this);
    if(validaFormulario(botonApretado)){
         botonApretado.unbind('click').find('.login input[type="submit"]').trigger("click");
    }
});*/

function validaYenviaMail(botonApretado) {
    formulario = (botonApretado.offsetParent().attr('id'));
    $("*").removeClass("has-error");
    $('#err-form').hide();

    var error = false;

    $('#' + formulario + ' .obligatorio input, #' + formulario + ' .obligatorio textarea, #' + formulario + ' .obligatorio select').each(function(item) {
        val = $(this).val();
        id = $(this).attr('id');
        type = $(this).attr('type');
        name = $(this).attr('name');
        var mensajeError = $(this).attr('data-error');

        if (typeof mensajeError === "undefined") {
            var idioma = $('html').attr('lang');
            switch (idioma) {
                case 'en-US':
                mensajeError = 'Complete or check the highlighted data';
                break;
                case 'pt-PT':
                mensajeError = 'Completa ou verificar os dados em destaque';
                break;
                case 'de-DE':
                mensajeError = 'Komplett oder überprüfen Sie die markierten Daten';
                break;
                case 'es-ES':
                mensajeError = 'Complete o revise los datos resaltados';
                break;
            }
        }

        if (val === "" || val === " ") {
            error = true;
            $(this).addClass("has-error");
            $('#' + formulario + ' #err-form').html(mensajeError).fadeIn('slow');
        }

        if (id === 'E_mail') {

            var email_compare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/;

            if (!email_compare.test(val)) {

                $(this).addClass("has-error");
                error = true;
                $('#' + formulario + ' #err-form').html(mensajeError).fadeIn('slow');

            }
        }

        if (id === 'Provincia') {
            if ($(this).val() === '') {
                $(this).addClass("has-error");
                error = true;
                $('#' + formulario + '#err-form').html(mensajeError).fadeIn('slow');
            }
        }

        if (type === 'radio') {

            if (!$("input[type='radio']:checked").length) {
                name = $(this).attr('name');
                error = true;
                $('#' + formulario + ' #err-form').html(mensajeError).fadeIn('slow');
                $(this).parent().addClass("has-error");

            }
        }

    });

    if (error === true) {
        $('#' + formulario + ' #err-form').fadeIn('slow');
        return false;
    }

    var data_string = $('#' + formulario).serialize();

    var url = templateUrl+'/mail-it.php';

    if ( typeof($('#' + formulario).attr('action')) !== 'undefined' ) {
        url = $('#' + formulario).attr('action');

    }


    $.ajax({
        type: "POST",
        url: url,
        data: data_string,
        timeout: 6000,
        error: function(request, error) {
            if (error == "timeout") {
                $('#' + formulario + ' #err-timedout').fadeIn('slow');
            } else {
                $('#' + formulario + ' #err-state').fadeIn('slow');
                $('#' + formulario + ' #err-state').html('Ocurrio un error: ' + error + '');
            }
        },
        success: function() {
            $('#' + formulario + ' #ajaxsuccess').fadeIn('slow');
            $('#' + formulario + ' input:not(:hidden), #' + formulario + ' textarea').val('');



        }
    });

    return false;
}

function restarOnClic(SliderID, sliderF, time, MuestraControles, reinicia) {

    MuestraControles = MuestraControles || 'true';
    reinicia = reinicia || 'true';

    time = time || 200;


    if (MuestraControles === 'true') {

        $(SliderID).hover(
            function() {

                controles = $(this).find('.bx-wrapper .bx-controls-direction');

                $(controles).fadeIn('fast');


            },
            function() {
                $(controles).fadeOut('fast');
            }
            );
    }

    if (reinicia === 'true') {
        $(SliderID + ' .bx-prev,' + SliderID + ' .bx-next,' + SliderID + ' .bx-pager-item a').click(function() {
            if ($(this).attr('class') === 'bx-pager-link') {


                var i = $(this).attr('data-slide-index');
                sliderF.goToSlide(i);
            }
            restart = setTimeout(function() {
                sliderF.startAuto();
            }, time);
            return false;
        });
    }
}

function agregaClase(disparador, afectado, claseAgregar, modo, inThis) {
    inThis = inThis || false;

    $(disparador).each(function() {
        disparadorActual = $(this);
        var target = $($(disparadorActual).attr('data-target'));
        var targetID = $(disparadorActual).attr('data-target');
        var close = $(targetID).find('.close');




        if (modo === 'hover') {



            if (!inThis) {

                $(disparadorActual).on('mouseenter click',
                    function() {
                        $('.'+claseAgregar).each(function() {
                            $(this).removeClass(claseAgregar);
                        });

                        if (target.length && !target.hasClass(claseAgregar)) {
                            target.addClass(claseAgregar);

                        }
                        $(targetID).find('.close').click(function() {
                            $(targetID).removeClass(claseAgregar);
                        });


                    }
                    );

                    target.mouseleave(
                        function() {
                            if (target.length) target.removeClass(claseAgregar);
                        }
                        );



            } else {
                target = $(this).find(target);
                $(disparadorActual).hover(
                    function() {if (target.length) {
                        $(target).addClass(claseAgregar);

                    } },
                    function() {if (target.length) $(target).removeClass(claseAgregar);}
                    );
            }
        }

        if (modo === 'click') {
            $(disparadorActual).click(

                function() {

                    if (!inThis) {
                        target = afectado;

                    } else {
                        target = $(this).find(afectado);
                    }

                    $(afectado).addClass(claseAgregar);

                    $(afectado).find('.close').click(function() {
                       $(afectado).removeClass(claseAgregar);
                   });


            });
        }



    });

}

function cargarProductosDestacados() {

    if (prodDest) {
        prodDest.destroySlider();
    }
    var anchoContenedor = $('.prodDestacados').width();
    var anchoControl = (anchoContenedor * 2.35 / 100) * 2;

    var anchoDestacado = 242;

    if (anchoDocumento < bp1) {
        anchoDestacado = 168;
    }
    var margenDestacado = 0;

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('.prodDestacados').addClass('sinmargenNegativo');
        margenDestacado = 2;
    }
    var sliceDestacada =  Math.floor((anchoContenedor - anchoControl) / (anchoDestacado + margenDestacado));

    if (sliceDestacada <= 2) {

        margenDestacado = 10;
        //anchoDestacado = 240;
    }

    if (sliceDestacada === 1) {

        anchoDestacado = anchoContenedor * 80 / 100;
    }

    /*else if (anchoDocumento >= 837 && anchoDocumento < 1280) {
        sliceDestacada = 2;
    }*/
    else {
        //sliceDestacada = 5;
        //  anchoDestacado = 155;
    }


    var prodDest = $('#productosDestacados > ul').bxSlider({
        slideWidth: anchoDestacado,
        minSlides: sliceDestacada,
        maxSlides: sliceDestacada,
        moveSlides: sliceDestacada,
        slideMargin: margenDestacado,
        touchEnabled: false,
        infiniteLoop: false,
        hideControlOnEnd: true,
        pager: false,
        nextText: '',
        prevText: '',

    });
    restarOnClic('#productosDestacados', prodDest, 58, 'true', 'false');
}

function closePrint () {
  document.body.removeChild(this.__container__);
}

function setPrint () {
  this.contentWindow.__container__ = this;
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.focus(); // Required for IE
  this.contentWindow.print();
}

function printPage (sURL) {
  var oHiddFrame = document.createElement("iframe");
  oHiddFrame.onload = setPrint;
  oHiddFrame.style.visibility = "hidden";
  oHiddFrame.style.position = "fixed";
  oHiddFrame.style.right = "0";
  oHiddFrame.style.bottom = "0";
  oHiddFrame.src = sURL;
  document.body.appendChild(oHiddFrame);
}

function armaSliderEntrada() {
    if ($("#sliderEntrada").length) {
        var sliderEntrada = $("#sliderEntrada ul").bxSlider({
            mode: 'fade',
            speed: 1,
            auto: false,
            autoStart: false,
            pager: false,
            useCSS: false,
            nextText: '',
            prevText: '',
            responsive: true,
            infiniteLoop: false,
            hideControlOnEnd: true,
            onSliderLoad: function() {
                $("#sliderEntrada").addClass('fadeIn');
            },

        });
        restarOnClic('#sliderEntrada', sliderEntrada, 58, 'true', 'false');


        $('#fichaProducto .variations select').hover(function(){
            if ($('#sliderEntrada .images').length === 0){
                $('#sliderEntrada').prepend('<div class="images"><img src""></div>');
                $('#sliderEntrada .images').css({'opacity':'0'});
            }

        });
        $('#fichaProducto .variations select').click(function(){
            $('#sliderEntrada .images').css({'opacity':'1'});
        });

        var modoelegido = 'horizontal';
        if ($(window).width() >= bp3) {modoelegido = 'vertical';}
        var miniaturas = $('#miniaturas').bxSlider({
            mode: modoelegido,
            slideWidth: 110,
            nextText: '',
            prevText: '',
            minSlides: 3,
            maxSlides: 3,
            moveSlides: 3,
            slideMargin: 10,
            pager: false,
            infiniteLoop: false,
            hideControlOnEnd: true,
        });
        restarOnClic('.contenedorMiniaturas', miniaturas, 200, 'true', 'false');

        $('.mini').click(function() {

            if ($('#sliderEntrada .images').length){
                $('#sliderEntrada .images').remove();
            }
            var i = $(this).attr('data-slide-index');
            sliderEntrada.goToSlide(i);
            $('.mini').removeClass('activa');
            $(this).addClass('activa');


            return false;
        });

    }
}

function preINICIO() {



    cambiaImagenes();
    productHover();


    if ($('.video').length) {
        var iframe = $('.video iframe');
        iframe.each(function() {
            anchovideo = $(this).parent().width();
            alto = (anchovideo * 9 / 16);
            $(this).css({
                'height': alto
            });

        });
    }

    $('.imprimir').click(function(event){
        event.preventDefault();
        window.print();
    });

    if (window.anchoVentana > bp3) {
        $('.abreModalInstantaneo').hover(
            function() {
                var modal = $(this).attr('data-modal');
                $(modal).addClass('instantaneo');
                $(modal).mouseleave(function() {
                    $(modal).removeClass('instantaneo');
                });
                $(modal).mouseleave(function() {
                    $(modal).removeClass('instantaneo');
                });
            } );
    }

    $('#iniciaSeccionFooter').click(function(event) {
        event.preventDefault();
        $('body').animate({'scrollTop': 0 }, 900, 'swing', function(){
            $('[data-target="#barraSecundaria"]').trigger('click');
        });

    });




    $('.switchColor').click(function(){

        var color = $(this).attr('data-select');
        var size = '';
        var padre = '';

        galeria = galeriasDeVariciones['galeria-'+$(this).attr('data-id')];
        if (galeria){

            $('#sliderEntrada > .bx-wrapper').remove();
            $('.contenedorMiniaturas > .bx-wrapper').remove();

            $('#sliderEntrada').append('<ul></ul>');
            $('.contenedorMiniaturas').append('<div id="miniaturas"></div>');
            $.each(galeria, function(i, item) {
                $('#sliderEntrada ul').append('<li><img src="'+item[0]+'"></li>');
            });

            $.each(galeria, function(i, item) {
                $('#miniaturas').append('<div class="mini" data-slide-index="'+i+'" ><img src="'+item[0]+'"/></div>');
            });

            armaSliderEntrada();
            $('#sliderEntrada .images').remove();
            $('#sliderEntrada > .bx-wrapper').addClass('invisible');
        }


        $('.switchColor').each(function() {
            $(this).removeClass('selected');
        });

        $(this).addClass('selected');

        if($('#fichaProducto').length){
            padre = $('.ContfichaProducto');
            altoImagen = $('#sliderEntrada .bx-wrapper').outerHeight();


            if ($('#sliderEntrada .images').length === 0) {
                $('#sliderEntrada').prepend('<div class="images instantaneo"><img src""></div>');
                $('#sliderEntrada .images').css({'height':altoImagen});
            }else{
                $('#sliderEntrada .images').css({'height':altoImagen});
                $('#sliderEntrada .images').addClass('instantaneo');
            }
        }else{
            padre = $(this).parent().parent().parent();
        }

        var select = padre.find('#pa_color');
        var selectSize = padre.find('#pa_size');
        var cantidad = padre.find('.qty');
        if ($(this).attr('data-size')) {
            size = $(this).attr('data-size');
        }else{
            size = selectSize.find('option').first().next().val();
        }

        var hijos = padre.find('.variaciones');
        hijos.push(padre.find('.images'));

        var cantHijos = hijos.length;
        hijos.each(function(){
            /*if ($(this).attr('class') !== '.switchColorPanel' )  {
                if ($(this).hasClass('fadeIn')) {
                    $(this).removeClass('fadeIn');

                }else{
                    $(this).addClass('fadeOut');
                }
            }*/
            if (!--cantHijos) {
                setTimeout(function(){
                    padre.find('.reset_variations').trigger('click');
                    select.val(color).change();
                    selectSize.val(size).change();
                    cantidad.val(1);
                    cantidad.attr('value', 1);


                }, 500);
            }
        });



    });



}

$('.switchColor').hover(function(){
    var img = $(this).attr('data-pregrande');
    $('#sliderEntrada > .bx-wrapper').addClass('invisible');
    if ($('#sliderEntrada .images').length === 0) {
        $('#sliderEntrada').prepend('<div class="images instantaneo"><img src""></div>');
        $('#sliderEntrada .images img').attr('src', img);
    }else{
        $('#sliderEntrada .images img').attr('src', img);
    }



}, function () {
}

);

$('.switchColorPanel').on('mouseleave', function() {
    $('#sliderEntrada .images').remove();
    $('#sliderEntrada > .bx-wrapper').removeClass('invisible');
});

function inicia() {
    //$('.logo' ).css({'opacity': '0'});

    // cargarProductosDestacados();

    /*$('.loaderContainer').delay('0').fadeOut('0', function() {
        $('.loaderContainer').remove();
        $('html').css({
            'overflow': 'auto'
        });*/


        $('html').niceScroll({
            cursorborder: '1px solid #565656',
            cursorcolor: '#cccccc',
            zindex: 5,
            cursoropacitymin: 0.7,
            mousescrollstep: 120
        });
        $('.conScroll').niceScroll({
            cursorborder: 0,
            cursorcolor: '#868686',
            zindex: 5,
            cursoropacitymin: 0,
            mousescrollstep: 40,
            railoffset: {
                top: 0,
                left: 5
            }
        });



        /* });*/
    }
    $(document).ready(function() {

        $('#archive-product .product').hover(
            function(){
                $(this).find('.images').addClass('imagesHover');
            },
            function(){
                $(this).find('.images').removeClass('imagesHover');
            }
            );

        function acionBMP(div, accion, event) {
            $('.menuDeplegable').hide();

            $('.instantaneo').each(function(){
                $(this).removeClass('instantaneo');
            });

            if (accion === 'abre') {
                var contenedorMenuProductos = $(div+' '+div+'-contenedor');
                contenedorMenuProductos.addClass('instantaneo');
                primerUl = contenedorMenuProductos.find('ul.children').first().show();
                childreDelProUl = primerUl.find('ul');
                childreDelProUl.each(function() {
                    $(this).show();
                });
            }

        }

        function abreMenuConCategorias(boton, objetivo){
       /* $(boton).click(function(event) {
            event.preventDefault();
            acionBMP(objetivo, accion);
        });*/

        $(boton).mouseenter(function() {

            acionBMP(objetivo, 'abre');
            //if (!$('.categoriasProductos .categoriasProductos-contenedor').hasClass('instantaneo'))
        });


        $(objetivo).mouseleave(function() {

            acionBMP(objetivo, 'cierra');
            // if ($('.categoriasProductos .categoriasProductos-contenedor').hasClass('instantaneo'))
        });
    }

    abreMenuConCategorias('.botonMenuproductos', '.categoriasProductos');
    abreMenuConCategorias('.botonMenuNovedades', '.categoriasNovedades');
    abreMenuConCategorias('.botonMenuNosotros', '.categoriasNosotros');



/*$('#menuProductos').menu({
    position: {
        my: "left top",
        at: "right top",
        of: "#menuProductos"
    },
});*/
preINICIO();


function fnNesecitaDatosEnvio() {
    var chequeadoEl = $('[name="shipping_metodoEnvio"]:checked');
    var nesecitaDatosEnvio = (chequeadoEl.hasClass('solicita_datos_de_envio') ? true : false);
    if (nesecitaDatosEnvio) {
        $('#datosEnvioAdomicilio').show();
        $('#datosEnvioAdomicilio input').each(function(){
            $(this).val('');
        });
    }else{
        $('#datosEnvioAdomicilio').hide();
        $('#datosEnvioAdomicilio input').each(function(){
            $(this).val('---');
        });
    }

}

if ($('#BotonPago').length) {
    $('#BotonPago').css({
        'display': 'none'
    });
    $('#BotonPago').clone().appendTo("#clonBotonPago");
    $('#clonBotonPago #BotonPago').css({
        'display': 'inline-block'
    });
    $('#ship-to-different-address, .form-row form-row-wide create-account').css({
        'display': 'none'
    });


    $(".sucursales").select2();

    $('select.sucursales').change(function() {
        $(this).parent().parent().prev('.input-radio').trigger('click');
    });

    fnNesecitaDatosEnvio();

    $('[name="shipping_metodoEnvio"]').change(function() {

       /* var chequeadoEl = $('[name="shipping_metodoEnvio"]:checked');*/
       var chequeado = $('[name="shipping_metodoEnvio"]:checked').val();

       var UltimoMetodo = $('#metodosDeEnvio input').last().val();

       /*var nesecitaDatosEnvio = (chequeadoEl.hasClass('solicita_datos_de_envio') ? true : false);*/

       var tipoEnvio = chequeado.split('-');

       var costoEnvio = tipoEnvio[0];


        /*if (nesecitaDatosEnvio) {
            $('#datosEnvioAdomicilio').show();
            $('#datosEnvioAdomicilio input').each(function(){
                $(this).val('');
            });
        }else{
            $('#datosEnvioAdomicilio').hide();
            $('#datosEnvioAdomicilio input').each(function(){
                $(this).val('---');
            });
        }*/

        fnNesecitaDatosEnvio();

        if (subtotal < envioGratis || envioGratis === 'noDefinido') {
            if (!isNaN(parseFloat(costoEnvio)) && isFinite(costoEnvio)) {
                costoEnvio = parseFloat(costoEnvio);
                $('#envioMiniCarritoContenedor').html('<span>Envio: $' + tipoEnvio[0] + ' ARS</span>');
            } else {
                costoEnvio = 0;
                $('#envioMiniCarritoContenedor').html('<span>Envio: A convenir</span>');
            }

        }else{
           costoEnvio = 0;
       }


            // el subtotal lo toma del script de mini-cart.php
            var suma = (parseFloat(subtotal) + parseFloat(costoEnvio));
            $('#subtotalMasEnvioMiniCarrito').html('$'+suma);
        });
}

if ($('.infoProducto').length) {
    primeraOpcion = $('input[name="talles"]:checked').val();
    var idProducto = $(this).attr('data-product_id');
    botonAmodificar = $(this).find('button.add_to_cart_button');
    botonAmodificar.attr('data-talle', primeraOpcion);

    $('input[name="talles"]').change(function() {
        elegido = $('input[name="talles"]:checked').val();
        botonAmodificar.attr('data-talle', elegido);
    });
}

if ($('#catalogoSlider').length) {
    console.log('CHICHI');
    sliderTop = $('#catalogoSlider ul').bxSlider({
        auto: false,
        adaptiveHeight: true,
        speed: 900,
        pause: 5000,
        autoStart: false,
        autoHover: true,
        responsive: true,
        captions: false,
        controls: true,
        pager: false,
        nextText: '',
        prevText: '',
        infiniteLoop: false,

        onSlideBefore: function(objet) {

            var t=objet.next().find("img");
            var i=t.attr("data-srcCel");
            if ($(window).width() >= bp2) {
                i=t.attr("data-srcGrande");
            }
            t.attr("src",i);
        }


    });

}


var IMGaPreCargar = "No Hay";

imagenes = $('[data-peso]');
if (imagenes.length) {
    console.log('hay una');
    masGrande = 0;
    srcMasGrande = '';

    imagenes.each(function() {
        if (masGrande < parseInt($(this).attr('data-peso')) && parseInt($(this).attr('data-peso')) !== 'NaN' && $(this).attr('src') !== '') {
            masGrande = parseInt($(this).attr('data-peso'));
            srcMasGrande = $(this).attr('src');
            console.log($(this).attr('src'));
        }
    });

    IMGaPreCargar = srcMasGrande;
}


var numberOfImages = $('#inicio-sliderTop li').length;
if (numberOfImages > 1) {
    sliderTop = $('#inicio-sliderTop ul').bxSlider({
        auto: true,
        adaptiveHeight: true,
        speed: 900,
        pause: 5000,
        autoStart: true,
        autoHover: true,
        responsive: true,
        captions: false,
        controls: true,
        pager: true,
        nextText: '',
        prevText: '',
        infiniteLoop: true,

        onSlideBefore: function(objet, anterior, siguiente) {
            if ($('#losCaptions-inicio-sliderTop').length) {

                $('#losCaptions-inicio-sliderTop .active-caption').removeClass('active-caption');
                $('#losCaptions-inicio-sliderTop > div').eq(siguiente).addClass('active-caption');
            }
        },

        onSliderLoad: function() {
            if ($('#losCaptions-inicio-sliderTop').length) {
                $('#losCaptions-inicio-sliderTop > div').eq(0).addClass('active-caption');
            }


        },
    });
    restarOnClic('#contenedor-inicio-sliderTop', sliderTop);
    inicia();
}

else {
    inicia();
}



/*
if ($(".related.products").length) {
   var relacionados = $('.related.products .products').bxSlider({
    slideWidth: 193,
    nextText: '',
    prevText: '',
    minSlides: 3,
    maxSlides: 3,
    moveSlides: 3,
    slideMargin: 10,
    pager: false,
    infiniteLoop: false,
    hideControlOnEnd: true,
});
   restarOnClic('.related.products', relacionados, 200, 'true', 'false');
}*/

armaSliderEntrada();

if ($("#sliderSingle").length) {


    var sliderSingle = $("#sliderSingle ul").bxSlider({
        speed: 300,
        auto: false,
        autoStart: false,
        pager: false,
        adaptiveHeight: true,
        responsive: true,
        captions: false,
        controls: true,
        nextText: '',
        prevText: '',
        infiniteLoop: false,
    });
    restarOnClic('#sliderSingle', sliderSingle, 58, 'true', 'false');


    var anchoContenedor = $('.contenedorMiniaturasSINGLE').width();
    var anchoControl = (anchoContenedor * 10.1 / 100) * 2;
    var anchoDestacadoSingle = 217;
    var margenDestacado = 9;

    if (anchoDocumento < bp3) {
        anchoDestacadoSingle = 150;
    }
    var sliceDestacada =  Math.floor((anchoContenedor) / (anchoDestacadoSingle + margenDestacado));
    if (sliceDestacada === 1) {

        anchoDestacadoSingle = anchoContenedor * 80 / 100;
    }

    var miniaturasSingle = $('#miniaturasSingle ul').bxSlider({
        slideWidth: anchoDestacadoSingle,
        nextText: '',
        prevText: '',
        minSlides: sliceDestacada,
        maxSlides: sliceDestacada,
        moveSlides: sliceDestacada,
        slideMargin: margenDestacado,
        pager: false,
        infiniteLoop: false,
        hideControlOnEnd: true,
    });
    restarOnClic('.contenedorMiniaturasSINGLE', miniaturasSingle, 200, 'true', 'false');

    if ( $('#miniaturasSingle').length) {

         $('#miniaturasSingle li').each(function(index){
            $(this).attr('data-slide-index',index);
        });

         $('#miniaturasSingle li').click(function() {

            var i = $(this).attr('data-slide-index');
            sliderSingle.goToSlide(i);
            $('#miniaturasSingle li').removeClass('activa');
            $(this).addClass('activa');
            return false;
        });

     }

        if (typeof $('.miniaturaVideo li, .gruposTipoB img').attr('data-slide-index') === 'undefined'){
            $('.miniaturaVideo li, .gruposTipoB img').each(function (index, el) {
                $(this).attr('data-slide-index', index);
            });
        }
       $('.miniaturaVideo li, .gruposTipoB img').click(function(){

        var scrollTo = 0;
        if ( $('.bannerPagina').length) {
            scrollTo = parseInt($('.bannerPagina').position().top) + parseInt($('.bannerPagina').css('height'));
        }

         var i = $(this).attr('data-slide-index');
        $('body').animate({'scrollTop': scrollTo }, 900, 'swing', function(){
             sliderSingle.goToSlide(i);
             $('.miniaturaVideo li, .gruposTipoB img').removeClass('activa');
             $(this).addClass('activa');
             return false;
         });
     });

}





if ($('.infoLogueado').length) {

    $('#iniSec').hide();

} else {

    $('#iniSec').click(function() {
        $('#barraSecundaria .login').slideToggle();
    });
}

if ($('#inicio-sliderSecundario').length) {

    sliderSecundario = $('#inicio-sliderSecundario').bxSlider({


        auto: true,
        adaptiveHeight: true,
        speed: 900,

        pause: 5000,
        autoStart: true,
        autoHover: true,
        responsive: true,
        captions: false,
        controls: true,
        pager: true,
        nextText: '',
        prevText: '',
        infiniteLoop: true,

        onSlideBefore: function(objet, anterior, siguiente) {
            if ($('#losCaptions-inicio-sliderSecundario').length) {

                $('#losCaptions-inicio-sliderSecundario .active-caption').removeClass('active-caption');
                $('#losCaptions-inicio-sliderSecundario > div').eq(siguiente).addClass('active-caption');
            }
        },

        onSliderLoad: function() {
            if ($('#losCaptions-inicio-sliderSecundario').length) {
                $('#losCaptions-inicio-sliderSecundario > div').eq(0).addClass('active-caption');
            }
        },
    });
    restarOnClic('#contenedor-inicio-sliderSecundario', sliderSecundario);

}



$('.btnMenu #menuToggle').click(function() {
    $('.menuDeplegable').slideToggle("fast");
});

$('.slideToggle').click(function(e) {
    e.preventDefault();
    var target = $(this).attr('data-target');
    $(target+'.toggleTarget').slideToggle("fast");
});


agregaClase('.ToggleMenu', '.toggleTarget', 'instantaneo', 'hover');
agregaClase( '.apareceVideo li','#sliderSingle',  'instantaneo', 'click');

agregaClase( '.gruposTipoB img','#sliderSingle',  'instantaneo', 'click');

//agregaClase('#login-header', '#barraSecundaria','instantaneo', 'hover');

$('.cerrar').click(function(event) {
    event.preventDefault();
    $(this).parent().slideToggle();
});

jQuery('#qtranxs_select_qtranslate-chooser').change(function(){
   window.location.href = jQuery('#qtranxs_select_qtranslate-chooser').val();
});



var w = $(window).width();

$(window).resize(function() {
    if (w != $(window).width()) {

        setTimeout(function(){
            $('#inicio-productosDestacados').load(blogURL + '/destacados/', function() {

                preINICIO();
                //cargarProductosDestacados();
                var urlVariaciones = blogURL + '/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js';
                $.getScript( urlVariaciones );
            });
        }, 1000);


        w = $(window).width();

        delete w;

    }

});

});
//@prepros-prepend jquery-ui.js
//@prepros-prepend jquery.nicescroll.js
//@prepros-prepend jquery.bxslider.js
//@prepros-prepend jquery.easydropdown.min.js
