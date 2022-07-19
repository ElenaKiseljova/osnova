
<?php 
  $frontpage_id = get_option( 'page_on_front' );
  
  $phone = get_field( 'phone', $frontpage_id ) ?? [];
?>

<?php 
  get_template_part( 'templates/head' );
?>

<header class="header">
  <div class="container header__container">        
    <div class="header__logo logo">
      <?php
        if ( function_exists( 'the_custom_logo' ) ) {
          the_custom_logo();
        }
      ?>
    </div>

    <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
      <?php 
        $languages = pll_the_languages(array('raw'=>1));   
      ?>
      <ul class="lang">
        <?php foreach ($languages as $key => $language) : ?>
          <li class="lang__item">
            <a href="<?= $language['url']; ?>" class="lang__link <?= $language['current_lang'] ? 'lang__link--active' : ''; ?>" data-text="<?= mb_strtoupper($language['slug']); ?>">
              <?= mb_strtoupper($language['slug']); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?> 

    <div class="header__wrapper">
      <nav class="header__navigation navigation">
        <?php 
          wp_nav_menu(
            array(
              'theme_location'  => 'header_menu',
              'container'       => null,
              'menu_class'      => 'navigation__list'
            )
          );
        ?>
      </nav>
      
      <?php if ($phone['text'] && !empty($phone['text'])) : ?>
        <a href="<?= $phone['link']; ?>" class="header__btn btn"><?= $phone['text']; ?></a>
      <?php endif; ?>          
    </div>
    <button class="burger">
      <span class="burger__line"></span>
    </button>
  </div>
</header>

