<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $text = get_sub_field( 'text' ) ?? [];
  $images = get_sub_field( 'images' ) ?? [];
?>

<section class="destination">
  <div class="container about__container about__container--destination">
    <h2 class="about__title title about__title--destination"><?= $title; ?></h2>

    <div class="about__wrapper">
      <div class="about__wrap">
        <p><?= $text['left'] ?? ''; ?></p>
        <p><?= $text['right'] ?? ''; ?></p>
      </div>
    </div>

    <?php if ($images['left'] && !empty($images['left']) && !is_wp_error( $images['left'] )) : ?>
      <picture class="picture about__picture about__picture--left">
        <source media="(min-width:768px)" srcset="<?= $images['left']['url'] ?? ''; ?>">
        <img class="about__img about__img--left" src="<?= $images['left']['sizes']['medium'] ?? ''; ?>" alt="<?= strip_tags( $title ); ?>">
      </picture>
    <?php endif; ?>

    <?php if ($images['right'] && !empty($images['right']) && !is_wp_error( $images['right'] )) : ?>
      <picture class="picture about__picture about__picture--right">
        <source media="(min-width:768px)" srcset="<?= $images['right']['url'] ?? ''; ?>">
        <img class="about__img about__img--right" src="<?= $images['right']['sizes']['medium'] ?? ''; ?>" alt="<?= strip_tags( $title ); ?>">
      </picture>
    <?php endif; ?>
  </div>
</section>
