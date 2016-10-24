<li class="<?php if (is_woocommerce()) echo 'current-cat' ?>">

	<a class="ToggleMenu DesapareceEnColapsaMenu" data-target="#cat-coleccion" href="#" ><?php idioma('Collection','Coleccion','Coleção'); ?></a>

	<a class="slideToggle ApareceEnMovil" data-target="#productosMovil" href="#" ><?php idioma('Collection','Coleccion','Coleção'); ?></a>

		<ul id="productosMovil" class="toggleTarget">

			<?php

			$args = array(
				'child_of'            => get_term_by('slug', 'coleccion', 'product_cat' )->term_id,
				'title_li'           => '',
				'number'     => $number,
				'orderby'    => 'title',
				'order'      => 'DESC',
				'hide_empty' => 0,
				'taxonomy'           => 'product_cat',
				'include'    => $ids,
				'exclude'	 => array(get_term_by( 'slug', 'novedades', 'product_cat' )->term_id, get_term_by( 'slug', 'destacado-en-menu', 'product_cat' )->term_id,),
				);



			wp_list_categories( $args );


			?>
		</ul>

</li>

<li class="<?php if (is_page('team')) echo 'current-cat' ?>">

	<a class="ToggleMenu DesapareceEnColapsaMenu" data-target="#cat-team" href="<?php echo esc_url( home_url( '/' ) ); ?>seccion/team" ><?php idioma('Team','Team','Team'); ?></a>

	<a class="slideToggle ApareceEnMovil" data-target="#menuTeamMovil" href="<?php echo esc_url( home_url( '/' ) ); ?>seccion/team" ><?php idioma('Team','Team','Team'); ?></a>

	<ul id="menuTeamMovil" class="toggleTarget">

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




		   wp_list_categories( $args );
		?>
	</ul>

</li>

<li class="<?php if (is_page('media')) echo 'current-cat' ?>">
	<a class="ToggleMenu" data-target="" href="<?php echo esc_url( home_url( '/' ) ); ?>seccion/media"><?php idioma('Media','Media','Loja'); ?></a>
</li>

<li class="<?php if (is_page('nuestros-locales')) echo 'current-cat' ?>">
	<a class="ToggleMenu" data-target="" href="<?php echo esc_url( home_url( '/' ) ); ?>nuestros-locales"><?php idioma("Shops",'Locales','Lojas'); ?>
	</a>
</li>

<li class="<?php if (is_page('contacto')) echo 'current-cat' ?>">

	<a class="ToggleMenu" data-target="" href="<?php echo esc_url( home_url( '/' ) ); ?>Contacto"><?php idioma('Contact','Contacto','Contato'); ?>
	</a>

</li>


<li class="<?php if (is_page('catalogo')) echo 'current-cat' ?>">

	<a class="ToggleMenu" data-target="" href="<?php echo esc_url( home_url( '/' ) ); ?>catalogos"><?php idioma('Catalog','Catalogo','Catalogo'); ?>
	</a>

</li>