<?php
  get_header(  );
?>

<?php 
  get_template_part( 'templates/front/start' );

  // Check value exists.
  if( have_rows('content') ):

    // Loop through rows.
    while ( have_rows('content') ) : the_row();

        // Case: about layout.
        if( get_row_layout() == 'about' ):
            get_template_part( 'templates/front/about' );

        // Case: products layout.
        elseif( get_row_layout() == 'products' ):
          get_template_part( 'templates/front/products' );

        // Case: furniture layout.
        elseif( get_row_layout() == 'furniture' ):
          get_template_part( 'templates/front/furniture' );

        // Case: clients layout.
        elseif( get_row_layout() == 'clients' ):
          get_template_part( 'templates/clients' );

        // Case: recommendation layout.
        elseif( get_row_layout() == 'recommendation' ):
          get_template_part( 'templates/recommendation' );

        // Case: news layout.
        elseif( get_row_layout() == 'news' ):
          get_template_part( 'templates/front/news' );
                  
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
