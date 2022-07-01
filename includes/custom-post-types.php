<?php 
  /* ==============================================
  ********  //Регистрация кастомных типов постов
  =============================================== */
  function register_custom_post_types () {
    // Товары
    register_post_type( 'products', [
      'label'  => null,
      'labels' => [
        'name'               => __( 'Товары', 'osnova' ), // основное название для типа записи
        'singular_name'      => __( 'Товар', 'osnova' ), // название для одной записи этого типа
        'add_new'            => __( 'Добавить товар', 'osnova' ), // для добавления новой записи
        'add_new_item'       => __( 'Добавление товара', 'osnova' ), // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => __( 'Редактирование товара', 'osnova' ), // для редактирования типа записи
        'new_item'           => __( 'Новый товар', 'osnova' ), // текст новой записи
        'view_item'          => __( 'Смотреть товар', 'osnova' ), // для просмотра записи этого типа.
        'search_items'       => __( 'Искать товар в архиве', 'osnova' ), // для поиска по этим типам записи
        'not_found'          => __( 'Не найден товар', 'osnova' ), // если в результате поиска ничего не было найдено
        'not_found_in_trash' => __( 'Не найден товар в корзине', 'osnova' ), // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => __( 'Товары', 'osnova' ), // название меню
      ],
      'description'         => __( 'Это наши товары', 'osnova' ),
      'public'              => true,
      'publicly_queryable'  => true, // зависит от public
      'exclude_from_search' => true, // зависит от public
      'show_ui'             => true, // зависит от public
      'show_in_nav_menus'   => true, // зависит от public
      'show_in_menu'        => true, // показывать ли в меню адмнки
      'show_in_admin_bar'   => true, // зависит от show_in_menu
      'show_in_rest'        => true, // добавить в REST API. C WP 4.7
      'rest_base'           => null, // $post_type. C WP 4.7
      'menu_position'       => 20,
      'menu_icon'           => 'dashicons-cart',
      'capability_type'   => 'post',
      //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
      //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
      'hierarchical'        => false,
      'supports'            => ['title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
      'taxonomies'          => ['products-category', 'products-tag'],
      'has_archive'         => true,
      'rewrite'             => true,
      'query_var'           => true,
    ] );
  }   

  register_custom_post_types();
?>