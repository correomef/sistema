<?php

global $post;
$thumbID = get_post_thumbnail_id( $post->ID );
$imgDestacada = wp_get_attachment_url( $thumbID );

 ?>

<span class="compartir">
	<div><?php idioma('Shared:','Compartir:','Compartilhar'); ?></div>
	<a target="_blank"class="zocial-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink()?>" ><img src="<?php echo get_bloginfo('template_url') ?>/img/icon-social-facebook.jpg " ></a>
	<!--  -->

	<a target="_blank"class="zocial-twitter" target="_blank" href="https://twitter.com/intent/tweet?

	url=<?php echo get_permalink()?>
	&text=<?php $texto = get_bloginfo('name').' '.get_the_title(); echo $texto?>
	&hashtags=<?php echo $tipo_de_inmueble.','.$operacion ?>
	&original_referer=<?php echo get_permalink() ?>

	"><img src="<?php echo get_bloginfo('template_url') ?>/img/icon-social-twitter.jpg " ></a>

	<!-- <a target="_blank"class="zocial-linkedin" href="https://www.linkedin.com/shareArticle?mini=true

	&url=<?php echo get_permalink()?>
	&title=<?php $texto = get_bloginfo('name').' '.get_the_title(); echo $texto?>

	&source=<?php echo get_permalink()?>">Linked in</a> -->

	<a target="_blank" href="https://pinterest.com/pin/create/button/?

	url=<?php echo get_permalink() ?>
	&media=<?php echo $imgDestacada; ?>
	&description=<?php $texto = get_bloginfo('name').' '.get_the_title(); echo $texto?>

	"><img src="<?php echo get_bloginfo('template_url') ?>/img/icon-social-pinterest.jpg " ></a>

	<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink() ?>"><img src="<?php echo get_bloginfo('template_url') ?>/img/icon-social-google.jpg " ></a>

</span>
