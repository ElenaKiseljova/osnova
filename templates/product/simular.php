<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];

  $button = get_sub_field( 'button' ) ?? [];
?>

<?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
  <section class="section simular">
    <div class="container">
      <div class="simular__header">
        <h2 class="simular__title title"><?= $title; ?></h2>

        <?php if (!empty($button) && $button['text'] && !empty($button['text'])) : ?>
          <a class="simular__btn simular__btn--desck" href="<?= $button['link']; ?>"><?= $button['text']; ?></a>
        <?php endif; ?>      
      </div>

      <div class="simular__cover">
        <div class="swiper simular__swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <?php foreach ($list as $key => $item) : ?>
              <div class="swiper-slide simular__slide">
                <a href="<?= get_permalink( $item ); ?>" class="simular__link">
                  <?php if ( has_post_thumbnail( $item ) ) : ?>
                    <?php 
                      $thumbnail_desk = get_the_post_thumbnail_url( $item, 'large' ) ?? NOT_FOUND;
                      $thumbnail_mobile = get_the_post_thumbnail_url( $item, 'medium' ) ?? NOT_FOUND;
                    ?>
                    <picture class="picture simular__picture">
                      <source media="(min-width:768px)" srcset="<?= $thumbnail_desk; ?>">

                      <img src="<?= $thumbnail_mobile; ?>" alt="<?= strip_tags( get_the_title( $item ) ?? '' ); ?>">
                    </picture>
                  <?php else : ?>
                    <picture class="picture simular__picture">
                      <img src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title( $item ) ?? '' ); ?>">
                    </picture>
                  <?php endif; ?>  

                  <p class="simular__text"><?= get_the_title( $item ); ?></p>
                </a>
              </div>
            <?php endforeach; ?>          
          </div>
        </div>
      </div>      

      <div class="slider__wrapper slider__wrapper--mod">
        <div class="slider__navigation">
          <button class="slider__prev slider__prev--simular">
            <svg class="slider__icon">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-prev"></use>
            </svg>

          </button>
          <button class="slider__next slider__next--simular">
            <svg class="slider__icon">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-next"></use>
            </svg>
          </button>
        </div>

        <div class="slider__pagination slider__pagination--simular"></div>

      </div>
      
    </div>

    <?php if (!empty($button) && $button['text'] && !empty($button['text'])) : ?>
      <a class="simular__btn" href="<?= $button['link']; ?>"><?= $button['text']; ?></a>
    <?php endif; ?>  

  </section>
<?php endif; ?>
