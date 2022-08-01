<?php
  get_header(  );
?>

<main class="main">
  <section class="section heading">
    <div class="container">
      <div class="heading__top">
        <?php 
          if ( function_exists( 'osnova_yoast_breadcrumbs' ) ) {
            osnova_yoast_breadcrumbs(  );
          }
        ?>

        <h1 class="heading__title"><?= get_the_title(  ); ?></h1>
        <p class="heading__date"><?= get_the_time( 'd F Y' ); ?></p>
      </div>
    </div>
  </section>

  <section class="section article">
    <div class="container">
      <?php if ( has_post_thumbnail( null ) ) : ?>
        <?php 
          $thumbnail_desktop = get_the_post_thumbnail_url( null, 'full' ) ?? NOT_FOUND;
          $thumbnail_tablet = get_the_post_thumbnail_url( null, 'osnova_article_tablet' ) ?? NOT_FOUND;
          $thumbnail_mobile = get_the_post_thumbnail_url( null, 'medium' ) ?? NOT_FOUND;
        ?>
        <picture class="picture">
          <source media="(min-width:1200px)" srcset="<?= $thumbnail_desktop; ?>">
          <source media="(min-width:768px)" srcset="<?= $thumbnail_tablet; ?>">

          <img class="article__img" src="<?= $thumbnail_mobile; ?>" alt="<?= strip_tags( get_the_title( null ) ?? '' ); ?>">
        </picture>
      <?php else : ?>
        <!-- <picture class="picture">
          <img class="article__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title( null ) ?? '' ); ?>">
        </picture> -->
        <div class="plug">
          <p>
            <?= __( 'Страница на этапе разработки', 'osnova' ); ?>
          </p>
        </div>
      <?php endif; ?>  

      <div class="article__content">          
        <?php 
          the_content(  );
        ?>
      </div>
    </div>
  </section>  
</main>

<?php
  get_footer(  );
?>