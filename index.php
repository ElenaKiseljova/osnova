<?php
  get_header(  );
?>

<?php 
  // Таксономия и терм для фильтрации товаров
  $taxonomy = null;
  $term_id = null;

  $term = get_queried_object();

  if ( $term && is_a($term, 'WP_term') ) {
    $taxonomy = $term->taxonomy;
    $term_id = $term->term_id;
  }

  // ИД блога
  $page_for_posts = get_option( 'page_for_posts' );

  //Получение кол-ва Постов на 1 стр
  $posts_per_page = get_field( 'posts_per_page', $page_for_posts  ) ? get_field( 'posts_per_page', $page_for_posts  ) : (get_option( 'posts_per_page' ) ?? 6);

  //Последние новости
  $last_news_title = get_field( 'last_news_title', $page_for_posts  ) ?? '';
?>

<script>
  window.paged = '1';
  window.postPerpage = '<?= $posts_per_page; ?>';
  window.taxonomy = '<?= $taxonomy; ?>';
  window.term_id = '<?= $term_id; ?>';
</script>

<main class="main">
  <?php if ( is_home(  ) && !is_front_page(  ) ) : ?>
    <section class="section heading">
      <div class="container">
        <div class="heading__top">
          <h1 class="heading__title"><?= get_the_title( $page_for_posts ); ?></h1>
        </div>
      </div>
    </section>

    <section class="section news news--tidings">
      <div class="container">
        <ul class="news__list">
          <?php 
            osnova_get_posts_list_html( 3, 1, null, null, false, 'news' );
          ?>
        </ul>
      </div>
    </section>

    <section class="section last">
      <div class="container">
        <h2 class="last__title title"><?= $last_news_title; ?></h2>

        <div class="last__wrapper" id="catalog-ajax">
          <?php 
            osnova_get_posts_list_html( $posts_per_page, 1, null, null, true, 'last' );
          ?>
        </div>
      </div>
    </section>
  <?php else : ?>
    <section class="section heading">
      <div class="container">
        <div class="heading__top">
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
          <picture class="picture">
            <img class="article__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title( null ) ?? '' ); ?>">
          </picture>
        <?php endif; ?>  

        <div class="article__content">          
          <?php 
            the_content(  );
          ?>
        </div>

        <?php 
          // Check value exists.
          if( have_rows('content') ):

            // Loop through rows.
            while ( have_rows('content') ) : the_row();

                // Case: gallery layout.
                if( get_row_layout() == 'gallery' ):
                    get_template_part( 'templates/post/gallery' );

                // Case: description layout.
                elseif( get_row_layout() == 'description' ):
                  get_template_part( 'templates/post/description' );

                // Case: video layout.
                elseif( get_row_layout() == 'video' ):
                  get_template_part( 'templates/post/video' );
                          
                endif;

            // End loop.
            endwhile;

          // No value.
          else :
            // Do something...
          endif;
        ?>
      </div>
    </section>

    <section class="section last">
      <div class="container">
        <h2 class="last__title title"><?=  $last_news_title; ?></h2>

        <div class="last__wrapper">
          <?php 
            osnova_get_posts_list_html( $posts_per_page, 1, null, null, true, 'last' );
          ?>
        </div>
      </div>
    </section>    
  <?php endif; ?>
</main>

<?php
  get_footer(  );
?>
