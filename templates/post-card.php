<li class="last__item">
  <a href="<?= get_permalink(  ); ?>" class="last__link">
    <?php if ( has_post_thumbnail(  ) ) : ?>
      <?php 
        $thumbnail_desktop = get_the_post_thumbnail_url( null, 'osnova_blog' ) ?? NOT_FOUND;
        $thumbnail_mobile = get_the_post_thumbnail_url( null, 'medium' ) ?? NOT_FOUND;
      ?>
      <picture class="picture">
        <source media="(min-width:768px)" srcset="<?= $thumbnail_desktop; ?>">

        <img class="last__img" src="<?= $thumbnail_mobile; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
      </picture>
    <?php else : ?>
      <picture class="picture">
        <img class="last__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
      </picture>
    <?php endif; ?> 

    <span class="last__date"><?= get_the_date( 'd F Y' ); ?></span>

    <p class="last__text">
      <?= get_the_title(  ); ?>
    </p>
  </a>
</li>