<?php

global $product, $post, $opciones, $opcionesArray, $woocommerce, $messages;
setup_postdata( $post->ID );
?>
<!doctype html>
<html class="no-js" lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <?php if ( is_woocommerce() || is_single() || is_page() ) {  ?>
    <meta property="og:title" content="<?php echo get_the_title() ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo get_permalink() ?>" />
    <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo(strip_tags('name')) ?>" />
    <?php if (has_post_thumbnail( $post->ID )): ?>
        <meta property="og:image" content="<?php $featuredimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Full')[0]; echo $featuredimg; ?>" />
    <?php endif ?>
    <?php } ?>

    <?php

    $title = wp_title('|', false, 'right') . ' ' . get_bloginfo('name');


    $cat = $wp_query->get_queried_object();

    if ($cat->slug) {
        $categoriaGuionBajo = $cat->slug;
    } elseif ($cat->post_name) {
        $categoriaGuionBajo = $cat->post_name;
    }else{
        $categoriaGuionBajo = $cat->query_var;
    }


    if (key_exists('cabeceras-'.$categoriaGuionBajo.'-meta_title', $opciones)) {

        $title = __($opciones['cabeceras-'.$categoriaGuionBajo.'-meta_title']);

    }
    /*if( is_woocommerce() && key_exists('cabeceras-mi_compra-meta_title', $opciones )){

         $title = __($opciones['cabeceras-mi_compra-meta_title']);

    }*/

    /*$ObjCats = get_the_terms( $post->ID, 'product_cat' )[0];
    $cats =   $ObjCats->slug;
    if( is_product_category() && key_exists('cabeceras-'.$cats.'-meta_title', $opciones)){
         $title = __($opciones['cabeceras-'.$cats.'-meta_title']);
    } */

    ?>

    <title><?php echo $title;?></title>

    <?php


    $textoDescription = strip_tags( resumen( __(get_the_content()) , 155) );

    if (key_exists('cabeceras-'.$categoriaGuionBajo.'-meta_description', $opciones)) {

        $textoDescription = __($opciones['cabeceras-'.$categoriaGuionBajo.'-meta_description']);

    }
    if(get_the_content() === ''){

        $textoDescription = get_the_title();

    }

    /*if(is_woocommerce() && key_exists('cabeceras-mi_compra-meta_description', $opciones )){

         $textoDescription = __($opciones['cabeceras-mi_compra-meta_description']);

    }

    if(is_woocommerce() && key_exists('cabeceras-mi_compra-meta_description', $opciones )){

         $textoDescription = __($opciones['cabeceras-mi_compra-meta_description']);

    }
    if(is_product_category() && key_exists('cabeceras-'.$cats.'-meta_description', $opciones)){
         $textoDescription = __($opciones['cabeceras-'.$cats.'-meta_description']);
    } */

    ?>


    <meta name="description" content="<?php echo $textoDescription?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo get_bloginfo('template_url');?>/favicon.ico">

    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>

</head>

<body>
    <?php if (key_exists('codigoAnalitics', $opciones))
        echo $opciones['codigoAnalitics']
    ?>

    <script type="text/javascript">

        var templateUrl = '<?php echo get_bloginfo("template_url"); ?>';
        var blogURL = '<?php echo get_bloginfo("url"); ?>';

    </script>

    <!-- <div class="loaderContainer">
        <div class="loader">
            <img class="logoLoader" src="<?php echo wp_get_attachment_image_src( $opciones['logo-id'], 't320')[0] ?>">
            <br>
            <img class="pageloader" src="<?php echo get_bloginfo('template_url');?>/img/pageloader.svg">
        </div>
    </div> -->





        <div id="logoImpresion">
            <img src="<?php echo $opciones['logo'] ?>">
            <div class="h3">Cotizacion al la fecha <?php echo date('d M Y'); ?></div>

            <div class="footerImprimir">
                <p><?php echo $opciones['contacto-telefonos'] ?></p>
                <p><?php echo $opciones['contacto-postal-direccion'] ?></p>
                <p class="inlineBlockEnMovil"><?php echo $opciones['contacto-postal-ciudad'] ?> - <?php echo $opciones['contacto-postal-provincia'] ?></p>
                <p><?php echo $opciones['contacto-postal-pais'] ?></p>
            </div>
        </div>

        <div id="cotizacionMail">
            <div class="close">&times</div>
            <h2>Deseo recibir esta cotización a mi correo</h2>
            <p>Ingresa el email en el cual deseas recibir tu cotización</p>

            <form id="cotizacionEmail" action="<?php echo get_bloginfo('url')?>/carro" method="post">

                <input type="hidden" name="accion" value="mailTo">

                <div class="obligatorio">
                    <p><input placeholder="email" type="email" name="email" id="email"></p>
                </div>

                <div class="botonGeneral send">Continuar</div>

                <div class="enviar clearfix">

                    <div class="estado" id="estado">

                        <div class="error" id="err-form" style="display: none;"></div>

                        <div class="error" id="err-timedout">Error de conexión. Intente nuevamente.</div>

                        <div class="error" id="err-state"></div>

                        <div id="ajaxsuccess">Su Cotización ha sido enviada!</div>

                    </div>

                </div>

            </form>

        </div>

        <div id="suscribite" class="modal">
        <div class="close icon-cruz"></div>
             <h2><?php idioma('Suscribe','Suscribirme',''); ?></h2>

             <div class="encabezado oculto">
                 <p><?php idioma('Receive our news in your email','Recibí nuestras novedades en tu email','Receba nossas notícias no seu e-mail'); ?></p>
             </div>
             <form  id="suscribiteForm">

                 <input type="hidden" name="mailDestino" value="<?php echo $opciones['contacto-mails-formularios'] ?>">
                 <input type="hidden" name="nombreEmpresa" value="<?php echo get_bloginfo('name')?>">
                 <input type="hidden" name="suscripcion" value="true">

                 <div class="obligatorio">
                     <p><input placeholder="<?php idioma('NAME AND LASTNAME','NOMBRE Y APELLIDO','NOME E SOBRENOME'); ?>" type="text" name="Nombre" id="Nombre" ></p>
                 </div>

                 <div class="obligatorio">
                     <p><input placeholder="EMAIL" type="text" name="E_mail" id="E_mail"></p>
                 </div>

                 <div type="submit" class="send botonGeneral"> <?php idioma('Send','Enviar','Enviar') ?></div>

                 <div class="enviar clearfix">

                     <div class="estado" id="estado" class="bloque">

                         <div class="error" id="err-form"></div>

                         <div class="error" id="err-timedout">Error de conexión. Intente nuevamente.</div>

                         <div class="error" id="err-state"></div>

                         <div id="ajaxsuccess"><?php idioma('Thank for suscribe!!','Gracias Por Sucribirte!!','Sua mensagem foi enviado!!') ?></div>

                     </div>

                 </div>

             </form>
        </div>

        <header>

            <div class="contenedor">


                <div class="banner">

                    <div class="logo">
                        <a href="<?php echo get_bloginfo('url') ?>" title="<?php idioma('Home','Inicio','Inicio'); ?>"><img src="<?php echo $opciones['logo'] ?>" alt="<?php echo get_bloginfo('name') ?>"></a>
                    </div>
                    <div class="btnMenu">
                        <span id="menuToggle">MENU</span>
                    </div>

                    <nav>
                        <ul id="menu">
                            <?php include('nav.php'); ?>
                        </ul>
                    </nav>

                    <div class="flex-sb flexGrow08">


                        <div id="buscar">

                                <?php // the_widget( 'WC_Widget_Product_Search' ); ?>
                                <?php  echo do_shortcode('[yith_woocommerce_ajax_search]'); ?>

                        </div>
                        <div class="idioma">
                            <?php
                                /*include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                                if ( is_plugin_active( 'qtranslate-x/qtranslate.php' ) ) {
                                    echo qtranxf_generateLanguageSelectCode('dropdown');
                                    //echo qtranxf_generateLanguageSelectCode('text');
                                              // otra opciones both / image
                                }*/

                                ?>

                                <select id="qtranxs_select_qtranslate-chooser" class="dropdown">
                                    <?php
                                        if(is_404()) $url = get_option('home'); else $url = '';
                                        global $q_config;
                                    ?>

                                    <?php foreach(qtranxf_getSortedLanguages() as $language): ?>
                                        <option value="<?php echo qtranxf_convertURL($url, $language, false, true)?>"><?php echo $q_config['language_name'][$language] ?></option>
                                    <?php endforeach ?>
                                </select>
                        </div>

                        <?php if (!is_checkout()): ?>
                            <div id="carritoActual" class="ToggleMenu" data-target=".tuOrden">
                                <span id="cantidadActual" class="count"><?php echo WC()->cart->get_cart_contents_count() ?></span>
                            </div>
                        <?php endif ?>

                        <div class="login-header " id="login-header"  >
                            <i class="icon icon-user ToggleMenu" data-target="#barraSecundaria"></i>
                            <div id="barraSecundaria" class="icon icon-triangulot">
                                <div class="close ApareceEnMovil">&times</div>


                                <div id="barraLogueo">
                                    <?php if ( !is_user_logged_in() ) : ?>

                                            <div class="menu">
                                                <span class="abreRegitro" data-modal="#formRegistro"><?php idioma('Sign in','Registrarme','Registe-se') ?></span>
                                                <span><?php idioma('Login','Inicia Sesión','Inicia sessão'); ?></span>
                                            </div>

                                            <form method="post" class="login" style="<?php if ( $hidden ) echo 'display:none'?>">

                                                <?php do_action( 'woocommerce_login_form_start' ); ?>

                                                <?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>


                                                <span>Email</span>
                                                <input placeholder="<?php idioma('user@email.com','usuario@email.com','usuario@email.com' ) ?>" type="text" class="input-text" name="username" id="username" />

                                                <div class="flex-sb">
                                                    <span><?php idioma('Password','Contraseña','Senha'); ?></span>
                                                    <span class="lost_password"><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a></span>
                                                </div>
                                                <input placeholder="<?php idioma('Enter your password','Ingresá tu contraseña','Digite sua senha'); ?>" class="input-text" type="password" name="password" id="password" />

                                                <?php do_action( 'woocommerce_login_form' ); ?>

                                                <?php wp_nonce_field( 'woocommerce-login' ); ?>

                                                <input type="submit" class="button" name="login" value="<?php idioma('Login','Ingresar',''); ?>" />


                                                <?php do_action( 'woocommerce_login_form_end' ); ?>

                                            </form>



                                    <?php else: global $current_user; get_currentuserinfo(); ?>
                                        <div class="infoLogueado">
                                            <p><?php idioma('Welcome','Bienvenido ','Bem-vindo'); ?></p>
                                            <h2><?php echo $current_user->display_name ?></h2>

                                            <a class="modalRegistroUsuario botonGeneral" href="<?php echo wp_logout_url( home_url() ); ?>">
                                                <?php idioma('Logout','Cerrar Sesión','Terminar sessão'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="menuDeplegable ">
                <?php include('nav.php'); ?>
               <!--  <div class="cerrar"><?php idioma('Close<br>Menu','Cerrar<br>Menu',''); ?></div> -->
            </div>
            <div class="contenedor">
                <div class="tuOrden">
                    <?php  the_widget('WC_Widget_Cart');?>
                </div>
            </div>

            <div id="cat-coleccion" class="toggleTarget">
                <div class="categorias-contenedor">
                         <?php
                            $args = array(
                              'post_type' => 'product',
                              'posts_per_page' => 1,
                              'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'slug',
                                        'terms'    => 'destacado-en-menu',

                                    ),
                                ),

                              );

                              $loop = new WP_Query( $args );

                              ?>

                                <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;

                                    $images = rwmb_meta( 'destacadaMenu', 'size=t768' );

                                ?>

                                <?php if (!empty($images)): ?>
                                    <div class="pd">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_image_src( array_values($images)[0]['ID'], 't768')[0] ?>"><span class="vm">Ver mas . . .</span>
                                        </a>

                                    </div>
                                <?php endif ?>

                                <?php endwhile; ?>

                        <?php wp_reset_query(); ?>

                    <ul id="menuProductos">
                        <?php
                            $args = array(
                                    'child_of'            => get_term_by( 'slug', 'coleccion', 'product_cat' )->term_id,
                                    'current_category'    => 1,
                                    'depth'               => 0,
                                    'echo'                => 1,
                                    'exclude'             => '',
                                    'exclude_tree'        => '',
                                    'feed'                => '',
                                    'feed_image'          => '',
                                    'feed_type'           => '',
                                    'hide_empty'          => 1,
                                    'hide_title_if_empty' => false,
                                    'hierarchical'        => true,
                                    'order'               => 'ASC',
                                    'orderby'             => 'name',
                                    'separator'           => '<br />',
                                    'show_count'          => 0,
                                    'show_option_all'     => '',
                                    'show_option_none'    => __( 'No categories' ),
                                    'style'               => 'list',
                                    'taxonomy'            => 'product_cat',
                                    'title_li'            => '',
                                    'use_desc_for_title'  => 1,
                                );



                           wp_list_categories( $args );
                        ?>
                    </ul>
                </div>
            </div>
            <div id="cat-team" class="toggleTarget">
                <div class="categorias-contenedor">
                         <?php
                            $args = array(
                              'post_type' => 'post',
                              'posts_per_page' => 1,
                              'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field'    => 'slug',
                                        'terms'    => 'team',

                                    ),
                                ),

                              );

                              $loop = new WP_Query( $args );

                              ?>

                                <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;

                                    $images = rwmb_meta( 'destacadaMenu', 'size=t768' );

                                ?>

                                <?php if (!empty($images)): ?>
                                    <div class="pd">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_image_src( array_values($images)[0]['ID'], 't768')[0] ?>"><span class="vm">Ver mas . . .</span>
                                        </a>

                                    </div>
                                <?php endif ?>

                                <?php endwhile; ?>

                        <?php wp_reset_query(); ?>

                    <ul id="menuProductos">
                        <?php
                            $args = array(
                                    'child_of'            => get_term_by( 'slug', 'team', 'category' )->term_id,
                                    'current_category'    => 1,
                                    'depth'               => 0,
                                    'echo'                => 1,
                                    'exclude'             => '',
                                    'exclude_tree'        => '',
                                    'feed'                => '',
                                    'feed_image'          => '',
                                    'feed_type'           => '',
                                    'hide_empty'          => 1,
                                    'hide_title_if_empty' => false,
                                    'hierarchical'        => true,
                                    'order'               => 'ASC',
                                    'orderby'             => 'name',
                                    'separator'           => '<br />',
                                    'show_count'          => 0,
                                    'show_option_all'     => '',
                                    'show_option_none'    => __( 'No categories' ),
                                    'style'               => 'list',
                                    'taxonomy'            => 'category',
                                    'title_li'            => '',
                                    'use_desc_for_title'  => 1,
                                    'walker' => new Walker_Category_Posts(),
                                );


                                class Walker_Category_Posts extends Walker_Category {

                                    function start_el(&$output, $category, $depth, $args) {

                                        $this->category = $category;

                                        parent::start_el($output, $category, $depth, $args);
                                    }

                                    function end_el(&$output, $page, $depth, $args) {
                                        if ( 'list' != $args['style'] )
                                            return;

                                        $posts = get_posts( array(
                                            'cat' => $this->category->term_id,
                                            'numberposts' => -1,
                                        ) );

                                        if( !empty( $posts ) ) {

                                            $posts_list = '<ul class="children">';

                                            foreach( $posts as $post )
                                                $posts_list .= '<li><a href="' . get_permalink( $post->ID ) . '">'.get_the_title( $post->ID ).'</a></li>';

                                            $posts_list .= '</ul>';
                                        }
                                        else {
                                            $posts_list = '';
                                        }

                                        $output .= "{$posts_list}</li>\n";
                                    }
                                }

                           wp_list_categories( $args );
                        ?>
                    </ul>
                </div>
            </div>
            <div id="barraPostMenu">
                <div class="contenedor">

                    <div></div>
                    <div>
                       <?php echo $opciones['cabecera-barraPostMenu'] ?>
                       <span class="suscribite abreModal" data-modal="#suscribite"><?php idioma('Suscribe','Suscribirme',''); ?><span class="icon icon-triangulr"></span></span>


                    </div>
                    <div>
                       <?php include 'redesSociales.php' ?>
                    </div>
                </div>
            </div>

        </header>

<div class="woocommerce"><?php wc_print_notices(); ?></div>

<script type="text/javascript">
    var galeriasDeVariciones = {};
</script>