<?php 
  $frontpage_id = get_option( 'page_on_front' );

  //Форма
  $form_title = get_field( 'form_title', $frontpage_id ) ?? '';
  $form_text = get_field( 'form_text', $frontpage_id ) ?? '';
  $form_shortcode = get_field( 'form_shortcode', $frontpage_id ) ?? '';
?>

<h2 class="form__title title"><?= $form_title; ?></h2>
<p class="form__about"><?= $form_text; ?></p>

<div class="form">
  <?= $form_shortcode; ?>
</div>
