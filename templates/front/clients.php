<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="clients section">
  <div class="container">
    <div class="clients__wrapper">
      <h2 class="clients__title title"><?= $title; ?></h2>

      <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
        <ul class="clients__list">
          <?php foreach ($list as $key => $item) : ?>
            <?php 
              $image = $item['image'] ? $item['image']['url'] : '';
              $alt = $item['image'] ? $item['image']['alt'] : 'client';
            ?>
            <li class="clients__item">
              <picture class="picture">
                <img class="clients__img" src="<?= $image; ?>" alt="<?= $alt; ?>">
              </picture>
            </li>
          <?php endforeach; ?>          
        </ul>
      <?php endif; ?>      
    </div>
  </div>
</section>