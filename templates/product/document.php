<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="section document">
  <div class="container document__container">
    <h2 class="document__title title">
      <?= $title; ?>
    </h2>

    <div class="swiper document__swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide document__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="img/document-desck-1.jpg">
            <source media="(min-width:768px)" srcset="img/document-tablet-1.jpg">

            <img class="document__img" src="img/document-1.jpg" alt="document">
          </picture>
        </div>
        <div class="swiper-slide document__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="img/document-desck-2.jpg">
            <source media="(min-width:768px)" srcset="img/document-tablet-2.jpg">

            <img class="document__img" src="img/document-2.jpg" alt="document">
          </picture>
        </div>


        <div class="swiper-slide document__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="img/document-desck-1.jpg">
            <source media="(min-width:768px)" srcset="img/document-tablet-1.jpg">

            <img class="document__img" src="img/document-1.jpg" alt="document">
          </picture>
        </div>
        <div class="swiper-slide document__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="img/document-desck-2.jpg">
            <source media="(min-width:768px)" srcset="img/document-tablet-2.jpg">

            <img class="document__img" src="img/document-2.jpg" alt="document">
          </picture>
        </div>


        <div class="swiper-slide document__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="img/document-desck-1.jpg">
            <source media="(min-width:768px)" srcset="img/document-tablet-1.jpg">

            <img class="document__img" src="img/document-1.jpg" alt="document">
          </picture>
        </div>
        <div class="swiper-slide document__slide">
          <picture class="picture">
            <source media="(min-width:1200px)" srcset="img/document-desck-2.jpg">
            <source media="(min-width:768px)" srcset="img/document-tablet-2.jpg">

            <img class="document__img" src="img/document-2.jpg" alt="document">
          </picture>
        </div>

      </div>
      <div class="slider__wrapper slider__wrapper--mod slider__wrapper--document">

        <div class="slider__pagination slider__pagination--document"></div>

      </div>
    </div>

  </div>
</section>