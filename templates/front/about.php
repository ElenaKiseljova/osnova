<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $subtitle = get_sub_field( 'subtitle' ) ?? '';

  $text = get_sub_field( 'text' ) ?? [];

  $image = get_sub_field( 'image' ) ?? [];  
?>
<section class="about section" id="about">
  <div class="container about__container">
    <h2 class="about__title title"><?= $title; ?></h2>

    <div class="about__wrapper">
      <h3 class="about__info">
        <?= $subtitle; ?>
      </h3>

      <div class="about__wrap">
        <p><?= $text['left'] ?? ''; ?></p>
        <p><?= $text['right'] ?? ''; ?></p>
      </div>
    </div>
  </div>

  <?php if (!empty($image) && is_array($image) && !is_wp_error( $image )) : ?>
    <?php 
      $image_desktop = $image['url'] ?? '';  
      $image_tablet =$image['sizes']['osnova_front_about_tablet'] ?? '';  
      $image_mobile = $image['sizes']['osnova_front_about_mobile'] ?? '';  
    ?>
    <picture class="picture">
      <source media="(min-width:1200px)" srcset="<?= $image_desktop; ?>">
      <source media="(min-width:768px)" srcset="<?= $image_tablet; ?>">
      <img class="about__img" src="<?= $image_mobile; ?>" alt="<?= get_bloginfo( 'name' ); ?>">
    </picture>
  <?php endif; ?>  
</section>