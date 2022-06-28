<?php 
  $title = get_field( 'title' ) ?? [];
  $description = get_field( 'description' ) ?? '';
  $button = get_field( 'button' ) ?? [];

  $list = get_field( 'list' ) ?? '';

  $image = get_field( 'image' ) ?? [];
?>

<section class="start">
  <div class="container">
    <?php if (!empty($image) && is_array($image) && !is_wp_error( $image )) : ?>
      <div class="start__bg">
        <picture class="picture">
          <source media="(min-width:1200px)" srcset="<?= $image['url'] ?? ''; ?>">
          <img class="start__img" src="<?= $image['sizes']['osnova_front_start_tablet'] ?? ''; ?>" alt="<?= get_bloginfo( 'name' ); ?>">
        </picture>
      </div>
    <?php endif; ?>    

    <div class="start__wrapper">
      <div class="start__wrap">
        <p class="start__subtitle"><?= $title['top'] ?? ''; ?></p>
        <h1 class="start__title"><?= $title['bottom'] ?? ''; ?></h1>
      </div>

      <p class="start__descr">
        <?= $description; ?>
      </p>


      <div class="start__content">
        <?= $list; ?>
      </div>

      <?php if ($button['text'] && !empty($button['text'])) : ?>
        <a class="start__btn btn" href="<?= $button['link'] ?? ''; ?>"><?= $button['text']; ?></a>
      <?php endif; ?>      
    </div>
  </div>
</section>