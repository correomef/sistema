<?php
/*
Template Name: destacados
*/ ?>

<div id="productosDestacados">

    <?php
    $args = array(
      'post_type' => 'product',
      'meta_key' => '_featured',
      'posts_per_page' => 15,
      'columns' => '3',
      'meta_value' => 'yes'
      );

      $loop = new WP_Query( $args ); ?>

      <ul class="products">

        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

            <?php wc_get_template_part( 'content', 'product' ); ?>

        <?php endwhile; ?>
    </ul>
</div>
<?php wp_reset_query(); ?>