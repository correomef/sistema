<?php global $opcionesArray, $opciones; ?>
<?php if ($opcionesArray['contacto']['sociales']): ?>

	<?php foreach ($opcionesArray['contacto']['sociales'] as $key => $value): ?>

		<?php if ($value['link']): ?>

			<a class="iconos-sociales" target="_blank" href="<?php echo $value['link'] ?>"> <img src="<?php echo $value['icono']['img'] ?>" alt="<?php  echo $value['nombreRed'].' | '.$value['nombreCuenta'] ?>" title="<?php  echo $value['nombreRed'].' | '.$value['nombreCuenta'] ?>"></a>

		<?php endif; ?>

	<?php endforeach; ?>

<?php endif; ?>