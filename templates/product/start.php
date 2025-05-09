<section class="product">
  <div class="container">
    <?php 
      if ( function_exists( 'osnova_yoast_breadcrumbs' ) ) {
        osnova_yoast_breadcrumbs(  );
      }
    ?>
    
    <div class="product__wrapper">
      <div class="product__img"> 
        <?php if ( has_post_thumbnail(  ) ) : ?>
          <?php 
            $thumbnail_desk = get_the_post_thumbnail_url( null, 'full' ) ?? NOT_FOUND;
            $thumbnail_mobile = get_the_post_thumbnail_url( null, 'medium' ) ?? NOT_FOUND;
          ?>
          <picture class="picture">
            <source media="(min-width:768px)" srcset="<?= $thumbnail_desk; ?>">

            <img src="<?= $thumbnail_mobile; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
          </picture>
        <?php else : ?>
          <picture class="picture">
            <img src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
          </picture>
        <?php endif; ?> 
      </div>
      <div class="product__about">
        <div class="product__wrap"> </div>

        <h1 class="product__title"><?php the_title(  ); ?></h1>
        
        <?php 
          the_content(  );
        ?>

        <button class="product__btn product__btn--mod"><?= __( 'ЗАКАЗАТЬ', 'osnova' ); ?></button>
      </div>

      <?php 
        get_template_part( 'templates/product/tags' );
      ?>

      <button class="product__btn"><?= __( 'ЗАКАЗАТЬ', 'osnova' ); ?></button>
    </div>
  </div>
</section>