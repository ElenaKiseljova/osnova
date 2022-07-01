<li class="category__item">
  <a href="<?= get_permalink(  ); ?>" class="category__link">
    <div class="category__wrap">
      <?php if ( has_post_thumbnail(  ) ) : ?>
        <?php 
          $thumbnail = get_the_post_thumbnail_url( null, 'large' ) ?? NOT_FOUND;
        ?>
        <picture class="category__picture">
          <img class="category__img" src="<?= $thumbnail; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
        </picture>
      <?php else : ?>
        <picture class="category__picture">
          <img class="category__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
        </picture>
      <?php endif; ?> 
    </div>

    <h3 class="category__name">
      <?= get_the_title(  ); ?>
    </h3>

    <?php 
      //Контент Товара

      // Check value exists.
      if( have_rows('content', get_the_ID(  ) ) ):

        // Loop through rows.
        while ( have_rows('content', get_the_ID(  )) ) : the_row();

            // Case: specification layout.
            if( get_row_layout() == 'specification' ):
                get_template_part( 'templates/catalog/product', 'specification' );
                      
            endif;

        // End loop.
        endwhile;

      // No value.
      else :
        // Do something...
      endif;
    ?>    
  </a>
</li>