<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $button = get_sub_field( 'button' ) ?? [];

  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="section news">
  <div class="container">
    <div class="news__wrapper">
      <h2 class="news__title title"><?= $title; ?></h2>

      <?php if ($button['text'] && !empty($button['text'])) : ?>
        <a class="news__btn news__btn--mod" href="<?= $button['link'] ?? ''; ?>"><?= $button['text']; ?></a>
      <?php endif; ?>        
    </div>
    
    <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
      <ul class="news__list">
        <?php foreach ($list as $key => $item) : ?>
          <li class="news__item">
            <a href="<?= get_permalink( $item ); ?>" class="news__link">
              <?php if ( has_post_thumbnail( $item ) ) : ?>
                <?php 
                  $thumbnail_desk = get_the_post_thumbnail_url( $item, 'full' ) ?? NOT_FOUND;
                  $thumbnail_tablet = get_the_post_thumbnail_url( $item, 'large' ) ?? NOT_FOUND;
                  $thumbnail_mobile = get_the_post_thumbnail_url( $item, 'medium' ) ?? NOT_FOUND;
                ?>
                <picture class="picture">
                  <source media="(min-width:1200px)" srcset="<?= $thumbnail_desk; ?>">
                  <source media="(min-width:768px)" srcset="<?= $thumbnail_tablet; ?>">

                  <img class="news__img" src="<?= $thumbnail_mobile; ?>" alt="<?= strip_tags( get_the_title( $item ) ?? '' ); ?>">
                </picture>
              <?php else : ?>
                <picture class="picture">
                  <img class="news__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title( $item ) ?? '' ); ?>">
                </picture>
              <?php endif; ?>              

              <span class="news__date">
                <?= get_the_date( 'd M Y', $item ); ?>
              </span>
              <h3 class="news__heading"><?= get_the_title( $item ); ?></h3>
            </a>
          </li>
        <?php endforeach; ?>        
      </ul>
    <?php endif; ?>    
    
    <?php if ($button['text'] && !empty($button['text'])) : ?>
      <a class="news__btn" href="<?= $button['link'] ?? ''; ?>"><?= $button['text']; ?></a>
    <?php endif; ?>  
  </div>
</section>