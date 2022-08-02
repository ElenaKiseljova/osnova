  <?php 
    $frontpage_id = get_option( 'page_on_front' );
    
    //Контакты - Расписание
    $shedule = get_field( 'shedule', $frontpage_id ) ?? [];
  ?>
  <footer class="footer">
    <div class="form__container">
      <?php 
        get_template_part( 'templates/form' );
      ?>

      <?php if ($shedule['text'] && !empty($shedule['text'])) : ?>
        <div class="form__graph">
          <h4><?= $shedule['title']; ?></h4>
          <p><?= $shedule['text']; ?></p>
        </div>
      <?php endif; ?>      
    </div>

    <div class="footer__container">
      <div class="footer__logo">
        <?php
          if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
          }
        ?>
      </div>
      <nav class="footer__navigation">
        <?php 
          wp_nav_menu(
            array(
              'theme_location'  => 'footer_menu',
              'container'       => null,
              'menu_class'      => 'footer__list'
            )
          );
        ?>
      </nav>

      <?php 
        get_template_part( 'templates/contacts' );
      ?>           
    </div>
    
    <?php if (is_singular( 'products' )) : ?>
      <div class="overlay"></div>
      <div class="popup">
        <div class="popup__container">
          <button class="popup__close">
            <svg class="popup__icon" width="17" height="17">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#close"></use>
            </svg>
          </button>
          <div class="popup__wrapper">
            <h2 class="popup__title"><?= __( 'Оформить заказ', 'osnova' ); ?> </h2>
            <p class="popup__text"><?= __( 'Оставьте заявку и наши специалисты свяжутся с вами в ближайшее время', 'osnova' ); ?></p>

            <div class="form form--popup">
              <?php 
                if (function_exists( 'pll_current_language' )) {
                  $cur_lang_code = pll_current_language();

                  switch ($cur_lang_code) {
                    case 'ua':
                      echo do_shortcode( '[contact-form-7 id="2959" title="Заказать товар (UA)"]' );

                      break;

                    case 'ru':
                      echo do_shortcode( '[contact-form-7 id="2958" title="Заказать товар (RU)"]' );

                      break;
                    
                    default:
                      echo do_shortcode( '[contact-form-7 id="2958" title="Заказать товар (RU)"]' );

                      break;
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>    
  </footer>

  <?php
    wp_footer();
  ?>
</body>

</html>
