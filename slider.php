
<?php if ( $opcionesArray[$modulo][$seccion] ): ?>


	<div class="slider" id="<?php echo 'contenedor-'.$SliderId ?>">
		<div class="<?php echo $sliderClase ?>" id="<?php echo $SliderId ?>">
			<ul>
				<?php
				$slidesInicio = $opcionesArray[$modulo][$seccion];
				foreach ($slidesInicio as $ID => $value) : ?>

				<li>
					<?php if (key_exists('link', $value)): ?>
						<a href="<?php echo $value['link'] ?>">
						<?php endif ?>

						<img data-peso="<?php echo pesoFile( $value['imagen']['img'] ) ?>" data-bp="bp3" data-imgCel="<?php if(key_exists('id', $value['imagen'])) echo wp_get_attachment_image_src( $value['imagen']['id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $value['imagen']['id'], 't1920')[0] ?>" src="">

						<?php if (key_exists('link', $value)): ?>
						</a>
					<?php endif ?>
				</li>

				<?php endforeach;?>
			</ul>
		</div>
</div>




<div class="losCaptions" id="losCaptions-<?php echo $SliderId ?>">

	<?php
	$i = 1;
	foreach ($slidesInicio as $ID => $value) {

		if (!array_key_exists('titulo', $value)){ ?>

		<div></div>

		<?php


	} else { ?>


	<div class="bx-caption <?php if ($i === 1) echo 'active-caption'?> ">

		<?php if ($titulo !== ''): ?>

			<?php if (key_exists('link', $value)): ?>
				<a href="<?php echo $value['link'] ?>">
				<?php endif; ?>

				<p class="caption-titulo"><?php echo $value['titulo'] ?></p>
				<?php if (key_exists('descripcion',$value) && $value['descripcion'] !== '' ): ?>
					<p class="caption-descripcion"><?php echo $value['descripcion']?></p>
				<?php endif; ?>

				<?php if (key_exists('link', $value)): ?>
				</a>
			<?php endif; ?>

		<?php endif ?>

	</div>

	<?php

	$i++;
};

}

?>

</div>

<?php endif; ?>