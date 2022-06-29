<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $description = get_sub_field( 'description' ) ?? '';
?>

<section class="dosing section">
  <div class="container dosing__container">
    <h2 class="dosing__title title"><?= $title; ?></h2>

    <div class="dosing__content">
      <?= $description; ?>
    </div>
  </div>
</section>