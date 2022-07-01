<?php 
  $list = get_sub_field( 'list' ) ?? [];
?>

<?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
  <ul class="category-info__list">
    <?php foreach ($list as $key => $item) : ?>
      <?php 
        $name = $item['title'] ?? '';  
        $description = $item['description'] ?? '';  
      ?>
      <li class="category-info__item">
        <h4><?= $name; ?></h4>
        <p><?= $description; ?></p>
      </li>
    <?php endforeach; ?>        
  </ul>
<?php endif; ?>