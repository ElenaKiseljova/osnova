<?php 
  /* ==============================================
  ********  //Регистрация кастомных таксономий 
  =============================================== */
  function register_custom_taxonomy () {
    // Категории товаров
    register_taxonomy( 'products-category', [ 'products' ], [ 
      'label'                 => '', // определяется параметром $labels->name
      'labels'                => [
        'name'              => __( 'Категории товаров', 'osnova' ),
        'singular_name'     => __( 'Категория товаров', 'osnova' ),
        'search_items'      => __( 'Найти категорию', 'osnova' ),
        'all_items'         => __( 'Все категории', 'osnova' ),
        'view_item '        => __( 'Посмотреть категорию', 'osnova' ),
        'parent_item'       => __( 'Родительская категория', 'osnova' ),
        'parent_item_colon' => __( 'Родительская категория:', 'osnova' ),
        'edit_item'         => __( 'Редактировать категорию', 'osnova' ),
        'update_item'       => __( 'Обновить категорию', 'osnova' ),
        'add_new_item'      => __( 'Добавить новую категорию', 'osnova' ),
        'new_item_name'     => __( 'Имя новой категории', 'osnova' ),
        'menu_name'         => __( 'Категории товаров', 'osnova' ),
      ],
      'description'           => __( 'Категории товаров фабрики "Основа"', 'osnova' ), // описание таксономии
      'public'                => true,
      'publicly_queryable'    => true, // равен аргументу public
      // 'show_in_nav_menus'     => true, // равен аргументу public
      'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
      // 'show_tagcloud'         => true, // равен аргументу show_ui
      // 'show_in_quick_edit'    => null, // равен аргументу show_ui
      'hierarchical'          => true,

      'rewrite'               => true,
      //'query_var'             => $taxonomy, // название параметра запроса
      // 'capabilities'          => array(),
      // 'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
      // 'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
      'show_in_rest'          => true, // добавить в REST API
      // 'rest_base'             => null, // $taxonomy
      // '_builtin'              => false,
      //'update_count_callback' => '_update_post_term_count',
    ] );

    // Теги товаров
    register_taxonomy( 'products-tag', [ 'products' ], [ 
      'label'                 => '', // определяется параметром $labels->name
      'labels'                => [
        'name'              => __( 'Теги товаров', 'osnova' ),
        'singular_name'     => __( 'Тег товаров', 'osnova' ),
        'search_items'      => __( 'Найти тег', 'osnova' ),
        'all_items'         => __( 'Все теги', 'osnova' ),
        'view_item '        => __( 'Посмотреть тег', 'osnova' ),
        'parent_item'       => __( 'Родительский тег', 'osnova' ),
        'parent_item_colon' => __( 'Родительский тег:', 'osnova' ),
        'edit_item'         => __( 'Редактировать тег', 'osnova' ),
        'update_item'       => __( 'Обновить тег', 'osnova' ),
        'add_new_item'      => __( 'Добавить новый тег', 'osnova' ),
        'new_item_name'     => __( 'Имя нового тега', 'osnova' ),
        'menu_name'         => __( 'Теги товаров', 'osnova' ),
      ],
      'description'           => __( 'Теги товаров фабрики "Основа"', 'osnova' ), // описание таксономии
      'public'                => true,
      'publicly_queryable'    => true, // равен аргументу public
      // 'show_in_nav_menus'     => true, // равен аргументу public
      'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
      // 'show_tagcloud'         => true, // равен аргументу show_ui
      // 'show_in_quick_edit'    => null, // равен аргументу show_ui
      'hierarchical'          => false,

      'rewrite'               => true,
      //'query_var'             => $taxonomy, // название параметра запроса
      // 'capabilities'          => array(),
      // 'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
      // 'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
      'show_in_rest'          => true, // добавить в REST API
      // 'rest_base'             => null, // $taxonomy
      // '_builtin'              => false,
      //'update_count_callback' => '_update_post_term_count',
    ] );
  }   

  register_custom_taxonomy();
?>