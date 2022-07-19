<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="products section" id="products">
  <div class="container">
    <h2 class="products__title title"><?= $title; ?></h2>
  </div>

  <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
    <ul class="products__list">
      <?php foreach ($list as $key => $item) : ?>
        <?php 
          $index = $key + 1;

          $name = $item->name ?? '';
          $taxonomy = $item->taxonomy ?? '';

          $image = get_field( 'image', $item ) ?? '';
          $description_short = get_field( 'description_short', $item ) ?? '';
        ?>
        <li class="products__item">
          <div class="products__accordion">
            <span class="products__number"><?= ($index < 10) ? '0' . $index : $index; ?></span>
            <h3 class="products__heading"><?= $name; ?></h3>
            <button class="products__btn">
              <svg class="products__icon " fill="none">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#accordion-btn"></use>
              </svg>
            </button>
          </div>
          <div class="products__content">
            <img class="products__img" src="<?= !empty($image) ? $image : NOT_FOUND; ?>" alt="<?= strip_tags($name); ?>">
            <div class="products-content__wrapper">

              <?= $description_short; ?>

            </div>

            <a class="products-content__btn" href="<?= get_term_link( $item, $taxonomy ); ?>"><?= __( 'подробнее', 'osnova' ); ?></a>
          </div>
        </li>
      <?php endforeach; ?>      
    </ul>
  <?php endif; ?>  
</section>