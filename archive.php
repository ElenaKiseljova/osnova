<?php 
  /**
   * Template Name: Каталог
   * Template Post Type: page
   */
?>

<?php
  get_header(  );
?>

<?php 
  // ИД Каталога
  $catalog_page_id = get_field( 'catalog_page_id', 'options' ) ?? null;

  $title = '';
  $description = '';
  $tags = [];

  $term = get_queried_object();

  if ( $term && is_a($term, 'WP_term') ) {
    $title = $term->name ?? '';
    $description = term_description() ?? '';
    $tags = get_field( 'tags', $term ) ?? [];
  } else if ( $catalog_page_id ) {
    $catalog_page_id_translate = pll_get_post( $catalog_page_id ) ?? null;
    $catalog_page_id = $catalog_page_id_translate ? (int) $catalog_page_id_translate : $catalog_page_id;

    $title = get_the_title( $catalog_page_id ) ?? '';
    $description = get_the_content( null, false, $catalog_page_id ) ?? '';
    $tags = get_field( 'tags', $catalog_page_id ) ?? [];
  }
?>

<main class="main">
  <section class="section">
    <div class="container">  
      <h1><?= $title; ?></h1>

      <?php 
        get_template_part( 'templates/catalog', 'category' );

        get_template_part( 'templates/catalog', 'products' );
      ?>  
      
      <div>
        <?= $description; ?>
      </div>

      <div>
        <?php if ( !empty($tags) && is_array($tags) && !is_wp_error( $tags ) ) : ?>
          <?php foreach ($tags as $key => $tag) : ?>
            <?php 
              $link = get_term_link( $tag ) ?? '';
              $name = $tag->name ?? '';  
            ?>
            <a href="<?= $link; ?>"><?= $name; ?></a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php 
  //Повторяющиеся поля с Главной
  $frontpage_id = get_option( 'page_on_front' );
  
  // Check value exists.
  if( have_rows('content', $frontpage_id) ):

    // Loop through rows.
    while ( have_rows('content', $frontpage_id) ) : the_row();

      // Case: clients layout.
      if( get_row_layout() == 'clients' ):
        get_template_part( 'templates/front/clients' );

      // Case: recommendation layout.
      elseif( get_row_layout() == 'recommendation' ):
        get_template_part( 'templates/front/recommendation' );
                
      endif;

    // End loop.
    endwhile;

  // No value.
  else :
    // Do something...
  endif;
?>
</main>

<?php
  get_footer(  );
?>