<?php 
  /**
   * Template Name: Контакты
   * Template Post Type: page
   */
?>

<?php
  get_header(  );
?>

<?php 
  $title = get_field( 'title' ) ?? [];

  $phone_1 = get_field( 'phone_1' ) ?? [];
  $phone_2 = get_field( 'phone_2' ) ?? [];
  $email_1 = get_field( 'email_1' ) ?? [];
  $email_2 = get_field( 'email_2' ) ?? [];

  $address = get_field( 'address' ) ?? [];

  $map = get_field( 'map' ) ?? '';

  $subdivision_title = get_field( 'subdivision_title' ) ?? '';
  $list = get_field( 'list' ) ?? [];

  $form_title = get_field( 'form_title' ) ?? '';
  $form_shortcode = get_field( 'form_shortcode' ) ?? '';
?>

<main class="main">
  <section class="section heading">
    <div class="container">
      <div class="heading__top">
        <?php 
          if ( function_exists( 'osnova_yoast_breadcrumbs' ) ) {
            osnova_yoast_breadcrumbs(  );
          }
        ?>
        
        <h1 class="heading__title"><?php the_title(  ); ?></h1>
      </div>
    </div>
  </section>

  <section class="section contact">
    <div class="container contact__container">
      <div class="start__wrap start__wrap--contact">
        <p class="start__subtitle"><?= $title['top'] ?? ''; ?></p>
        <h1 class="start__title"><?= $title['bottom'] ?? ''; ?></h1>
      </div>

      <?php if ( has_post_thumbnail(  ) ) : ?>
        <?php 
          $thumbnail = get_the_post_thumbnail_url( null, 'large' ) ?? NOT_FOUND;
        ?>
        <picture class="picture contact__picture">
          <img class="contact__img" src="<?= $thumbnail; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
        </picture>
      <?php else : ?>
        <picture class="picture contact__picture">
          <img class="contact__img" src="<?= NOT_FOUND; ?>" alt="<?= strip_tags( get_the_title(  ) ?? '' ); ?>">
        </picture>
      <?php endif; ?> 

      <address class="contact__address">
        <ul class="contact__list">
          <li class="contact__item">
            <span class="contact__title"><?= __( 'Адрес', 'osnova' ); ?></span>

            <?php if ($address['text'] && !empty($address['text'])) : ?>
              <a href="<?= $address['link']; ?>" class="contact__text" target="_blank"><?= $address['text']; ?></a>
            <?php endif; ?>
          </li>

          <li class="contact__item">
            <span class="contact__title"><?= __( 'Телефон', 'osnova' ); ?></span>

            <div class="contact__wrap">
              <?php if ($phone_1['text'] && !empty($phone_1['text'])) : ?>
                <a href="<?= $phone_1['link']; ?>" class="contact__text"><?= $phone_1['text']; ?></a>
              <?php endif; ?>

              <?php if ($phone_2['text'] && !empty($phone_2['text'])) : ?>
                <a href="<?= $phone_2['link']; ?>" class="contact__text"><?= $phone_2['text']; ?></a>
              <?php endif; ?>
            </div>
          </li>

          <li class="contact__item">
            <span class="contact__title"><?= __( 'E-mail', 'osnova' ); ?></span>

            <div class="contact__wrap">
              <?php if ($email_1['text'] && !empty($email_1['text'])) : ?>
                <a href="<?= $email_1['link']; ?>" class="contact__text">
                  <?= $email_1['text']; ?>
                </a>
              <?php endif; ?>

              <?php if ($email_2['text'] && !empty($email_2['text'])) : ?>
                <a href="<?= $email_2['link']; ?>" class="contact__text">
                  <?= $email_2['text']; ?>
                </a>
              <?php endif; ?>
            </div>
          </li>
        </ul>
      </address>
    </div>
  </section>
  
  <?php if (!empty($map)) : ?>
    <section class="section map">
      <div class="map__frame">
        <?= $map; ?>
      </div>
    </section>
  <?php endif; ?>
  
  <?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
    <section class="section subdivisions">
      <div class="container">
        <h2 class="subdivisions__title title"><?= $subdivision_title; ?></h2>

        <ul class="subdivisions__list">
          <?php foreach ($list as $key => $item) : ?>
            <?php 
              $subdivision_name = $item['subdivision_title'] ?? '';  
              $subdivision_agent = $item['subdivision_agent'] ?? '';  
              $subdivision_phone = $item['subdivision_phone'] ?? [];  
            ?>
            <li class="subdivisions__item">
              <p class="subdivisions__text"><?= $subdivision_name; ?></p>
              <p class="subdivisions__name"><?= $subdivision_agent; ?></p>
              <a href="<?= $subdivision_phone['link'] ?? ''; ?>" class="subdivisions__link"><?= $subdivision_phone['text'] ?? ''; ?></a>
            </li>
          <?php endforeach; ?>          
        </ul>
      </div>
    </section>
  <?php endif; ?>

  <section class="section feedback">
    <div class="container">
      <h2 class="feedback__title title"><?= $form_title?></h2>
      <div class="feedback__form">
        <?= $form_shortcode; ?>
      </div>      
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
