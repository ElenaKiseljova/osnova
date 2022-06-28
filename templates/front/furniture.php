<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="furniture section">
  <div class="container furniture__container">
    <h2 class="furniture__title title">
      <?= $title; ?>
    </h2>

    <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
      <div class="swiper furniture__swiper">
        <div class="swiper-wrapper">
          <?php foreach ($list as $key => $item) : ?>
            <?php 
              $index = $key + 1;

              $name = $item->name ?? '';
              $taxonomy = $item->taxonomy ?? '';

              $image = get_field( 'image', $item ) ?? '';
            ?>

            <div class="swiper-slide furniture__slide">
              <a href="<?= get_term_link( $item, $taxonomy ); ?>" class="furniture__link">
                <picture class="picture">
                  <img src="<?= !empty($image) ? $image : NOT_FOUND; ?>" class="furniture__img" alt="<?= strip_tags($name); ?>">
                </picture>
                <div class="furniture__wrapper">
                  <span class="furniture__number"><?= ($index < 10) ? '0' . $index : $index; ?></span>
                  <div class="furniture__wrap">
                    <h3 class="furniture__text">
                      <?= $name; ?>
                    </h3>
                    <svg class="furniture__arrow">
                      <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#furniture-arrow"></use>
                    </svg>
                  </div>
                </div>
              </a>
            </div> 
          <?php endforeach; ?>                  
        </div>
      </div>

      <div class="slider__navigation">
        <div class="slider__wrapper">
          <button class="slider__prev">
            <svg class="slider__icon">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-prev"></use>
            </svg>

          </button>
          <button class="slider__next">
            <svg class="slider__icon">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-next"></use>
            </svg>
          </button>

        </div>
        <div class="slider__pagination slider__pagination--furniture"></div>
      </div>
    <?php endif; ?>     
  </div>


</section>