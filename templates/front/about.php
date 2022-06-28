<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $text = get_sub_field( 'text' ) ?? [];

  $image = get_sub_field( 'image' ) ?? [];  
?>
<section class="about section">
  <div class="container about__container">
    <h2 class="about__title title"><?= $title; ?></h2>

    <div class="about__wrapper">
      <h3 class="about__info">
        <?= $text['top'] ?? ''; ?>
      </h3>

      <div class="about__wrap">
        <p><?= $text['left'] ?? ''; ?></p>
        <p><?= $text['right'] ?? ''; ?></p>
      </div>
    </div>
  </div>

  <?php if (!empty($image) && is_array($image) && !is_wp_error( $image )) : ?>
    <picture class="picture">
      <source media="(min-width:1200px)" srcset="<?= $image['url'] ?? ''; ?>">
      <source media="(min-width:768px)" srcset="<?= $image['sizes']['osnova_front_about_tablet'] ?? ''; ?>">
      <img class="about__img" src="<?= $image['sizes']['osnova_front_about_mobile'] ?? ''; ?>" alt="<?= get_bloginfo( 'name' ); ?>">
    </picture>
  <?php endif; ?>  
</section>