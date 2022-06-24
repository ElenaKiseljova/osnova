<?php 
  /* osnova */
  
  add_action('wp_enqueue_scripts', 'osnova_styles', 3);
  add_action('wp_enqueue_scripts', 'osnova_scripts', 5);
  
  // Styles theme
  function osnova_styles () {    
    // wp_enqueue_style('googleapis-fonts-style', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    // wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/css/libs/swiper-bundle.min.css');
    // wp_enqueue_style('osnova-style', get_stylesheet_uri());
  }

  // Scripts theme
  function osnova_scripts () {    
    if (!is_404(  )) {
      // wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/js/libs/swiper-bundle.min.js', $deps = array(), $ver = null, $in_footer = true );
      // wp_enqueue_script('remove-active-class-elements-script', get_template_directory_uri() . '/assets/js/remove-active-class-elements.min.js', $deps = array(), $ver = null, $in_footer = true );
      // wp_enqueue_script('popup-script', get_template_directory_uri() . '/assets/js/popup.min.js', $deps = array(), $ver = null, $in_footer = true );
      // wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/script.min.js', $deps = array(), $ver = null, $in_footer = true );
      // wp_enqueue_script('form-script', get_template_directory_uri() . '/assets/js/form.min.js', $deps = array(), $ver = null, $in_footer = true );
    }
    
    // AJAX
    // $args = array(
    //   'url' => admin_url('admin-ajax.php'),
    //   'nonce' => wp_create_nonce('osnova_nonce'),
    // );

    // wp_localize_script( 'form-script', 'osnova_ajax', $args);   
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
      // register_nav_menu( 'top_menu', 'Навигация в шапке сайта' );
      // register_nav_menu( 'top_menu_inner', 'Навигация в шапке сайта (внутренние страницы)' );

      // register_nav_menu( 'bottom_menu', 'Навигация в подвале сайта' );
      // register_nav_menu( 'bottom_menu_inner', 'Навигация в подвале сайта (внутренние страницы)' );

      // register_nav_menu( 'category_menu', 'Навигация по категориям в подвале сайта' );

      /* ==============================================
      ********  //Размеры картирок
      =============================================== */
      // add_image_size( 'osnova_about', 470, 626, false);

      // add_image_size( 'osnova_docs', 516, 718, false);

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
      /* ==============================================
      ********  //Регистрация кастомных типов постов
      =============================================== */
      function register_custom_post_types () {
        // Техника
        // register_post_type( 'technics', [
        //   'label'  => null,
        //   'labels' => [
        //     'name'               => 'Техника', // основное название для типа записи
        //     'singular_name'      => 'Единица техники', // название для одной записи этого типа
        //     'add_new'            => 'Добавить единицу техники', // для добавления новой записи
        //     'add_new_item'       => 'Добавление единицы техники', // заголовка у вновь создаваемой записи в админ-панели.
        //     'edit_item'          => 'Редактирование единицы техники', // для редактирования типа записи
        //     'new_item'           => 'Новая единица техники', // текст новой записи
        //     'view_item'          => 'Смотреть единицу техники', // для просмотра записи этого типа.
        //     'search_items'       => 'Искать единицу техники в архиве', // для поиска по этим типам записи
        //     'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        //     'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        //     'parent_item_colon'  => '', // для родителей (у древовидных типов)
        //     'menu_name'          => 'Техника', // название меню
        //   ],
        //   'description'         => 'Это наша Техника',
        //   'public'              => false,
        //   'publicly_queryable'  => false, // зависит от public
        //   'exclude_from_search' => true, // зависит от public
        //   'show_ui'             => true, // зависит от public
        //   'show_in_nav_menus'   => true, // зависит от public
        //   'show_in_menu'        => true, // показывать ли в меню адмнки
        //   'show_in_admin_bar'   => true, // зависит от show_in_menu
        //   'show_in_rest'        => true, // добавить в REST API. C WP 4.7
        //   'rest_base'           => null, // $post_type. C WP 4.7
        //   'menu_position'       => 20,
        //   'menu_icon'           => 'dashicons-car',
        //   //'capability_type'   => 'post',
        //   //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //   //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        //   'hierarchical'        => false,
        //   'supports'            => ['title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        //   'taxonomies'          => ['technics_category'],
        //   'has_archive'         => false,
        //   'rewrite'             => true,
        //   'query_var'           => true,
        // ] );
      }   
      
      register_custom_post_types();

      /* ==============================================
      ********  //Регистрация кастомных таксономий 
      =============================================== */
      function register_custom_taxonomy () {
        // Категории техники
        // register_taxonomy( 'technics_category', [ 'technics' ], [ 
        //   'label'                 => '', // определяется параметром $labels->name
        //   'labels'                => [
        //     'name'              => 'Категории техники',
        //     'singular_name'     => 'Категория техники',
        //     'search_items'      => 'Найти категорию',
        //     'all_items'         => 'Все категории',
        //     'view_item '        => 'Посмотреть категорию',
        //     'parent_item'       => 'Родительская категория',
        //     'parent_item_colon' => 'Родительская категория:',
        //     'edit_item'         => 'Редактировать категорию',
        //     'update_item'       => 'Обновить категорию',
        //     'add_new_item'      => 'Добавить новую категорию',
        //     'new_item_name'     => 'Имя новой категории',
        //     'menu_name'         => 'Категории техники',
        //   ],
        //   'description'           => 'Категории техники', // описание таксономии
        //   'public'                => true,
        //   'publicly_queryable'    => true, // равен аргументу public
        //   // 'show_in_nav_menus'     => true, // равен аргументу public
        //   'show_ui'               => true, // равен аргументу public
        //    'show_in_menu'          => true, // равен аргументу show_ui
        //   // 'show_tagcloud'         => true, // равен аргументу show_ui
        //   // 'show_in_quick_edit'    => null, // равен аргументу show_ui
        //   'hierarchical'          => true,
      
        //   'rewrite'               => true,
        //   //'query_var'             => $taxonomy, // название параметра запроса
        //   // 'capabilities'          => array(),
        //   // 'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        //   // 'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        //   'show_in_rest'          => true, // добавить в REST API
        //   // 'rest_base'             => null, // $taxonomy
        //   // '_builtin'              => false,
        //   //'update_count_callback' => '_update_post_term_count',
        // ] );
      }   
    
      register_custom_taxonomy();
    }  
  endif;

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
  // add_filter( 'nav_menu_css_class', 'osnova_change_menu_item_css_classes', 10, 4 );
  // function osnova_change_menu_item_css_classes( $classes, $item, $args, $depth ) {
  // 	if( $args->theme_location === 'top_menu' || $args->theme_location === 'top_menu_inner' ){
  //     if ($depth === 0) {
  //       $classes[] = 'nav_list_item';
  //     } else if ($depth === 1) {
  //       $classes[] = 'drop_menu_item';
  //     }      
  // 	}

  //   if ($args->theme_location === 'bottom_menu' || $args->theme_location === 'bottom_menu_inner' || $args->theme_location === 'category_menu') {
  //     $classes[] = 'footer__item';
  //   }

  // 	return $classes;
  // }

  /* ==============================================
  ********  //Отправка письма на мейл
  =============================================== */

  // add_action('wp_ajax_osnova_sendmail', 'osnova_sendmail');
  // add_action('wp_ajax_nopriv_osnova_sendmail', 'osnova_sendmail');

  // function osnova_sendmail () {
  //   check_ajax_referer('osnova_nonce', 'security');

  //   if (isset($_POST['email']) && empty($_POST['email'])) {
  //     $response = [
  //       'name' => 'email',
  //       'error' => __('Укажите эл.  почту', 'design')
  //     ];
      
  //     wp_send_json_error( $response );
  
  //     wp_die();
  //   }
    
  //   if (isset($_POST['name']) && empty($_POST['name'])) {   
  //     $response = [
  //       'name' => 'name',
  //       'error' => __('Укажите имя', 'design')
  //     ];
      
  //     wp_send_json_error( $response );
  
  //     wp_die();
  //   }
    
  //   $contactSubject = isset($_POST['subject']) ? esc_html( $_POST['subject'] ) : __('Контактная форма', 'design');
  //   $contactName = isset($_POST['name']) ? ('<p>Имя - ' . esc_html( $_POST['name'] ) . '</p>') : '';
  //   $contactEmail = isset($_POST['email']) ? ('<p>Эл. почта - ' . esc_html( $_POST['email'] ) . '</p>') : '';
  //   $contactMessage = isset($_POST['message']) ? ('<p>Сообщение - ' . esc_html( $_POST['message'] ) . '</p>') : '';
    
  //   $contactMail = $contactName . $contactEmail . $contactMessage;

  //   $dev_mail = 'e.a.kiseljova@gmail.com'; 
  //   // разработка
  //   // $to = (isset($_POST['mailto']) && !empty($_POST['mailto'])) ? 
  //   //   [esc_html( $_POST['mailto'] ), $dev_mail] : 
  //   //   ((get_option('admin_email') !== $dev_mail) ? 
  //   //   [get_option('admin_email'), $dev_mail] : 
  //   //   get_option('admin_email'));
    
  //   // продакшн
  //   $to = (isset($_POST['mailto']) && !empty($_POST['mailto'])) ? 
  //     [esc_html( $_POST['mailto'] ), get_option('admin_email')] : get_option('admin_email');

  //   $site_name = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option('admin_email') . '>';

  //   // удалим фильтры, которые могут изменять заголовок $headers
  //   remove_all_filters( 'wp_mail_from' );
  //   remove_all_filters( 'wp_mail_from_name' );

  //   $headers = array(
  //     $site_name,
  //     'content-type: text/html',
  //   );

  //   wp_mail( $to, $contactSubject, $contactMail, $headers );

  //   $response = [
  //     'post' => $_POST,
  //     'mail' => $contactMail,
  //     'mailto' => $to
  //   ];

  //   wp_send_json_success($response);

  //   wp_die();
  // }
?>