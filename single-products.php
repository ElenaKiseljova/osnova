<?php 
  /**
   * Template Name: Товар
   * Template Post Type: products
   */
?>

<?php
  get_header(  );
?>

<?php 
  get_template_part( 'templates/product/start' );

  //Контент Товара

  // Check value exists.
  if( have_rows('content') ):

    // Loop through rows.
    while ( have_rows('content') ) : the_row();

        // Case: specification layout.
        if( get_row_layout() == 'specification' ):
            get_template_part( 'templates/product/specification' );

        // Case: destination layout.
        elseif( get_row_layout() == 'destination' ):
          get_template_part( 'templates/product/destination' );

        // Case: properties layout.
        elseif( get_row_layout() == 'properties' ):
          get_template_part( 'templates/product/properties' );

        // Case: dosing layout.
        elseif( get_row_layout() == 'dosing' ):
          get_template_part( 'templates/product/dosing' );

        // Case: document layout.
        elseif( get_row_layout() == 'document' ):
          get_template_part( 'templates/product/document' );

        // Case: simular layout.
        elseif( get_row_layout() == 'simular' ):
          get_template_part( 'templates/product/simular' );
                  
        endif;

    // End loop.
    endwhile;

  // No value.
  else :
    // Do something...
  endif;
?>

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

<?php
  get_footer(  );
?>
