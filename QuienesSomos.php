<?php
/*
Template Name: QuienesSomos
*/
 ?>

<?php $pagina = 'Quienes Somos' ?>

<?php include('header.php'); ?>

<aside>
	<div class="lineaMarron">
	    <div class="contenedor"></div>
	</div>
	<div class="contenedor">
		<img id="embase" class="chico" src=" <?php echo idioma(get_bloginfo('template_url').'/img/embase-ingles.png',get_bloginfo('template_url').'/img/embase-espanol.png','',get_bloginfo('template_url').'/img/embase-aleman.png'); ?> ">
 		<img class="fondoAside" data-url="<?php echo get_bloginfo('template_url')?>/img/quienes-somos.jpg" src="">
 	</div>

 	<div class="lineaMarron">
 		<div class="contenedor"></div>
 	</div>
</aside>


<main>
	<div class="contenedor">
		<div class="apretador">
			<h2><?php echo idioma('Who we are ?','Nuestra Empresa','','Das Unternehmen'); ?></h1>
			<p><?php echo idioma(
				'We are a company specializing in liquid sealants and have developed a unique product, liquid, easy to apply to seal leaks in boilers, baths, water heaters, heat exchangers, radiators, underfloor heating systems, pipes (also embedded), deposits and other water systems.</p>
				We have distributors worldwide in Latin America, the U.S. and Germany.<br>',
				'Somos una empresa especialista en selladores líquidos y hemos desarrollado un producto único, líquido, de fácil aplicación para sellar fugas en calderas de calefacción, termas, calentadores de agua, intercambiadores de calor, radiadores, calefacciones de suelo, tuberías (también empotradas), depósitos y otros sistemas de agua.<br>
				Poseemos distribuidores a nivel mundial en América Latina, Estados Unidos y Alemania.',
				'',

				'Wir sind ein Unternehmen, spezialisiert auf flüssige Dichtungsmittel und haben ein einzigartiges Produkt, das flüssige, leicht zu verarbeiten,um Lecks in Kesseln, Bäder, Warmwasserbereiter, Wärmetauscher, Heizkörper, Fußbodenheizung, Rohre (auch eingebettet), Einlagen und andere Wasser abdichten Systeme.<br>
				Wir haben weltweite Vertretungen in Lateinamerika, den USA und Deutschland.'
				); ?></p>
		</div>
	</div>
</main>

<?php include('footer.php');  ?>