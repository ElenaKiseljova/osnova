<?php 
  $images = get_sub_field( 'images' ) ?? [];
?>

<?php if ( !empty($images) && is_array($images) && !is_wp_error( $images ) ) : ?>
  <div class="swiper article__swiper">
    <div class="swiper-wrapper">
      <?php foreach ($images as $key => $image) : ?>
        <?php 
          $image_desktop = $image['sizes']['large'] ?? '';  
          $image_tablet = $image['sizes']['osnova_article_gallery_tablet'] ?? '';  
          $image_mobile = $image['sizes']['medium'] ?? '';  
        ?>
        <div class="swiper-slide article__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="<?= $image_desktop; ?>">
            <source media="(min-width:768px)" srcset="<?= $image_tablet; ?>">
            <img class="article__slide-img" src="<?= $image_mobile; ?>" alt="<?= strip_tags( get_the_title(  ) ); ?>">
          </picture>
        </div>
      <?php endforeach; ?>    
    </div>
  </div>

  <div class="slider__wrapper slider__wrapper--article">

    <div class="slider__wrap">
      <button class="slider__prev slider__prev--article">
        <svg class="slider__icon">
          <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-prev"></use>
        </svg>

      </button>
      <button class="slider__next slider__next--article">
        <svg class="slider__icon">
          <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-next"></use>
        </svg>
      </button>
    </div>
    <div class="slider__pagination slider__pagination--article"></div>

  </div>
<?php endif; ?>