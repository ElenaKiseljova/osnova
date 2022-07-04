<?php 
  /* osnova */
  define('MY_THEME_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/osnova');
  define( 'NOT_FOUND', get_template_directory_uri(  ) . '/assets/img/not-found.jpg' );
  
  add_action('wp_enqueue_scripts', 'osnova_styles', 3);
  add_action('wp_enqueue_scripts', 'osnova_scripts', 5);
  
  // Styles theme
  function osnova_styles () {    
    wp_enqueue_style('googleapis-fonts-style', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
    
    wp_enqueue_style('osnova-style', get_stylesheet_uri());
  }

  // Scripts theme
  function osnova_scripts () {    
    if (!is_404(  )) {
      // wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/swiper-bundle.min.js', $deps = array(), $ver = null, $in_footer = true );
      wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/script.min.js', $deps = array(), $ver = null, $in_footer = true );
      wp_enqueue_script('additional-script', get_template_directory_uri() . '/assets/js/additional.js', $deps = array(), $ver = null, $in_footer = true );
    }
    
    // AJAX
    $args = array(
      'url' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('additional-script.js_nonce'),
    );

    wp_localize_script( 'additional-script', 'osnova_ajax', $args);   
  }

  // After setup
  add_action( 'after_setup_theme', 'osnova_after_setup_theme_function' );

  if (!function_exists('osnova_after_setup_theme_function')) :
    function osnova_after_setup_theme_function () {
      load_theme_textdomain('osnova', get_template_directory() . '/languages');

      /* ==============================================
      ********  //Миниатюрки
      =============================================== */
      add_theme_support( 'post-thumbnails' );

      /* ==============================================
      ********  //Title
      =============================================== */
      add_theme_support('title-tag');
      
      /* ==============================================
      ********  //Лого
      =============================================== */
      add_theme_support( 'custom-logo' );

      /* ==============================================
      ********  //Меню
      =============================================== */
      register_nav_menu( 'header_menu', 'Навигация в шапке сайта' );

      register_nav_menu( 'footer_menu', 'Навигация в подвале сайта' );

      /* ==============================================
      ********  //Размеры картирок
      =============================================== */
      add_image_size( 'osnova_front_start_tablet', 1000, 701, false);

      add_image_size( 'osnova_front_about_tablet', 1000, 560, false);
      add_image_size( 'osnova_front_about_mobile', 320, 179, false);

      add_image_size( 'osnova_blog', 360, 260, false);

      add_image_size( 'osnova_article_tablet', 960, 616, false);

      add_image_size( 'osnova_article_gallery_tablet', 472, 311, false);

      // add_image_size( 'osnova_technics_category_banner', 1600, 890, false);
      // add_image_size( 'osnova_technics_category_banner_mobile', 375, 650, false);
      // add_image_size( 'osnova_technics_category_offer', 570, 327, false);
      
      // add_image_size( 'osnova_technics_gallery', 540, 364, false);
    }
  endif;

  // Init
  add_action( 'init', 'osnova_init_function' );
  
  if (!function_exists('osnova_init_function')) :
    function osnova_init_function () {
      require_once MY_THEME_DIR . '/includes/custom-post-types.php';

      require_once MY_THEME_DIR . '/includes/custom-taxonomy.php';

      /* ==============================================
      ********  //ACF опциональные страницы
      =============================================== */
      function osnova_create_acf_pages() {
        if(function_exists('acf_add_options_page')) {
          acf_add_options_page(array(
            'page_title' 	=> 'Настройки для темы Osnova',
            'menu_title'	=> 'Настройки для темы Osnova',
            'menu_slug' 	=> 'osnova-settings',
            'capability'	=> 'edit_posts',
            'icon_url' => 'dashicons-admin-settings',
            'position' => 23,
            'redirect'		=> false,
          ));
        }    
      }

      osnova_create_acf_pages();
    }  
  endif;

  /* ==============================================
  ********  //Фильтр polylang для добавления 
  ********  //перевоыдов непубликуемым таксономиям
  =============================================== */

  add_filter( 'pll_get_taxonomies', 'add_tax_to_pll', 10, 2 );
  
  function add_tax_to_pll( $taxonomies, $is_settings ) {
      if ( $is_settings ) {
        
      } else {
        $taxonomies['products-category'] = 'products-category';
        $taxonomies['products-tag'] = 'products-tag';
      }

      return $taxonomies;
  }

  /* ==============================================
  ********  //Фильтр типов постов для пагинации на стр Таксономий
  =============================================== */
  add_action( 'pre_get_posts', 'osnova_taxonomy_filter' );

  function osnova_taxonomy_filter( $query ) 
  {
    if( !is_admin() && $query->is_main_query() ) {
      if( $query->is_tag || $query->is_tax ) {
        $query->set( 'post_type', [ 'products', 'post', 'page' ] );
        $query->set( 'posts_per_page', 1 );          
      }
    }
  }



  // Customizer
  // add_action( 'customize_register', 'osnova_customizer' ); 
  // function osnova_customizer ( $wp_customize ) 
  // {
  //   /* Create Panel Logo */  
  //   $wp_customize->add_panel('logo', array(
  //     'priority' => 50,
  //     'theme_supports' => '',
  //     'title' => __('Логотип', 'osnova'),
  //     'description' => __('Изображения для Логотипа (хедер/футер)', 'osnova'),
  //   ));

  //   /* Create Sections for Panel Logo */  
  //   $wp_customize->add_section('logo_header', array(
  //     'panel' => 'logo',
  //     'type' => 'theme_mod', 
  //     'priority' => 5,
  //     'theme_supports' => '',
  //     'title' => __('Логотип (хедер)', 'osnova'),
  //     'description' => '',
  //   ));

  //   $wp_customize->add_section('logo_footer', array(
  //     'panel' => 'logo',
  //     'type' => 'theme_mod', 
  //     'priority' => 10,
  //     'theme_supports' => '',
  //     'title' => __('Логотип (футер)', 'osnova'),
  //     'description' => '',
  //   ));

  //   /* Create Settings for Panel Logo */  
  //   $wp_customize->add_setting('logo_header', array(
  //     'default'    =>  '',
  //     'transport'  =>  'refresh',
  //   ));

  //   $wp_customize->add_setting('logo_footer', array(
  //     'default'    =>  '',
  //     'transport'  =>  'refresh',
  //   ));

  //   /* Create Controls for Panel Logo */  
  //   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_image_header', array(
  //       'label'    => __('Изображение логотипа', 'osnova'),
  //       'section'  => 'logo_header',
  //       'settings' => 'logo_header',
  //   )));

  //   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_image_footer', array(
  //       'label'    => __('Изображение логотипа', 'osnova'),
  //       'section'  => 'logo_footer',
  //       'settings' => 'logo_footer',
  //   )));  
  // }

   /* ==============================================
  ********  //Класс для пунктов меню
  =============================================== */
  add_filter( 'nav_menu_css_class', 'osnova_change_menu_item_css_classes', 10, 4 );
  function osnova_change_menu_item_css_classes( $classes, $item, $args, $depth ) {
  	if( $args->theme_location === 'header_menu' ){
      if ($depth === 0) {
        $classes[] = 'header__item';
      } else if ($depth === 1) {
        $classes[] = 'sub-menu__item';
      }      
  	}

  	return $classes;
  }

  /* ==============================================
  ********  //Класс форм
  =============================================== */
  add_filter( 'wpcf7_form_class_attr', 'osnova_filter_cf7_class' );

  function osnova_filter_cf7_class( $class ){
    $class .= ' feedback__form form';
    

    return $class;
  }

  /* ==============================================
  ********  //Отключение автозаполнения полей CF7
  =============================================== */
  add_filter( 'wpcf7_form_elements', 'osnova_wpcf7_form_elements' );
  function osnova_wpcf7_form_elements( $content ) {
    $str_pos = strpos( $content, 'id="name-1"' );
    if ($str_pos) {
      $content = substr_replace( $content, ' autocomplete="both" autocomplete="off" ', $str_pos, 0 );
    }      

    $str_pos = strpos( $content, 'id="tel"' );
    if ($str_pos) {
      $content = substr_replace( $content, ' autocomplete="both" autocomplete="off" ', $str_pos, 0 );
    }    

    return $content;
  }

  /* ==============================================
  ********  //Ajax
  =============================================== */
  if( wp_doing_ajax() ) {
    add_action('wp_ajax_osnova_ajax_get_posts_list_html', 'osnova_ajax_get_posts_list_html');
    add_action('wp_ajax_nopriv_osnova_ajax_get_posts_list_html', 'osnova_ajax_get_posts_list_html'); 
  }

  function osnova_ajax_get_posts_list_html()
  {
    try {
      // Первым делом проверяем параметр безопасности
      check_ajax_referer('additional-script.js_nonce', 'security');

      $taxonomy = ($_POST['taxonomy'] && !empty($_POST['taxonomy'])) ? $_POST['taxonomy'] : null;
      $term_id = ($_POST['term_id'] && !empty($_POST['term_id'])) ? $_POST['term_id'] : null;

      $posts_per_page = isset($_POST['posts_per_page']) ? (int) $_POST['posts_per_page'] : 9;
      $paged = isset($_POST['paged']) ? (int) $_POST['paged'] : 1;

      $replace = (isset($_POST['replace']) && $_POST['replace'] === '0') ? false : true;

      $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : 'products';

      $response = [
        'post' => $_POST,
      ];

      ob_start();

      if ( $post_type === 'products' ) {
        osnova_get_products_list_html( $posts_per_page, $paged, $taxonomy, $term_id, $replace );
      } else if ( $post_type === 'post' ) {
        osnova_get_posts_list_html( $posts_per_page, $paged, $taxonomy, $term_id, $replace );
      }      
  
      $response['content'] = ob_get_contents();
  
      ob_clean();   
  
      wp_send_json_success( $response );
    } catch (Throwable $th) {
      wp_send_json_error( $th );
    }  

    die();
  }

  /* ==============================================
  ********  //Получение списка Товаров
  =============================================== */
  function osnova_get_products_list_html($posts_per_page = 9, $paged = 1, $taxonomy = null, $term_id = null, $replace = true) 
  {
    $args = [
      'post_type' => 'products',
      'post_status' => 'publish',
      'order' => 'ASC',
      'orderby' => 'menu_order',
      'posts_per_page' => $posts_per_page,
      'paged' => $paged,
    ];

    if ( !is_null($taxonomy) && !is_null($term_id) ) {
      $args['tax_query'][] = [
        'taxonomy' => (string) $taxonomy,
        'field' => 'term_id',
        'terms' => [ (int) $term_id ],
      ];
    }

    $query = new WP_Query( $args ); 

    if ( $query->have_posts() ) {
      if ( $replace ) {
        ?>
          <ul class="category__list" id="more-list">                
            <?php 
              while ( $query->have_posts() ) {
                $query->the_post();
                
                get_template_part( 'templates/catalog/product' );
              }
            ?>
          </ul>
          
          <?php if ($query->max_num_pages > 1) : ?>
            <?php if ($query->max_num_pages > $paged) : ?>
              <button class="category__more" id="more-button" data-max-num-pages="<?= $query->max_num_pages; ?>" data-post-type="products"><?= __( 'Больше', 'osnova' ); ?></button>
            <?php endif; ?>          

            <?php 
              $max_num_pages = $query->max_num_pages;

              $attr = [
                'prev' => false,
                'next' => false,
                'class' => 'category__pages',
              ];

              osnova_get_pagination_html($max_num_pages, $paged, $attr);
            ?>
          <?php endif; ?>       
        <?php 
      } else {
        while ( $query->have_posts() ) {
          $query->the_post();
          
          get_template_part( 'templates/catalog/product' );
        }
      } 

      wp_reset_postdata();
    } else {
      ?>
        <p class="category__empty">
          <?= __( 'По вашему запросу результатов не найдено', 'osnova' ); ?>
        </p>
      <?php
    } 
  }
  
  /* ==============================================
  ********  //Получение списка Постов
  =============================================== */
  function osnova_get_posts_list_html($posts_per_page = 6, $paged = 1, $taxonomy = null, $term_id = null, $replace = true, $type = 'last' ) 
  {
    $sticky = get_option( 'sticky_posts' );
    
    $args = [
      'post_type' => 'post',
      'post_status' => 'publish',
      'order' => 'ASC',
      'orderby' => 'menu_order',
    ];

    if ( $type === 'last' ) {
      $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post__not_in' => $sticky,
      ];

      if ( !is_null($taxonomy) && !is_null($term_id) ) {
        $args['tax_query'][] = [
          'taxonomy' => (string) $taxonomy,
          'field' => 'term_id',
          'terms' => [ (int) $term_id ],
        ];
      }
    } else if ( $type === 'news' ) {
      $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'posts_per_page' => $posts_per_page,
        'post__in' => $sticky_slice,
        'ignore_sticky_posts' => 1
      ];
    }

    $query = new WP_Query( $args ); 

    if ( $query->have_posts() ) {
      if ( $replace ) {
        ?>
          <ul class="last__list" id="more-list">                
            <?php 
              while ( $query->have_posts() ) {
                $query->the_post();
                
                get_template_part( 'templates/post', 'card' );
              }
            ?>
          </ul>
          
          <?php if ($query->max_num_pages > 1 && $type === 'last') : ?>
            <?php if ($query->max_num_pages > $paged) : ?>
              <button class="last__btn" id="more-button" data-max-num-pages="<?= $query->max_num_pages; ?>" data-post-type="post"><?= __( 'Больше', 'osnova' ); ?></button>
            <?php endif; ?> 
          <?php endif; ?>       
        <?php 
      } else {
        while ( $query->have_posts() ) {
          $query->the_post();
          

          if ( $type === 'last' ) {
            get_template_part( 'templates/post', 'card' );
          } else if ( $type === 'news' ) {
            get_template_part( 'templates/post', 'news' );
          }          
        }
      }       

      wp_reset_postdata();
    } else {
      ?>
        <p class="category__empty">
          <?= __( 'По вашему запросу результатов не найдено', 'osnova' ); ?>
        </p>
      <?php
    } 
  }

  /* ==============================================
  ********  //Пагинация
  =============================================== */
  function osnova_get_pagination_html( $max_num_pages, $paged, $attr = [] ) 
  {
    $show = isset($attr['show']) ? (int) $attr['show'] : 5;
    $left = isset($attr['left']) ? (int) $attr['left'] : 3;
    $center = isset($attr['center']) ? (int) $attr['center'] : 3;
    $right = isset($attr['right']) ? (int) $attr['right'] : 4;

    $prev = isset($attr['prev']) ? $attr['prev'] : true;
    $next = isset($attr['next']) ? $attr['next'] : true;

    $prev_text = isset($attr['prev_text']) ? $attr['prev_text'] : __( 'Назад', 'osnova' );
    $next_text = isset($attr['next_text']) ? $attr['next_text'] : __( 'Вперёд', 'osnova' );
    $class = isset($attr['class']) ? $attr['class'] : '';
    ?>          
      <ul class="pagination <?= $class; ?>">
        <?php if ($prev) : ?>
          <li class="pagination__item pagination__item--prev">
            <a href="#catalog-ajax" class="pagination__button pagination__button--prev <?= ($paged === 1) ? 'disabled' : ''; ?>"  data-paged="<?= $paged - 1; ?>">
              <svg width="9" height="14">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#pagination-prev"></use>
              </svg>

              <?= $prev_text; ?>
            </a>
          </li>
        <?php endif; ?>          

        <?php 
          if ($max_num_pages <= $show) {
            for ($i=1; $i <= $max_num_pages; $i++) { 
              ?>
                <li class="pagination__item">
                  <a href="#catalog-ajax" class="pagination__button pagination__button--page <?= ($i === 1) ? 'first' : ($i === $max_num_pages ? 'last' : ''); ?> <?= ($i === $paged) ? 'current' : ''; ?>" data-paged="<?= $i; ?>">
                    <?= $i; ?>
                  </a>
                </li>
              <?php
            }
          } else if ($max_num_pages > $show) {
            if ($paged <= $left) {
              for ($i=1; $i <= $left; $i++) {                  
                ?>
                  <li class="pagination__item">
                    <a href="#catalog-ajax" class="pagination__button pagination__button--page <?= ($i === 1) ? 'first' : ''; ?> <?= ($i === $paged) ? 'current' : ''; ?>" data-paged="<?= $i; ?>">
                      <?= $i; ?>
                    </a>
                  </li>
                <?php
              }
              ?>
                <li class="pagination__item pagination__item--separate">
                  ...
                </li>
                <li class="pagination__item">
                  <a href="#catalog-ajax" class="pagination__button pagination__button--page last" data-paged="<?= $max_num_pages; ?>">
                    <?= $max_num_pages; ?>
                  </a>
                </li>
              <?php
            } else if ($paged > $left && $paged <= ($max_num_pages - $right)) {
              ?>
                <li class="pagination__item">
                  <a href="#catalog-ajax" class="pagination__button pagination__button--page" data-paged="1">
                    1
                  </a>
                </li>
                <li class="pagination__item pagination__item--separate">
                  ...
                </li>
              <?php
              $center_half = floor($center/2);
              for ($i= ($paged - $center_half); $i <= ($paged + $center_half); $i++) {                  
                ?>
                  <li class="pagination__item">
                    <a href="#catalog-ajax" class="pagination__button pagination__button--page <?= ((int)$i === $paged) ? 'current' : ''; ?>" data-paged="<?= $i; ?>">
                      <?= $i; ?>
                    </a>
                  </li>
                <?php
              }
              ?>
                <li class="pagination__item pagination__item--separate">
                  ...
                </li>
                <li class="pagination__item">
                  <a href="#catalog-ajax" class="pagination__button pagination__button--page" data-paged="<?= $max_num_pages; ?>1">
                    <?= $max_num_pages; ?>
                  </a>
                </li>                    
              <?php
            } else if ($paged > $left && $paged > ($max_num_pages - $right)) {
              ?>
              <li class="pagination__item">
                <a href="#catalog-ajax" class="pagination__button pagination__button--page" data-paged="1">
                  1
                </a>
              </li>
              <li class="pagination__item pagination__item--separate">
                ...
              </li>
              <?php
              for ($i= ($max_num_pages - $right + 1); $i <= $max_num_pages; $i++) {                  
                ?>
                  <li class="pagination__item">
                    <a href="#catalog-ajax" class="pagination__button pagination__button--page <?= ($i === $max_num_pages) ? 'last' : ''; ?> <?= ($i === $paged) ? 'current' : ''; ?>" data-paged="<?= $i; ?>">
                      <?= $i; ?>
                    </a>
                  </li>
                <?php
              }
            }                
          }              
        ?>
        
        <?php if ($next) : ?>
          <li class="pagination__item pagination__item--next">
            <a href="#catalog-ajax" class="pagination__button pagination__button--next <?= ($paged === $max_num_pages) ? 'disabled' : ''; ?>" data-paged="<?= $paged + 1; ?>">
              <?= $next_text; ?>  
              <svg width="9" height="14">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#pagination-next"></use>
              </svg>
            </a>
          </li>
        <?php endif; ?>          
      </ul>         
    <?php
  }

  
?>