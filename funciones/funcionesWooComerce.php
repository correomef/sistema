<?php

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();

	if (WC()->cart->get_cart_contents_count() > 1) { ?>
	<span id="cantidadActual" class="count">
		<i class="icon icon-carrito"></i>
		<span class="cantidadCarrito"><?php echo WC()->cart->get_cart_contents_count() ?></span>
	</span>
	<?php } ?>

	<?php

	if (WC()->cart->get_cart_contents_count() === 0) { ?>
	<span id="cantidadActual" class="count">
		<i class="icon icon-carrito"></i>
		<span class="cantidadCarrito"><?php echo WC()->cart->get_cart_contents_count() ?></span>

	</span>
	<?php }

	?>
	<?php

	if (WC()->cart->get_cart_contents_count() === 1) { ?>
	<span id="cantidadActual" class="count">
		<i class="icon icon-carrito"></i>
		<span class="cantidadCarrito"><?php echo WC()->cart->get_cart_contents_count() ?></span>
	</span>
	<?php }

	?>


	<?php

	$fragments['span#cantidadActual'] = ob_get_clean();


	return $fragments;
}



add_filter('woocommerce_cart_item_name', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);

add_filter('woocommerce_in_cart_product_title', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);

add_filter('woocommerce_order_table_product_title', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);

add_filter('woocommerce_shop_table_product_name', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);

add_filter('column-categories', 'qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);

add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

function custom_override_default_address_fields( $fields ) {


	$fields = array(


			'first_name' => array(
				'label'       => idioma('Name','Nombre','Nome','','noEcho','noEcho'),
				'description' => ''
				),
			'last_name' => array(
				'label' => 'Apellido',
				'description' =>''
				),

			'quien_recibe' => array(
				'label'       => idioma('Who receives','Quien Recibe o Retira','Quem recebe','Wer erhält','noEcho','noEcho'),
				'description' => ''
				),

			'Horario_de_Entrega' => array(
				'label'       => idioma('Delivery time','Horario de Entrega','Horario de Entrega','Delivery time','noEcho'),
				),


			'DNICUIT'	=> array(
				'label'          => 'DNI / CUIT',
				),

			'email'=> array(
				'label'          => 'Email',
				),

			'address_1' => array(
				'label'       => idioma('Adress','Dirección','Endereço', 'Adresse','noEcho'),
				),


			'address_numero' => array(
				'label'       => 'N°',
				'description' => ''
				),

			'address_depto' => array(
				'label'       => 'Dpto',
				'description' => ''
				),
			'telefonoFijo'	=> array(
				'label'          => idioma('Landline Phone','Telefono Fijo','Telefone Fixo','Festnetztelefon','noEcho'),
				),
			'phone'	=> array(
				'label'          => idioma('Mobile Phone','Telefono Movil','Telefone Celular','Mobiltelefon','noEcho'),
				),
			'fecha_naciminto'	=> array(
				'label'          => idioma('Birthdate','Fecha de Nacimiento','Data de nascimento','Geburtsdatum','noEcho'),
				),

			'city' => array(
				'label'       =>idioma('City','Ciudad','Cidade','Stadt','noEcho'),
				),
			'state' => array(
				'label'       => idioma('State','Provincia','Provincia','Provinz','noEcho'),
				),

			'postcode' => array(
				'label'       => idioma('Postcode','Codigo Postal','Código Postal','Postleitzahl','noEcho'),
				),


			'country' => array(
				'label'        => __( 'Country', 'woocommerce' ),
				'default'  => 'AR',
				'type'     => 'select',
				'options'  => array(
					'AR'        => 'Argentina',
					'BR' => 'Brasil',
				)


			),





		);

	return $fields;
}


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {



	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_country']);
	//unset($fields['billing']['billing_last_name']);

	unset($fields['billing']['billing_address_numero']);
	unset($fields['billing']['billing_address_depto']);
	unset($fields['billing']['billing_quien_recibe']);
	unset($fields['billing']['billing_Horario_de_Entrega']);
	unset($fields['billing']['billing_fecha_naciminto']);
	unset($fields['billing']['billing_telefonoFijo']);


	unset($fields['shipping']['shipping_first_name']);
	unset($fields['shipping']['shipping_last_name']);
	unset($fields['shipping']['shipping_company']);
	unset($fields['shipping']['shipping_Adress_2']);
	unset($fields['shipping']['shipping_DNICUIT']);
	unset($fields['shipping']['shipping_email']);
	unset($fields['shipping']['shipping_phone']);
	unset($fields['shipping']['shipping_email']);
	unset($fields['shipping']['shipping_fecha_naciminto']);
	unset($fields['shipping']['shipping_telefonoFijo']);

	unset($fields['order']['order_comments']);



	/*$fields['billing']['billing_first_name'] = array(
		'label'       => idioma('Name and Last name','Nombre y Apellido / Razón Social','Nome e Sobrenome','Name und Nachname','noEcho'),
		'description' => ''
		);*/

	$fields['billing']['billing_Comentario'] = array(
		'type' => 'textarea',
		'label'       => idioma('Comment','Comentario','Comentário','Kommentar','noEcho'),
		'description' => ''
		);
	$fields['shipping']['shipping_ComentarioAdicional'] = array(
		'type' => 'textarea',
		'label'       => idioma('Comment','Comentario Adicional','Comentário','Kommentar','noEcho'),
		'description' => ''
		);


	$fields['order']['shipping_metodoEnvio'] = array(
		'type' => 'radio',
		'label'       => __( '', 'woocommerce' ),
		'solicita_datos_de_envio' => array(),
		'options'     => array(),
		'default' => '',
		);
	global $opciones, $opcionesArray;


	$i =1;


	foreach ($opcionesArray['CarroDeCompras']['metodosDeEnvio'] as $ID => $valor) {

		$costo = 0;
		$campo = 'Tipo '.$i;
		$costoConFormato = '';
		$nombre = '';
		$descripcion ='';
		$tiempo = '';
		$volumen = '';
		$sucursales = '';

		if (key_exists('solicita_datos_de_envio', $valor))
			array_push($fields['order']['shipping_metodoEnvio']['solicita_datos_de_envio'], 1);
		else
			array_push($fields['order']['shipping_metodoEnvio']['solicita_datos_de_envio'], 0);

		if (key_exists('nombre', $valor) && $valor['nombre'] !== ''){
			$nombre = $valor['nombre'];
			$campo = $nombre;
		}


		if (key_exists('costo', $valor) && is_numeric($valor['costo']) && $valor['costo'] !== 0) {

			$costo = $valor['costo'];

			$campo = $costo.'-'.$valor['nombre'];

			$costoConFormato = '<br>$'.$costo;

		} else{
			$campo = '0-'.$campo;
		}

		if ($i === 1) {
			$fields['order']['shipping_metodoEnvio']['default'] = $campo;
		}


		if ($valor['descripcion']) {
			$descripcion = '<br>'.$valor['descripcion'];
		}

		if ($valor['tiempo']) {
			$tiempo = '<br>'.$valor['tiempo'];
		}

		if ($valor['volumen']) {
			$volumen = '<br><span class="volumen">'.$valor['volumen'].'</span>';
		}
		if ($valor['sucursales']) {

				$sucursales = '<br><select id="sel2Sucu" class="sucursales" name="shipping-metodoEnvio-sucursal-'.$campo.'">
				<option selected disabled>Elegí la sucursal</option>
				'.textareaEntreEtiquetas($valor['sucursales'],'option','sucursal','con value').'</select>';
		}

			$imagenMetodoEnvio = (array_key_exists('imagen',$valor)) ? '<img style="float:left" src="'.$valor['imagen']['img'].'">' : '' ;

			$fields['order']['shipping_metodoEnvio']['options'][ $campo ] =

			$imagenMetodoEnvio.

			'<span class="celda">'.'<b>'.$nombre.'</b>'.$descripcion.$costoConFormato.$tiempo.$volumen.$sucursales.'</span>';

				$i++;

	}

	return $fields;
}



// define the woocommerce_form_field_<type> callback
function filter_woocommerce_form_field_type( $field, $key, $args, $value ) {
   global $opciones;

   $field_container = '<p class="form-row %1$s" id="%2$s">%3$s</p>';
   switch ( $args['type'] ) {
	   case 'radio' :
	   			// vacio el $feld porque el foreach sigue concatenado el contenido de la funcion original
   				$field = '';

				$label_id = current( array_keys( $args['options'] ) );

				if ( ! empty( $args['options'] ) ) {


					reset($args['solicita_datos_de_envio']);
					foreach ( $args['options'] as $option_key => $option_text ) {

			$solicita_datos_de_envio = (current($args['solicita_datos_de_envio']) === 1) ? 'solicita_datos_de_envio ' : '';

						$field .= '<input type="radio" class="'.$solicita_datos_de_envio.'input-radio ' .
						esc_attr( implode( ' ', $args['input_class'] ) ) .
						'" value="' .
						esc_attr( $option_key ) .
						'" name="' .
						esc_attr( $key ) .
						'" id="' .
						esc_attr( $args['id'] ) .
						'_' .
						esc_attr( $option_key ) .
						'"' .
						checked( $value, $option_key, false )
						. ' />';
						$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) .'">' . $option_text . '</label>';

						next($args['solicita_datos_de_envio']);
					}
				}

				break;
	 }

	 if ( ! empty( $field ) ) {
	 	$field_html = '';

	 	if ( $args['label'] && 'checkbox' != $args['type'] ) {
	 		$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
	 	}

	 	$field_html .= $field;

	 	if ( $args['description'] ) {
	 		$field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
	 	}

	 	$container_class = 'form-row ' . esc_attr( implode( ' ', $args['class'] ) );
	 	$container_id = esc_attr( $args['id'] ) . '_field';

	 	$after = ! empty( $args['clear'] ) ? '<div class="clear"></div>' : '';

	 	$field = sprintf( $field_container, $container_class, $container_id, $field_html ) . $after;
	 }

    return $field;
};

// add the filter
add_filter( "woocommerce_form_field_radio", 'filter_woocommerce_form_field_type', 10, 4 );


add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {

	$theorder = wc_get_order( $post->ID );

	if ( ! empty( $_POST['shipping_metodoEnvio'] ) ) {

		$shipping_metodoEnvio = explode('-', $_POST['shipping_metodoEnvio']);


		$metodo = $shipping_metodoEnvio[1];

		$costoMetodo = $shipping_metodoEnvio[0];

		update_post_meta( $order_id, 'Metodo de Envio', sanitize_text_field( $metodo ) );

		update_post_meta( $order_id, 'Costo del Metodo de Envio', sanitize_text_field( $costoMetodo ) );

		update_post_meta( $order_id, '_shipping_metodoEnvio', sanitize_text_field( $metodo ) );

		update_post_meta( $order_id, '_shipping_metodoPago', $order->payment_method );




		if (isset($shipping_metodoEnvio[2]) && $shipping_metodoEnvio[2]!==''){

			$sucursal = $shipping_metodoEnvio[2];

			update_post_meta( $order_id, 'Sucursal', sanitize_text_field( $sucursal ) );

		} else{

			update_post_meta( $order_id, 'Sucursal', '-' );
		}

	}

	if ( ! empty( $_POST['billing_Comentario'] ) ) {
		update_post_meta( $order_id, 'Comentario', sanitize_text_field( $_POST['billing_Comentario'] ) );
	}
	if ( ! empty( $_POST['shipping_ComentarioAdicional'] ) ) {
		update_post_meta( $order_id, 'Comentario Adicional', sanitize_text_field( $_POST['shipping_ComentarioAdicional'] ) );
	}
	if ( ! empty( $_POST['shipping_quien_recibe'] ) ) {
		update_post_meta( $order_id, 'Quien Recibe o Retira', sanitize_text_field( $_POST['shipping_quien_recibe'] ) );
	}
	if ( ! empty( $_POST['shipping_Horario_de_Entrega'] ) ) {
		update_post_meta( $order_id, 'Horario de Entrega', sanitize_text_field( $_POST['shipping_Horario_de_Entrega'] ) );
	}
}

/*add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );
function custom_override_shipping_fields( $fields ) {
	unset($fields['shipping_first_name']);
	unset($fields['shipping_last_name']);
	unset($fields['shipping_company']);
	unset($fields['shipping_Adress_2']);
	unset($fields['shipping_DNICUIT']);
	unset($fields['shipping_email']);
	unset($fields['shipping_phone']);
	return $fields;
}
*/

add_filter( 'woocommerce_billing_fields' , 'custom_override_shipping_fields', 10, 2 );
function custom_override_shipping_fields( $address_fields, $country  ) {

	/*unset($fields['billing_email']);
	unset($fields['sbilling_phone']);*/

	$address_fields['billing_email'] = array(
		'label'		=> 'Email',
		'required'	=> false,
		'type'		=> 'email',
		'class'		=> array( 'form-row-first' ),
		'validate'	=> array( 'email' ),
	);
	$address_fields['billing_phone'] = array(
		'label'    	=> idioma('Mobile Phone','Telefono Movil','Telefone Celular','Mobiltelefon','noEcho'),
		'required' 	=> false,
		'type'		=> 'tel',
		'class'    	=> array( 'form-row-last' ),
		'clear'    	=> true,
		'validate' 	=> array( 'phone' ),
	);
	return $address_fields;
}





add_action( 'register_form', 'adding_custom_registration_fields' );
function adding_custom_registration_fields( ) {

	global $opciones;

	?>
	<input type="hidden" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />


	<h3><?php idioma('ACCESS DATA','DATOS DE ACCESO','','DATA ACCESS'); ?></h3>

	<div class="form-row form-row-wide">
		<div class="celda">
			<label for="reg_email"><?php idioma('E- mail ( this will be your username) *','Dirección de e-mail (este será su nombre de usuario)*','','E -Mail ( dies wird Ihr Benutzername sein ) *'); ?></label>
			<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
		</div>
		<div class="celda">
			<label for="reg_billing_first_name"><?php idioma('Re-enter e- mail *','Reingresar dirección de e-mail*','',''); ?></label>
			<input type="email" class="input-text" name="emailCONF" id="reg_emailCONF" size="30" value="<?php echo esc_attr( $emailCONF ) ?>" />
		</div>

	</div>

	<div class="form-row form-row-wide">
		<div class="celda">
			<label for="reg_password"><?php idioma('Password (minimum 6 characters ) *','Contraseña (minimo 6 caracteres alfanumericos)*','',''); ?></label>
			<input type="password" class="input-text" name="password" id="reg_password" />
		</div>
		<div class="celda">
			<label for="reg_passwordCONF"><?php idioma('Re-enter password *','Reingresar contraseña*','',''); ?></label>
			<input type="password" class="input-text" name="passwordCONF" id="reg_passwordCONF" />
		</div>

	</div>

	<h3><?php idioma('PERSONAL INFORMATION','DATOS PERSONALES','DADOS PESSOAIS',''); ?></h3>

	<div class="form-row form-row-wide">

		<div class="celda">
			<label for="reg_billing_first_name"><?php idioma('Full Name / Company Name','Nombre y Apellido / Razón Social','',''); ?><span class="required">*</span></label>
			<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" size="30" value="<?php echo esc_attr( $billing_first_name ) ?>" />
		</div>
		<div class="celda">
			<label for="reg_billing_DNICUIT"><?php idioma('ID / Tax ID','DNI / CUIT','',''); ?></label>
			<input type="text" class="input-text" name="billing_DNICUIT" id="reg_billing_DNICUIT" size="30" value="<?php echo esc_attr( $billing_DNICUIT ) ?>" />
		</div>

	</div>

	<div class="form-row form-row-wide">
		<div class="celda">
			<label for="reg_billing_telefonoFijo"><?php idioma('Telephone line (prefix + number)','Telefono Fijo (prefijo + número)',''); ?></label>
			<input type="text" class="input-text" name="billing_telefonoFijo" id="reg_billing_telefonoFijo" size="10" value="<?php echo esc_attr( $billing_telefonoFijo ) ?>" />
		</div>
		<div class="celda">
			<label for="reg_billing_phone"><?php idioma('Cell Phone (prefix + number)','Telefono Celular (prefijo + número)','',''); ?></label>
			<input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" size="10" value="<?php echo esc_attr( $billing_phone ) ?>" />
		</div>

	</div>

	<div class="form-row form-row-wide">
		<div class="celda">
			<label for="reg_billing_fecha_naciminto"><?php idioma('Birthdate','Fecha de Nacimiento','',''); ?></label>
			<input type="date" class="input-text" name="billing_fecha_naciminto" id="reg_billing_fecha_naciminto" size="10" value="<?php echo esc_attr( $billing_fecha_naciminto ) ?>" />
		</div>

	</div>

	<h3><?php idioma('DATA DELIVERY','DATOS DE ENTREGA','',''); ?></h3>

	<div class="form-row form-row-wide">
		<div class="celda">
			<label for="reg_shipping_nombre"><?php idioma('Name (eg : office, home, etc )','Nombre (Ej: oficina, mi casa, etc)','',''); ?></label>
			<input type="text" class="input-text" name="shipping_nombre" id="reg_shipping_nombre" size="10" value="<?php echo esc_attr( $shipping_nombre ) ?>" />
		</div>
		<div class="celda">
			<label for="reg_shipping_address_1"><?php idioma('Street Name','Nombre de Calle','',''); ?></label>
			<input type="text" class="input-text" name="shipping_address_1" id="reg_shipping_address_1" size="10" value="<?php echo esc_attr( $shipping_address_1 ) ?>" />
		</div>

	</div>

	<div class="form-row form-row-wide direccion">
		<div class="direccion celda">
			<div class="celdaDireccion">
				<label for="reg_shipping_address_numero"><?php idioma('N°','N°','',''); ?></label>
				<input type="text" class="input-text" name="shipping_address_numero" id="reg_shipping_address_numero" size="10" value="<?php echo esc_attr( $shipping_address_numero ) ?>" />
			</div>
			<div class="celdaDireccion">
				<label for="reg_shipping_address_piso"><?php idioma('Floor','Piso','',''); ?></label>
				<input type="text" class="input-text" name="shipping_address_piso" id="reg_shipping_address_piso" size="10" value="<?php echo esc_attr( $shipping_address_piso ) ?>" />
			</div>
			<div class="celdaDireccion">
				<label for="reg_shipping_address_depto"><?php idioma('Dep','Dpto','',''); ?></label>
				<input type="text" class="input-text" name="shipping_address_depto" id="reg_shipping_address_depto" size="10" value="<?php echo esc_attr( $shipping_address_depto ) ?>" />
			</div>
		</div>
		<div class="celda">
			<label for="reg_shipping_city"><?php idioma('Town or neighborhood','Localidad o Barrio o Partido','',''); ?></label>
			<input type="text" class="input-text" name="shipping_city" id="reg_shipping_city" size="10" value="<?php echo esc_attr( $shipping_city ) ?>" />
		</div>

	</div>

	<div class="form-row form-row-wide">
		<div class="celda">
			<label for="reg_shipping_state"><?php idioma('State','Provincia','',''); ?></label>
			<select name="shipping_state" id="reg_shipping_state">
				<option value="Buenos Aires">Buenos Aires</option>
				<option value="Catamarca">Catamarca</option>
				<option value="Chaco">Chaco</option>
				<option value="Chubut">Chubut</option>
				<option value="Córdoba">Córdoba</option>
				<option value="Corrientes">Corrientes</option>
				<option value="Entre Ríos">Entre Ríos</option>
				<option value="Formosa">Formosa</option>
				<option value="Jujuy">Jujuy</option>
				<option value="La Pampa">La Pampa</option>
				<option value="La Rioja">La Rioja</option>
				<option value="Mendoza">Mendoza</option>
				<option value="Misiones">Misiones</option>
				<option value="Neuquén">Neuquén</option>
				<option value="Río Negro">Río Negro</option>
				<option value="Salta">Salta</option>
				<option value="San Juan">San Juan</option>
				<option value="San Luis">San Luis</option>
				<option value="Santa Cruz">Santa Cruz</option>
				<option value="Santa Fe">Santa Fe</option>
				<option value="Santiago del Estero">Santiago del Estero</option>
				<option value="Tierra del Fuego">Tierra del Fuego</option>
				<option value="Tucumán">Tucumán</option>
			</select>
		</div>
		<div class="celda">
			<label for="reg_shipping_postcode"><?php idioma('Postal Code','Codigo Postal','',''); ?></label>
			<input type="text" class="input-text" name="shipping_postcode" id="reg_shipping_postcode" size="10" value="<?php echo esc_attr( $shipping_postcode ) ?>" />
		</div>

	</div>

	<div class="form-row form-row-wide">
		<label><?php idioma('Terms and Conditions','Terminos y Condiciones','',''); ?></label>

			<div class="terminosYcondiciones"> <?php echo textareaEntreTexto($opciones['avisosLegales-termYcond'], '', '<br>')  ?></div>
		</div>

		<?php

	}


//Updating use meta after registration successful registration
	add_action('woocommerce_created_customer','adding_extra_reg_fields');

	function adding_extra_reg_fields($user_id) {
		extract($_POST);
		update_user_meta($user_id, 'first_name', $billing_first_name);
		update_user_meta($user_id, 'billing_first_name', $billing_first_name);
		update_user_meta($user_id, 'shipping_quien_recibe', $billing_first_name);

		update_user_meta($user_id, 'email', $email);
		update_user_meta($user_id, 'billing_email', $email);

		update_user_meta($user_id, 'billing_DNICUIT', $billing_DNICUIT);
		update_user_meta($user_id, 'billing_telefonoFijo', $billing_telefonoFijo);
		update_user_meta($user_id, 'shipping_telefonoFijo', $billing_telefonoFijo);
		update_user_meta($user_id, 'billing_phone', $billing_phone);
		update_user_meta($user_id, 'shipping_phone', $billing_phone);
		update_user_meta($user_id, 'billing_fecha_naciminto', $billing_fecha_naciminto);

		update_user_meta($user_id, 'shipping_nombre', $billing_first_name);
		update_user_meta($user_id, 'shipping_address_1', $shipping_address_1);
		update_user_meta($user_id, 'shipping_address_numero', $shipping_address_numero);
		update_user_meta($user_id, 'shipping_address_piso', $shipping_address_piso);
		update_user_meta($user_id, 'shipping_address_depto', $shipping_address_depto);
		update_user_meta($user_id, 'shipping_city', $shipping_city);
		update_user_meta($user_id, 'shipping_state', $shipping_state);
		update_user_meta($user_id, 'shipping_postcode', $shipping_postcode);
	}











	add_filter( 'woocommerce_currencies', 'add_ars_currency' );
	function add_ars_currency( $currencies ) {
		$currencies['ARS'] = __( 'Pesos Argentinos', 'woothemes' );
		return $currencies;
	}

	add_filter( 'woocommerce_currency_symbol', 'add_ars_symbol', 1, 2);
	function add_ars_symbol( $currency_symbol, $currency ) {
		switch( $currency ) {
			case 'ARS': $currency_symbol = '$'; break;
		}
		return $currency_symbol;
	}

	function woocomerceSpanAnumero($str, $sinformato = 'true') {
		$arr = explode('>', $str);
		$arr2 = explode('<', $arr[1]);
		$arr3 = explode('$', $arr2[0]);
		$vowels = array(",");
		$sinComas = str_replace($vowels, "", $arr3[1]);
		if ($sinformato) {
			return number_format($sinComas,2,'.',',');
		} else {
			return $sinComas;
		}
	}


	add_action( 'wp_footer', 'cs_wc_loop_add_to_cart_scripts' );
	function cs_wc_loop_add_to_cart_scripts() { ?>
	<script>
		jQuery(document).ready(function($) {
			if ($('.quantity').length) {

				$('.qty').after('<span class="masMenos"><div data-product_id="" class="mas1"></div><div class="menos1"></div>');
				$('.qty').attr('readonly',true);

				$(':disabled').val('-');

				$('.mas1').click(function(){
					var input = $(this).offsetParent().find('.qty');

					pructoID = $(this).offsetParent().attr('data-product_id');
					botonSingle = ($('button[data-product_id="'+pructoID+'"]'));

					var button = $(this).offsetParent().offsetParent().find('.add_to_cart_button');


					if (input.val() <= parseInt( input.attr('max') - 1 ) ) {
						var valInic = input.val();
						var valNew = parseInt(valInic) + 1;
						input.val(valNew);
						button.attr('data-quantity', valNew);
						botonSingle.attr('data-quantity', valNew);
					}
				});

				$('.menos1').click(function(){

					var input = $(this).offsetParent().find('.qty');
					var button = $(this).offsetParent().offsetParent().find('.add_to_cart_button');

					if (input.val() > 1) {
						var valInic = input.val();
						var valNew = parseInt(valInic) - 1;
						input.val(valNew);
						button.attr('data-quantity', valNew);
						botonSingle.attr('data-quantity', valNew);
					}
				});

				$('.qty').each(function(){
					if ($(this).attr('max') === '0') {
						$(this).next().css({'display':'none'});
					}
				});


			}
		});

</script> <?php
}


function ras_login_redirect( $redirect_to ) {
	$redirect_to = get_bloginfo('url');
	return $redirect_to;
}
add_filter('woocommerce_login_redirect', 'ras_login_redirect');

function wc_custom_user_redirect( $redirect, $user ) {
	// Get the first of all the roles assigned to the user
	$dashboard = admin_url().'post-new.php?post_type=product';
	$myaccount = get_bloginfo('url');
	$role = $user->roles[0];
	if( $role == 'administrator' ) {
		//Redirect administrators to the dashboard
		$redirect = $dashboard;
	} elseif ( $role == 'shop_manager' ) {
		//Redirect shop managers to the dashboard
		$redirect = $dashboard;
	} elseif ( $role == 'editor' ) {
		//Redirect editors to the dashboard
		$redirect = $dashboard;
	} elseif ( $role == 'author' ) {
		//Redirect authors to the dashboard
		$redirect = $dashboard;
	} elseif ( $role == 'customer' || $role == 'subscriber' ) {
		//Redirect customers and subscribers to the "My Account" page
		$redirect = $myaccount;
	} else {
		//Redirect any other role to the previous visited page or, if not available, to the home
		$redirect = wp_get_referer() ? wp_get_referer() : home_url();
	}
	return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'wc_custom_user_redirect', 10, 2 );


// PARA Talles no hay que redireccionar
add_action( 'template_redirect', 'wc_custom_redirect_after_purchase' );
function wc_custom_redirect_after_purchase() {
	global $wp;

	if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) ) {
		wp_redirect( get_bloginfo('url').'/gracias' );
		WC()->cart->empty_cart() ;
		exit;
	}
}

/* Quitar actualizaciones de los plugins de la lista "unset"*/
/*
	add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );
	function disable_plugin_updates( $value ) {
		unset( $value->response['woocommerce/woocommerce.php'] );
		return $value;
	}
*/


function unset_grouped_and_external_product_types( $types ){
	unset($types['external']);
	unset($types['grouped']);
	//unset($types['variable']);
	return $types;

}
add_filter( 'product_type_selector', 'unset_grouped_and_external_product_types' );


function unset_virtual_downloadable_product_types_options( $types ){
	unset($types['downloadable']);
	unset($types['virtual']);
	return $types;

}
add_filter( 'product_type_options', 'unset_virtual_downloadable_product_types_options' );


function unset_shipping_product_data_tab( $tabs ){
	unset($tabs['shipping']);
	//unset($tabs['attribute']);
	/*unset($tabs['linked_product']);*/
	return $tabs;

}
add_filter( 'woocommerce_product_data_tabs', 'unset_shipping_product_data_tab');


add_filter( 'woocommerce_email_recipient_low_stock', 'email_asignado_por_autogestion', 1, 2 );
add_filter( 'woocommerce_email_recipient_no_stock', 'email_asignado_por_autogestion', 1, 2 );
add_filter('woocommerce_email_recipient_new_order', 'email_asignado_por_autogestion', 1, 2);
add_filter('woocommerce_email_recipient_cancelled_order', 'email_asignado_por_autogestion', 1, 2);
add_filter('woocommerce_email_recipient_failed_order', 'email_asignado_por_autogestion', 1, 2);
add_filter('woocommerce_email_recipient_backorder', 'email_asignado_por_autogestion', 1, 2);
add_filter( 'woocommerce_email_from_address', 'email_asignado_por_autogestion', null, 2 );
function email_asignado_por_autogestion( $recipient, $order ) {
    global $woocommerce, $opciones;
        $recipient = $opciones['contacto-mails-pedidos'];
    return $recipient;
}

add_filter( 'woocommerce_email_from_name', 'custom_use_customer_from_name', null, 2 );
function custom_use_customer_from_name ( $from_name, $obj ) {
		$from_name = get_bloginfo( 'name' );
	return $from_name;
}

function setea_numeros_datos_de_cuenta_bancaria(){

	global $opciones;

	$accounts = array();

	$account_names = array();
	$account_numbers = array();
	$bank_names = array();
	$sort_codes = array();
	$ibans = array();
	$bics = array();

	if (array_key_exists('CarroDeCompras-datosBanco-titular', $opciones))
		$account_names[ '0' ]   = $opciones['CarroDeCompras-datosBanco-titular'];


	if (array_key_exists('CarroDeCompras-datosBanco-Numero_De_Cuenta', $opciones))
		$account_numbers[ '0' ] = $opciones['CarroDeCompras-datosBanco-Numero_De_Cuenta'];

	if (array_key_exists('CarroDeCompras-datosBanco-Nombre_Del_Banco', $opciones))
		$bank_names[ '0' ]      = $opciones['CarroDeCompras-datosBanco-Nombre_Del_Banco'];

	if (array_key_exists('CarroDeCompras-datosBanco-tipo', $opciones))
		$sort_codes[ '0' ]      = $opciones['CarroDeCompras-datosBanco-tipo'];

	if (array_key_exists('CarroDeCompras-datosBanco-CBU', $opciones))
		$ibans[ '0' ]           = $opciones['CarroDeCompras-datosBanco-CBU'];

	if (array_key_exists('CarroDeCompras-datosBanco-BICSwift', $opciones))
		$bics[ '0' ]            = $opciones['CarroDeCompras-datosBanco-BICSwift'];


		$accounts[] = array(
			'account_name'   => $account_names[ '0' ],
			'account_number' => $account_numbers[ '0' ],
			'bank_name'      => $bank_names[ '0' ],
			'sort_code'      => $sort_codes[ '0' ],
			'iban'           => $ibans[ '0' ]
			// 'bic'            => $bics[ '0' ]
		);

	update_option( 'woocommerce_bacs_accounts', $accounts );
}
setea_numeros_datos_de_cuenta_bancaria();



add_filter( 'woocommerce_bacs_account_fields', 'ArrayDatosBancariosEmail', 10, 2 );
function ArrayDatosBancariosEmail( $array, $order_id ) {
	global $opciones;
    $array = array(
					'account_number'=> array(
						'label' => __( 'Account Number', 'woocommerce' ),
						'value' => $opciones['CarroDeCompras-datosBanco-Numero_De_Cuenta']
					),
					'account_name'   => array(
						'label' => __( 'Nombre de la cuenta', 'woocommerce' ),
						'value' => $opciones['CarroDeCompras-datosBanco-titular'],
					),
					'bank_name'      => array(
						'label' => __( 'Nombre del Banco', 'woocommerce' ),
						'value' => $opciones['CarroDeCompras-datosBanco-Nombre_Del_Banco'],
					),
					'tipo_De_cuenta'     => array(
						'label' => 'Tipo De Cuenta',
						'value' => $opciones['CarroDeCompras-datosBanco-tipo']
					),
					'datosBanco_CBU'      => array(
						'label' => __( 'CBU', 'woocommerce' ),
						'value' => $opciones['CarroDeCompras-datosBanco-CBU'],
					),
					'datosBanco_CUIT'      => array(
						'label' => __( 'CUIT', 'woocommerce' ),
						'value' => $opciones['CarroDeCompras-datosBanco-CUIT'],
					)


			);
    return $array;
};


add_filter( 'woocommerce_customer_meta_fields', 'DatosClientes', 10, 1 );
function DatosClientes($show_fields){
	$show_fields = array(
				'billing' => array(
					'title' => 'DATOS DE CONTACTO',
					'fields' => array(
						'billing_first_name' => array(
							'label'       => __( 'First name', 'woocommerce' ),
							'description' => ''
						),
						'billing_DNICUIT'	=> array(
							'label'         => 'DNI / CUIT',
						),
						'billing_email' => array(
							'label'       => __( 'Email', 'woocommerce' ),
							'description' => ''
						),
						'billing_phone' => array(
							'label'       => __( 'Telephone', 'woocommerce' ),
							'description' => ''
						),
						'billing_fecha_naciminto' => array(
							'label'       => 'Fecha de Nacimiento',
							'description' => '',
						),

						'billing_country' => array(
							'label' => 'Pais',
							'description' =>''
							),
						'billing_state' => array(
							'label' => 'Provincia',
							'description' =>''
							),
						'billing_city' => array(
							'label' => 'Ciudad',
							'description' =>''
							),
						'billing_postcode' => array(
							'label' => 'CP',
							'description' =>''
							),
						'billing_address_1' => array(
							'label' => 'Direccion',
							'description' =>''
							),
						'billing_last_name' => array(
							'label' => 'Apellido',
							'description' =>''
							),


					)
				),
				'shipping' => array(
					'title' => 'DATOS DE ENVIO',
					'fields' => array(
						'shipping_quien_recibe' => array(
							'label'       => idioma('Who receives','Quien Recibe o Retira','Quem recebe','Wer erhält','noEcho','noEcho'),
								'description' => ''
								),
						'shipping_Horario_de_Entrega' => array(
										'label'       => idioma('Delivery time','Horario de Entrega','Horario de Entrega','Delivery time','noEcho'),
										),
						'shipping_address_1' => array(
										'label'       => idioma('Adress','Dirección','Endereço', 'Adresse','noEcho'),
										),
						'shipping_address_numero' => array(
										'label'       => 'N°',
										'description' => ''
										),

						'shipping_address_depto' => array(
										'label'       => 'Dpto',
										'description' => ''
										),
						'shipping_city' => array(
										'label'       =>idioma('City','Ciudad','Cidade','Stadt','noEcho'),
										),
						'shipping_state' => array(
										'label'       => idioma('State','Provincia','Provincia','Provinz','noEcho'),
										),
						'shipping_postcode' => array(
										'label'       => idioma('Postcode','Codigo Postal','Código Postal','Postleitzahl','noEcho'),
										),
					)
				)
			);

	return $show_fields;
}
add_filter( 'woocommerce_admin_billing_fields', 'metaboxOrden_billing_fields', 10, 1 );
function metaboxOrden_billing_fields($array)
{
	$array = array(
				'first_name' => array(
					'label'       => __( 'First name', 'woocommerce' ),
					'description' => ''
				),
				'DNICUIT'	=> array(
					'label'         => 'DNI / CUIT',
				),
				'email' => array(
					'label'       => __( 'Email', 'woocommerce' ),
					'description' => ''
				),
				'phone' => array(
					'label'       => __( 'Telephone', 'woocommerce' ),
					'description' => ''
				),
			);
		return $array;
}
add_filter( 'woocommerce_admin_shipping_fields', 'metaboxOrden_shipping_fields', 10, 1 );
function metaboxOrden_shipping_fields($array)
{
	$array = array(
				'quien_recibe' => array(
								'label'       => idioma('Who receives','Quien Recibe o Retira','Quem recebe','Wer erhält','noEcho','noEcho'),
								'description' => ''
								),
				'Horario_de_Entrega' => array(
								'label'       => idioma('Delivery time','Horario de Entrega','Horario de Entrega','Delivery time','noEcho'),
								),
				'address_1' => array(
								'label'       => idioma('Adress','Dirección','Endereço', 'Adresse','noEcho'),
								),
				'address_numero' => array(
								'label'       => 'N°',
								'description' => ''
								),

				'address_depto' => array(
								'label'       => 'Dpto',
								'description' => ''
								),
				'city' => array(
								'label'       =>idioma('City','Ciudad','Cidade','Stadt','noEcho'),
								),
					'state' => array(
								'label'       => idioma('State','Provincia','Provincia','Provinz','noEcho'),
								),
				'postcode' => array(
								'label'       => idioma('Postcode','Codigo Postal','Código Postal','Postleitzahl','noEcho'),
								),
				'metodoEnvio' => array(
								'label'       => 'Metodo De Envio',
								),
				'metodoPago' => array(
								'label'       => 'Metodo De Pago',
								)

							);
		return $array;
}


// define the woocommerce_order_shipping_method callback
function filter_woocommerce_order_shipping_method( $implode, $instance ) {

			$order = wc_get_order();
			$sucursalMETA = get_post_meta( $order->id, 'Sucursal', true );
			$costoMETA = get_post_meta( $order->id, 'Costo del Metodo de Envio', true );
			$sucursal = ( $sucursalMETA !== '-') ? ' - ' . $sucursalMETA : '';
			$costo = ( $costoMETA !== '-') ? ' ( $' . $costoMETA . ' )' : '';

	$implode = get_post_meta( $order->id, 'Metodo de Envio', true ) . $sucursal . $costo;
    return $implode;
};

// add the filter
add_filter( 'woocommerce_order_shipping_method', 'filter_woocommerce_order_shipping_method', 10, 2 );

add_filter('woocommerce_variation_option_name', 'traduceQT', 0);
add_filter('woocommerce_attribute_label', 'traduceQT', 0);
function traduceQT($value)
{
	global $q_config;
	$value = $value . '###Sacar';
	$resultado = str_replace("###Sacar", "", $value);
	return $resultado.' ';

}

add_filter('woocommerce_available_variation', 'addidAtatchmentToVariation', 10, 3);
function addidAtatchmentToVariation($array, $this, $variation)
{
	$array['image-id'] = $variation->variation_id;//get_post_thumbnail_id($variation->variation_id);
	return $array;
}

function borrar_item_del_carro( $passed, $product_id, $quantity ) {
	if ( isset($_POST['borrar']) ){
		WC()->cart->set_quantity($_POST['key'],0);
		WC_AJAX::get_refreshed_fragments();
		$passed = false;
	} else{
		$passed = true;
	}
		return $passed;

}
add_filter( 'woocommerce_add_to_cart_validation', 'borrar_item_del_carro', 10, 3 );

remove_all_actions( 'woocommerce_before_shop_loop_item', 11 );
add_action( 'woocommerce_before_shop_loop_item', 'linkProducto', 10 );
function linkProducto() {
	echo '<a class="linkProducto" href="' . get_the_permalink() . '">';
}

function WC_ctegoty_base() {
	$permalinks = get_option( 'woocommerce_permalinks' );
	$permalinks['category_base'] = 'productos';
	update_option( 'woocommerce_permalinks', $permalinks );
}
WC_ctegoty_base();


add_filter(  'woocommerce_catalog_orderby', 'woocommerce_catalog_orderby', 10, 1 );
function woocommerce_catalog_orderby( $array ) {
	$array['title'] = idioma('Name','Nombre','Nome','','noEcho');
	unset($array['date']);
	return $array;
}

//add_filter('woocommerce_get_catalog_ordering_args', 'am_woocommerce_catalog_orderby');
function am_woocommerce_catalog_orderby( $args ) {
	$args['meta_key'] = '_sku';
	$args['orderby'] = 'meta_value';
	$args['order'] = 'asc';
	return $args;
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'nombreDelBotonAdd', 11, 2 );
function nombreDelBotonAdd ($nombre, $this){

	$nombre = idioma('Add to order','Agregar al pedido','Adicionar ao pedido','','noEcho');
	return $nombre;
}
//apply_filters( 'woocommerce_product_single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $this );


/*variables para las cotizaciones enviasdas por email usando la plantilla de prosesesando pedido*/
$cabeceraMail = '';
$mensajeEmail = '';


add_action('woocommerce_cart_calculate_fees','woocommerce_custom_surcharge' );
function woocommerce_custom_surcharge() {
    global $woocommerce, $opciones;

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
    return;

	$costoMetodo = 0;
	$metodo = '';

	if( key_exists('CarroDeCompras-valorEnvioGratis', $opciones) && is_numeric($opciones['CarroDeCompras-valorEnvioGratis']) && $opciones['CarroDeCompras-valorEnvioGratis'] <= $woocommerce->cart->cart_contents_total ) {
		$metodo = 'Mayor a '.$opciones['CarroDeCompras-valorEnvioGratis'];
	}else{

		if (!empty( $_POST['shipping_metodoEnvio'] )) {
			$shipping_metodoEnvio = explode('-', $_POST['shipping_metodoEnvio']);

			$metodo = 'Envio Via '.$shipping_metodoEnvio[1];

			$costoMetodo = $shipping_metodoEnvio[0];
		}

	}

    /*$percentage = 0.01;*/
    $surcharge = $costoMetodo; /*( $woocommerce->cart->cart_contents_total + $woocommerce->cart->shipping_total ) * $percentage; */
    $woocommerce->cart->add_fee( $metodo, $surcharge, true, '' );

}

function translate_woocommerce($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        switch ($text) {
            case 'SKU':
                $translation = 'Código';
                break;
            case 'SKU:':
                $translation = 'Código: ';
                break;
            case 'Cross-sells:':
                $translation = 'Productos Relacionados: ';
                break;
             case 'Cross-sells':
                $translation = 'Productos Relacionados';
                break;
             case 'Sort by price: low to high':
                $translation = idioma('High price','Mayor Precio','Maior preço','','NoEcho');
                break;
             case 'Sort by price: high to low':
                $translation = idioma('Low Price','Menor Precio','Preço baixo','','NoEcho');
                break;
            case 'Sort by popularity':
                $translation = idioma('By Popularity','Más Populares','Mais populares','','NoEcho');
                break;
        }
    }
    return $translation;
}

add_filter('gettext', 'translate_woocommerce', 10, 3);



add_filter( 'woocommerce_account_menu_items', 'itemsMyAcount',10, 1 );
function itemsMyAcount($items)
{
	$items = array(
			'dashboard'       => __( 'Dashboard', 'woocommerce' ),
			'orders'          => __( 'Orders', 'woocommerce' ),
			'downloads'       => __( 'Downloads', 'woocommerce' ),
			'edit-address'    => __( 'Addresses', 'woocommerce' ),
			'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
			'edit-account'    => __( 'Account Details', 'woocommerce' ),
			'customer-logout' => __( 'Logout', 'woocommerce' ),
		);
	unset($items['dashboard']);
	unset($items['downloads']);
	unset($items['payment-methods']);
	return $items;
}


/*add_action( 'woocommerce_before_single_product', 'cabeceras' );
function cabeceras() {

	global $post, $product, $opciones;

	$cat = get_the_terms( $product->id, 'product_cat');
		$vowels = array("-");
	$categoriaGuionBajo = str_replace($vowels, "_", $cat[0]->slug);


	?>

	<?php if ( key_exists('cabeceras-'.$categoriaGuionBajo.'-imagen-img', $opciones) && $opciones['cabeceras-'.$categoriaGuionBajo.'-imagen-img'] != '' ): ?>


		<div class="bannerPagina">

			<img data-peso="<?php echo pesoFile($opciones['cabeceras-'.$categoriaGuionBajo.'-imagen-img']) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-'.$categoriaGuionBajo.'-id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-'.$categoriaGuionBajo.'-id'], 't1352')[0] ?>" src="">
		</div>

	<?php endif;

}*/


// define the woocommerce_variation_options callback
function action_woocommerce_variation_options( $loop, $variation_data, $variation ) { ?>

	<script>
		jQuery(document).ready(function( $ ) {
			$('#woocommerce-product-data').on('woocommerce_variations_loaded', function(event) {

				alert('Cargo roduct_gallery_frame :D');


			    $( '.add_variation_images' ).on( 'click', 'a', function( event ) {
			    	var loop = $(this).attr('data-loop');
				   var product_gallery_frame;
				    var $image_gallery_ids = $( '#variation_image_gallery'+loop );
				    var $product_images    = $( '#variation_images_container'+loop ).find( 'ul.product_images' );
				    console.log($product_images);
			        var $el = $( this );

			        event.preventDefault();

			        // If the media frame already exists, reopen it.
			        if ( product_gallery_frame ) {
			            product_gallery_frame.open();
			            return;
			        }

			        // Create the media frame.
			        product_gallery_frame = wp.media.frames.product_gallery = wp.media({
			            // Set the title of the modal.
			            title: $el.data( 'choose' ),
			            button: {
			                text: $el.data( 'update' )
			            },
			            states: [
			                new wp.media.controller.Library({
			                    title: $el.data( 'choose' ),
			                    filterable: 'all',
			                    multiple: true
			                })
			            ]
			        });

			        // When an image is selected, run a callback.
			        product_gallery_frame.on( 'select', function() {
			            var selection = product_gallery_frame.state().get( 'selection' );
			            var attachment_ids = $image_gallery_ids.val();

			            selection.map( function( attachment ) {
			                attachment = attachment.toJSON();

			                if ( attachment.id ) {
			                    attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
			                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

			                    $product_images.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );
			                }
			            });

			            $image_gallery_ids.val( attachment_ids );
			        });

			        // Finally, open the modal.
			        product_gallery_frame.open();
			    });

			   /* // Image ordering.
			    $product_images.sortable({
			        items: 'li.image',
			        cursor: 'move',
			        scrollSensitivity: 40,
			        forcePlaceholderSize: true,
			        forceHelperSize: false,
			        helper: 'clone',
			        opacity: 0.65,
			        placeholder: 'wc-metabox-sortable-placeholder',
			        start: function( event, ui ) {
			            ui.item.css( 'background-color', '#f6f6f6' );
			        },
			        stop: function( event, ui ) {
			            ui.item.removeAttr( 'style' );
			        },
			        update: function() {
			            var attachment_ids = '';

			            $( '#product_images_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
			                var attachment_id = $( this ).attr( 'data-attachment_id' );
			                attachment_ids = attachment_ids + attachment_id + ',';
			            });

			            $image_gallery_ids.val( attachment_ids );
			        }
			    });*/

			    // Remove images.
			    $( '#product_images_container' ).on( 'click', 'a.delete', function() {
			        $( this ).closest( 'li.image' ).remove();

			        var attachment_ids = '';

			        $( '#product_images_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
			            var attachment_id = $( this ).attr( 'data-attachment_id' );
			            attachment_ids = attachment_ids + attachment_id + ',';
			        });

			        $image_gallery_ids.val( attachment_ids );

			        // Remove any lingering tooltips.
			        $( '#tiptip_holder' ).removeAttr( 'style' );
			        $( '#tiptip_arrow' ).removeAttr( 'style' );

			        return false;
			    });
			});
		});
	</script>

	 <?php
}


function variable_fields_js(){ ?>

	<script>
		jQuery(document).ready(function( $ ) {


			$('#woocommerce-product-data').on('woocommerce_variations_loaded', function(event) {
			    // Remove images.
			    function deleteItem() {
				    $( 'a.delete' ).on( 'click', function(e) {
				    	e.preventDefault();
				    	var loop = $(this).attr('data-loop');

						var $image_gallery_ids = $( '#variation_image_gallery_'+loop );

					    var $product_images    = $( '#variation_images_container_'+loop ).find( 'ul li.image' );

					    var elementoAremover = $( this ).closest( 'li.image' );

					    var idAremover = elementoAremover.attr('data-attachment_id');

					    var valueAntes = $image_gallery_ids.val();

					    var valueAntesARR = valueAntes.split(',');

					    var indiceAremover = valueAntesARR.indexOf(idAremover);

					    valueAntesARR.splice(indiceAremover, 1);


					    var valueDespues = valueAntesARR.join(',');

					    elementoAremover.remove();
					    $('.woocommerce_variation').addClass( 'variation-needs-update' );
					    $('#variable_product_options_inner .toolbar button').removeAttr('disabled');

				        /*var attachment_ids = '';

				        $product_images.css( 'cursor', 'default' ).each( function() {
				            var attachment_id = $( this ).attr( 'data-attachment_id' );
				            attachment_ids = attachment_ids + attachment_id + ',';
				        });*/

				        				        $image_gallery_ids.val( valueDespues );

				        // Remove any lingering tooltips.
				        $( '#tiptip_holder' ).removeAttr( 'style' );
				        $( '#tiptip_arrow' ).removeAttr( 'style' );

				        return false;
				    });
			    }
			    deleteItem();

			    $( '.add_variation_images' ).on( 'click', 'a', function( event ) {



			    	var loop = $(this).attr('data-loop');
				    var product_gallery_frame;
				    var $image_gallery_ids = $( '#variation_image_gallery_'+loop );
				    var $product_images    = $( '#variation_images_container_'+loop ).find( 'ul.product_images' );
				    console.log($product_images);
			        var $el = $( this );

			        event.preventDefault();

			        // If the media frame already exists, reopen it.
			        if ( product_gallery_frame ) {
			            product_gallery_frame.open();
			            return;
			        }

			        // Create the media frame.
			        product_gallery_frame = wp.media.frames.product_gallery = wp.media({
			            // Set the title of the modal.
			            title: $el.data( 'choose' ),
			            button: {
			                text: $el.data( 'update' )
			            },
			            states: [
			                new wp.media.controller.Library({
			                    title: $el.data( 'choose' ),
			                    filterable: 'all',
			                    multiple: true
			                })
			            ]
			        });

			        // When an image is selected, run a callback.
			        product_gallery_frame.on( 'select', function() {
			            var selection = product_gallery_frame.state().get( 'selection' );
			            var attachment_ids = $image_gallery_ids.val();

			            selection.map( function( attachment ) {
			                attachment = attachment.toJSON();

			                if ( attachment.id ) {
			                    attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
			                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

			                    $product_images.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" data-loop="'+loop+'" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );

			                }
			            });

			            $('.woocommerce_variation').addClass( 'variation-needs-update' );
			            $('#variable_product_options_inner .toolbar button').removeAttr('disabled');

			            deleteItem();

			            $image_gallery_ids.val( attachment_ids );
			        });

			        // Finally, open the modal.
			        product_gallery_frame.open();
			    });

			    // Image ordering.

			    $('.variation_images_container').each(function() {

			    	var $product_images = $( this ).find( 'ul.product_images' );
			    	var idContenedor =  $( this ).attr('id');




				    $product_images.sortable({
				        items: 'li.image',
				        cursor: 'move',
				        scrollSensitivity: 40,
				        forcePlaceholderSize: true,
				        forceHelperSize: false,
				        helper: 'clone',
				        opacity: 0.65,
				        placeholder: 'wc-metabox-sortable-placeholder',
				        start: function( event, ui ) {
				            ui.item.css( 'background-color', '#f6f6f6' );
				        },
				        stop: function( event, ui ) {
				            ui.item.removeAttr( 'style' );
				        },
				        update: function() {
				            var attachment_ids = '';
				            var $image_gallery_ids = $( '#'+idContenedor ).find('input');
				            var $liItems = $( '#'+idContenedor ).find( 'ul li.image' );
				            $liItems.css( 'cursor', 'default' ).each( function(index) {
				                var attachment_id = $( this ).attr( 'data-attachment_id' );
				                attachment_ids = attachment_ids + attachment_id;

				                if (index !== $liItems.length - 1) {
							    	attachment_ids = attachment_ids + ',';
							    }
				            });


				            $image_gallery_ids.val( attachment_ids );
				            $('.woocommerce_variation').addClass( 'variation-needs-update' );
				            $('#variable_product_options_inner .toolbar button').removeAttr('disabled');

				        }
				    });
			    });



			});
		});
	</script>

<?php }


function save_variable_fields( $post_id ){

		if ( isset( $_POST['variable_sku'] ) ) {

			$variable_post_id = $_POST['variable_post_id'];
			$_variation_description = array();

			if ( ! empty( $_POST['galeriaVariacion'] ) ) {
				$_variation_description = $_POST['	galeriaVariacion'];
			}

			$max_loop = max( array_keys( $_POST['variable_post_id'] ) );

			for ( $i = 0; $i <= $max_loop; $i ++ ) {

				if ( ! isset( $variable_post_id[ $i ] ) ) {
					continue;
				}
				$variation_id = absint( $variable_post_id[ $i ] );

				update_post_meta( $variation_id, '_galeriaVariacion', wc_clean( $_variation_description[ $i ] ) );

			}
		}

}
add_action( 'admin_footer', 'variable_fields_js' );

//add_action( 'woocommerce_variation_options', 'action_woocommerce_variation_options', 10, 3 );
//add_action( 'woocommerce_process_product_meta_variable', 'save_variable_fields', 10, 1 );
//add_action( 'woocommerce_process_product_meta_variable-subscription' , 'save_variable_fields' , 10 , 1 ) ;

function guardasDatosMercadoPago($opciones) {
	$antes = get_option('woocommerce_mercadopago_settings');
	$antes['client_id'] = $opciones['CarroDeCompras-datosMercadoPago-Client_id'];
	$antes['client_secret'] = $opciones['CarroDeCompras-datosMercadoPago-Client_secret'];
	$antes['sandbox'] = $opciones['CarroDeCompras-datosMercadoPago-sandbox'];
	$antes['enabled'] = $opciones['CarroDeCompras-datosMercadoPago-estado'];
	$antes['enabled'] = $opciones['CarroDeCompras-datosMercadoPago-estado'];
	update_option( 'woocommerce_mercadopago_settings', $antes );
}

function guardasDatosTodoPago($opciones) {
	$antes = get_option('woocommerce_todopago_settings');

	$merchant_id_prod = $opciones['CarroDeCompras-datosTodoPago-merchant_id_prod'];
	$APIkeyProd = $opciones['CarroDeCompras-datosTodoPago-http_header_prod'];
	$securityProd = explode(' ', $APIkeyProd)[1];

	$merchant_id_test = $opciones['CarroDeCompras-datosTodoPago-merchant_id_test'];
	$APIkeyTest = $opciones['CarroDeCompras-datosTodoPago-http_header_test'];
	$securityTest = explode(' ', $APIkeyTest)[1];

	$antes['merchant_id_prod'] = $merchant_id_prod;
	$antes['http_header_prod'] = $APIkeyProd;
	$antes['security_prod'] = $securityProd;

	$antes['merchant_id_test'] = $merchant_id_test;
	$antes['http_header_test'] = $APIkeyTest;
	$antes['security_test'] = $securityTest;

	$antes['ambiente'] = $opciones['CarroDeCompras-datosTodoPago-sandbox'];
	$antes['enabled'] = $opciones['CarroDeCompras-datosTodoPago-estado'];

	update_option( 'woocommerce_todopago_settings', $antes );


}

add_action( 'alGrabarOpciones', 'guardasDatosMercadoPago', 10, 1 );
add_action( 'alGrabarOpciones', 'guardasDatosTodoPago', 10, 1 );

?>
