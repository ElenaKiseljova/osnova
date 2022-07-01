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

  $term = get_queried_object();

  if ( $term && is_a($term, 'WP_term') ) {
    $title = $term->name ?? '';
    $description = term_description() ?? '';
  } else if ( $catalog_page_id ) {
    $catalog_page_id_translate = pll_get_post( $catalog_page_id ) ?? null;
    $catalog_page_id = $catalog_page_id_translate ? (int) $catalog_page_id_translate : $catalog_page_id;

    $title = get_the_title( $catalog_page_id ) ?? '';
    $description = get_the_content( null, false, $catalog_page_id ) ?? '';
  }
?>

<main class="main">
  <section class="section heading">
    <div class="container">
      <div class="heading__top">
        <h1 class="heading__title"><?= $title; ?></h1>
      </div>

      <button class="heading__btn">
        <svg class="heading__icon" width="14" height="9">
          <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#filter"></use>
        </svg>
        <?= __( 'Подкатегории', 'osnova' ); ?>
      </button>
    </div>
  </section>

  <section class="section category">
    <div class="container">
      <div class="category__wrapper">        
        <div class="filter__wrapper filter__wrapper--mod">
          <?php 
            get_template_part( 'templates/catalog/category' );
          ?>  

          <button class="filter__btn"><?= __( 'Закрыть', 'osnova' ); ?></button>
        </div>

        <div class="category__content">
          <?php 
            get_template_part( 'templates/catalog/products' );
          ?>  

          <?php if (!empty($description)) : ?>
            <div class="category__about">
              <div class="category__text">
                <?= $description; ?>
              </div>            

              <button class="category__read-more close" data-state-close="<?= __( 'Подробнее', 'osnova' ); ?>" data-state-open="<?= __( 'Меньше подробностей', 'osnova' ); ?>">
                <?= __( 'Подробнее', 'osnova' ); ?>
              </button>
            </div>
          <?php endif; ?>         

          <?php 
            get_template_part( 'templates/catalog/tags' );
          ?> 

        </div>
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
          get_template_part( 'templates/clients' );

        // Case: recommendation layout.
        elseif( get_row_layout() == 'recommendation' ):
          get_template_part( 'templates/recommendation' );
                  
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