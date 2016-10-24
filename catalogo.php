<?php



include('header.php');


 include ('woocommerce/cabeceras.php') ?>


<div id="paginaCatalogo">

	<div id="catalogoSlider">

		<ul>
<?php if ($opcionesArray['catalogo']['slider']): ?>
	
			<?php
				$cont = 1;
				foreach ($opcionesArray['catalogo']['slider'] as $key => $value) {?>

				<li><img src="<?php echo $src = ($cont <= 2) ? $value['img'] : '' ; ?>" alt="" data-src="<?php echo $value['img'] ?>" ></li>

			<?php $cont++; } ?>
		</ul>
<?php endif ?>

	</div>
	
</div>

<?php include('footer.php');  ?>

