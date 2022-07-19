<?php     
  // Таксономия и терм для фильтрации
  $taxonomy = null;
  $term_id = null;
  $term_name = null;

  $term = get_queried_object();

  if ( $term && is_a($term, 'WP_term') ) {
    $taxonomy = $term->taxonomy;
    $term_id = $term->term_id;
    $term_name = $term->name;
  }

  // Получаем номер текущей стр для пагинации
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;   

  // ИД блога
  $page_for_posts = get_option( 'page_for_posts' );

  //Получение кол-ва Постов на 1 стр
  $posts_per_page = get_field( 'posts_per_page', $page_for_posts  ) ? get_field( 'posts_per_page', $page_for_posts  ) : (get_option( 'posts_per_page' ) ?? 6);

  //Последние новости
  $last_news_title = get_field( 'last_news_title', $page_for_posts  ) ?? '';

  $order = get_field( 'order', $page_for_posts  ) ? get_field( 'order', $page_for_posts  ) : 'DESC';

  $replace = true;
?>
<script>
  window.paged = '<?= $paged; ?>';
  window.postPerpage = '<?= $posts_per_page; ?>';
  window.taxonomy = '<?= $taxonomy; ?>';
  window.term_id = '<?= $term_id; ?>';
  window.order = '<?= $order; ?>';
</script>

<section class="section heading">
  <div class="container">
    <div class="heading__top">
      <?php 
        if ( function_exists( 'osnova_yoast_breadcrumbs' ) ) {
          osnova_yoast_breadcrumbs(  );
        }
      ?>

      <h1 class="heading__title"><?= $term_name ?? get_the_title( $page_for_posts ); ?></h1>
    </div>
  </div>
</section>

<section class="section news news--tidings">
  <div class="container">
    <ul class="news__list">
      <?php 
        osnova_get_posts_list_html( 3, 1, $taxonomy, $term_id, false, 'news', $order );
      ?>
    </ul>
  </div>
</section>

<section class="section last">
  <div class="container">
    <h2 class="last__title title"><?= $last_news_title; ?></h2>

    <div class="last__wrapper" id="catalog-ajax">
      <?php 
        osnova_get_posts_list_html( $posts_per_page, 1, $taxonomy, $term_id, $replace, 'last', $order );
      ?>
    </div>
  </div>
</section>