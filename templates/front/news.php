<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $button = get_sub_field( 'button' ) ?? [];

  $list = get_sub_field( 'list' ) ?? [];
?>

<section class="section news" id="news">
  <div class="container">
    <div class="news__wrapper">
      <h2 class="news__title title"><?= $title; ?></h2>

      <?php if ($button['text'] && !empty($button['text'])) : ?>
        <a class="news__btn news__btn--mod" href="<?= $button['link'] ?? ''; ?>"><?= $button['text']; ?></a>
      <?php endif; ?>        
    </div>
    
    <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
      <ul class="news__list">
        <?php foreach ($list as $key => $post) : ?>
          <?php 
            setup_postdata($post);
            
            get_template_part( 'templates/post', 'news' );
          ?>
        <?php endforeach; ?>        
      </ul>
      <?php 
        wp_reset_postdata();
      ?>
    <?php endif; ?>    
    
    <?php if ($button['text'] && !empty($button['text'])) : ?>
      <a class="news__btn" href="<?= $button['link'] ?? ''; ?>"><?= $button['text']; ?></a>
    <?php endif; ?>  
  </div>
</section>