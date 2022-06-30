<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $subtitle = get_sub_field( 'subtitle' ) ?? '';

  $text = get_sub_field( 'text' ) ?? [];
  $banner = get_sub_field( 'banner' ) ?? [];
?>

<section class="properties section">
  <div class="container about__container">
    <h2 class="about__title title"><?= $title; ?></h2>

    <div class="about__wrapper">
      <p class="about__info"><?= $subtitle; ?></p>

      <div class="about__wrap">
        <p><?= $text['left'] ?? ''; ?></p>
        <p><?= $text['right'] ?? ''; ?></p>
      </div>
    </div>
  </div>

  <?php if (!empty($banner) && is_array($banner) && !is_wp_error( $banner )) : ?>
    <picture class="picture">
      <source media="(min-width:768px)" srcset="<?= $banner['url'] ?? ''; ?>">
      <img class="properties__img" src="<?= $banner['sizes']['medium'] ?? ''; ?>" alt="<?= strip_tags( $title ); ?>">
    </picture>
  <?php endif; ?>  
</section>