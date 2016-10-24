<?php

/*
Template Name: opciones
*/

$opciones = obtenerOpcionesDelTema(); ?>
<?php include('header.php');


if ( !empty($_POST) ) {

	echo "<h1>opciones grabadas</h1>";

	foreach($_POST as  $key => $value){

			if ($value != 'eliminarCampo' ) {
				$opciones[$key] = $_POST[$key];

			} else{
				unset($opciones[$key]);

			}
		}

		foreach($opciones as  $key => $value){

			if ($value === '' )
				unset($opciones[$key]);

		}

		update_option('opcionesDelTema', stripslashes_deep($opciones));
		$_POST = array();
}

?>


<article>
<?php global $q_config;


?>

	<form method="post" action="<?php echo get_bloginfo('url')?>/opciones">


		<?php


		foreach ($opciones as $key => $value) {
			//echo "'".$key."' => '".$value."',<br>"; ?>
			<p><?php echo $key ?></p>
			<p> <textarea class="traducir" style="width: 50%; height: 80px;" type="text" name="<?php echo $key ?>" > <?php echo $value ?></textarea> </p>
			<br>
			<?php
		}

		?>

		<button style="position: fixed;padding: 25px; right: 20%; top: 35%" type="submit">Grabar</button>
	</form>
</article>
</body>
<?php include('footer.php');  ?>