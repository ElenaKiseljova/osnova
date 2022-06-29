<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];

  $button = get_sub_field( 'button' ) ?? [];
?>

<section class="section simular">
  <div class="container">
    <div class="simular__header">
      <h2 class="simular__title title"><?= $title; ?></h2>

      <?php if (!empty($button) && $button['text'] && !empty($button['text'])) : ?>
        <a class="simular__btn simular__btn--desck" href="<?= $button['link']; ?>"><?= $button['text']; ?></a>
      <?php endif; ?>      
    </div>
    <div class="swiper simular__swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide simular__slide">
          <picture class="picture simular__picture">
            <source media="(min-width:768px)" srcset="img/simular-tablet-1.png">
            <img src="img/simular-1.png" alt="simular">
          </picture>
          <p class="simular__text">Liquid Chlor L100</p>
        </div>
        <div class="swiper-slide simular__slide">
          <picture class="picture simular__picture">
            <source media="(min-width:768px)" srcset="img/simular-tablet-1.png">
            <img src="img/simular-1.png" alt="simular">
          </picture>
          <p class="simular__text">Liquid Chlor L100</p>
        </div>


        <div class="swiper-slide simular__slide">
          <picture class="picture simular__picture">
            <source media="(min-width:768px)" srcset="img/simular-tablet-1.png">
            <img src="img/simular-1.png" alt="simular">
          </picture>
          <p class="simular__text">Liquid Chlor L100</p>
        </div>
        <div class="swiper-slide simular__slide">
          <picture class="picture simular__picture">
            <source media="(min-width:768px)" srcset="img/simular-tablet-1.png">
            <img src="img/simular-1.png" alt="simular">
          </picture>
          <p class="simular__text">Liquid Chlor L100</p>
        </div>
      </div>
    </div>


    <div class="slider__wrapper slider__wrapper--mod">
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

      <div class="slider__pagination slider__pagination--simular"></div>

    </div>
  </div>

  <button class="simular__btn">Смотреть все</button>

  </div>

</section>