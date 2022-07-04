<?php 
  /**
   * Template Name: Каталог
   * Template Post Type: page
   */
?>

<?php
  get_header(  );
?>

<main class="main">
  <?php if ( (is_home(  ) && !is_front_page(  )) || is_category(  ) ) : ?>
    <?php 
      get_template_part( 'templates/posts' );  
    ?>
  <?php elseif( is_post_type_archive( 'products' ) || is_tax( 'products-category' ) || is_tax( 'products-tag' ) ) : ?>
    <?php 
      get_template_part( 'templates/products' );  
    ?>
  <?php else : ?>
    <?php 
      get_template_part( 'templates/post' );  
    ?>
  <?php endif; ?>  
</main>

<?php
  get_footer(  );
?>
