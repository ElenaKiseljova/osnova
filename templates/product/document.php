<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="section document">
  <div class="container document__container">
    <h2 class="document__title title">
      <?= $title; ?>
    </h2>

    <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
      <div class="swiper document__swiper">
        <div class="swiper-wrapper">
          <?php foreach ($list as $key => $item) : ?>
            <?php 
              $image = $item['image'] ? $item['image']['sizes']['large'] : '';  
              $file = $item['file'] ?? '';  
              $alt = $item['image'] ? ($item['image']['alt'] ?? 'document') : 'document';
            ?>
            <a class="swiper-slide swiper-zoom-container document__slide" href="<?= $file; ?>" target="_blank">
              <picture class="picture">
                <img class="document__img" src="<?= $image; ?>" alt="<?= $alt; ?>">
              </picture>
            </a>
          <?php endforeach; ?>          
        </div>
        <div class="slider__wrapper slider__wrapper--mod slider__wrapper--document">

          <div class="slider__pagination slider__pagination--document"></div>

        </div>
      </div>
    <?php endif; ?>   

  </div>
</section>