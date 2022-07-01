<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="section recommendation">
  <div class="container">
    <div class="recommendation__wrapper">
      <h2 class="recommendation__title title"><?= $title; ?></h2>

      <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
        <div class="furniture__cover">
          <div class="swiper recommendation__swiper">
            <div class="swiper-wrapper">
              <?php foreach ($list as $key => $item) : ?>
                <?php 
                  $image = $item['image'] ? ($item['image']['sizes']['large'] ?? $item['image']['url'] ?? '') : '';
                  $alt = $item['image'] ? $item['image']['alt'] : 'recommendation';
                ?>
                <div class="swiper-slide recommendation__slide js-slide cursor-slide">
                  <img class="recommendation__img" src="<?= $image; ?>" alt="<?= $alt; ?>">
                </div>
              <?php endforeach; ?>          
            </div>
          </div>
        </div>        

        <div class="slider__wrapper slider__wrapper--mod">
          <div class="slider__navigation">
            <button class="slider__prev slider__prev--recommendation">
              <svg class="slider__icon">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-prev"></use>
              </svg>

            </button>
            <button class="slider__next slider__next--recommendation">
              <svg class="slider__icon">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#slider-next"></use>
              </svg>
            </button>
          </div>

          <div class="slider__pagination slider__pagination--recommendation"></div>

        </div>
      <?php endif; ?>      
    </div>
  </div>

</section>