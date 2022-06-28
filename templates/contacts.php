<?php 
  $frontpage_id = get_option( 'page_on_front' );
  
  //Контакты
  $phone_1 = get_field( 'phone_1', $frontpage_id ) ?? [];
  $phone_2 = get_field( 'phone_2', $frontpage_id ) ?? [];

  $email_1 = get_field( 'email_1', $frontpage_id ) ?? [];
  $email_2 = get_field( 'email_2', $frontpage_id ) ?? [];

  $address = get_field( 'address', $frontpage_id ) ?? '';
?>

<address class="footer__address">
  <ul class="footer__address-list">
    <?php if ($phone_1['text'] && !empty($phone_1['text'])) : ?>
      <li class="footer__address-item">
        <a href="<?= $phone_1['link']; ?>" class="footer__tel"><?= $phone_1['text']; ?></a>
      </li>
    <?php endif; ?>

    <?php if ($phone_2['text'] && !empty($phone_2['text'])) : ?>
      <li class="footer__address-item">
        <a href="<?= $phone_2['link']; ?>" class="footer__tel"><?= $phone_2['text']; ?></a>
      </li>
    <?php endif; ?>

    <?php if ($email_1['text'] && !empty($email_1['text'])) : ?>
      <li class="footer__address-item">
        <a href="<?= $email_1['link']; ?>" class="footer__mail"><?= $email_1['text']; ?></a>
      </li>
    <?php endif; ?>

    <?php if ($email_2['text'] && !empty($email_2['text'])) : ?>
      <li class="footer__address-item">
        <a href="<?= $email_2['link']; ?>" class="footer__mail"><?= $email_2['text']; ?></a>
      </li>
    <?php endif; ?>
  </ul>
  
  <?php if ($address && !empty($address)) : ?>
    <p class="footer__city"><?= $address; ?></p>
  <?php endif; ?>        
</address> 