<?php
  global $post;

  $post_id = $post->ID ?? null; 
  $taxonomy = 'products-tag' ?? '';

  $tags = wp_get_post_terms( $post_id, $taxonomy ) ?? [];
?>

<?php if (!empty( $tags ) && is_array( $tags ) && !is_wp_error( $tags )) : ?>
  <ul class="product__category">
    <?php foreach ($tags as $key => $tag) : ?>
      <li class="product__item">
        <a href="<?= get_term_link( $tag, $taxonomy ) ?? ''; ?>" class="product__text"><?= $tag->name ?? ''; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
