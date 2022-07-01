<?php 
  // ИД Каталога
  $catalog_page_id = get_field( 'catalog_page_id', 'options' ) ?? null;

  $tags = [];

  $term = get_queried_object();

  if ( $term && is_a($term, 'WP_term') ) {
    $tags = get_field( 'tags', $term ) ?? [];
  } else if ( $catalog_page_id ) {
    $tags = get_field( 'tags', $catalog_page_id ) ?? [];
  }
?>
<?php if ( !empty($tags) && is_array($tags) && !is_wp_error( $tags ) ) : ?>
  <ul class="product__category product__category--category">
    <?php foreach ($tags as $key => $tag) : ?>
      <?php 
        $link = get_term_link( $tag ) ?? '';
        $name = $tag->name ?? '';  
      ?>    
      <li class="product__item">
        <a class="product__text " href="<?= $link; ?>"><?= $name; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>  
<?php endif; ?>
