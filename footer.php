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
  </footer>

  <?php
    wp_footer();
  ?>
</body>

</html>
