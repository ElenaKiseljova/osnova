<li class="news__item">
  <a href="<?= get_permalink( null ); ?>" class="news__link">
    <?php if ( has_post_thumbnail( null ) ) : ?>
      <?php 
        $thumbnail_desktop = get_the_post_thumbnail_url( null, 'large' ) ?? NOT_FOUND;
        $thumbnail_mobile = get_the_post_thumbnail_url( null, 'medium' ) ?? NOT_FOUND;
      ?>
      <picture class="picture">
        <source media="(min-width:768px)" srcset="<?= $thumbnail_desktop; ?>">

        <img class="news__img" src="<?= $thumbnail_mobile; ?>" alt="<?= strip_tags( get_the_title( null ) ?? '' ); ?>">
      </picture>
    <?php else : ?>
      <picture class="picture">
        <img class="news__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title( null ) ?? '' ); ?>">
      </picture>
    <?php endif; ?>              

    <span class="news__date">
      <?= get_the_date( 'd F Y', null ); ?>
    </span>
    <h3 class="news__heading"><?= get_the_title( null ); ?></h3>
  </a>
</li>