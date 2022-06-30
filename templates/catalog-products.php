<?php  
  // Таксономия и терм для фильтрации товаров
  $taxonomy = null;
  $term_id = null;
  
  $term = get_queried_object();

  if ( $term && is_a($term, 'WP_term') ) {
    $taxonomy = $term->taxonomy;
    $term_id = $term->term_id;
  }

  // Получаем номер текущей стр для пагинации
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;;

  //Получение кол-ва Товаров на 1 стр
  $posts_per_page = get_field( 'posts_per_page', 'options' ) ?? 9;
?>

<script>
  window.paged = '<?= $paged; ?>';
  window.postPerpage = '<?= $posts_per_page; ?>';
  window.taxonomy = '<?= $taxonomy; ?>';
  window.term_id = '<?= $term_id; ?>';
</script>

<div>  
  <div id="catalog-ajax">
    <?php 
      osnova_get_products_list_html($posts_per_page, $paged, $taxonomy, $term_id);          
    ?>
  </div> 
</div> 