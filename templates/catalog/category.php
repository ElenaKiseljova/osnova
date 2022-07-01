<ul class="filter__navigation">
  <?php 
    $taxonomy_aside = 'products-category';

    $furniture_term_name = '';

    $products_term_id = get_field( 'products_term_id', 'options' );
    $furniture_term_id = get_field( 'furniture_term_id', 'options' );

    if ($products_term_id && $furniture_term_id) {
      //Продукция
      $products_term_id = pll_get_term($products_term_id) ?? $products_term_id;

      $products_term = get_term_by('id', $products_term_id, $taxonomy_aside);
      $products_term_name = is_a($products_term, 'Wp_term') ? $products_term->name : '';

      //Оборудование
      $furniture_term_id = pll_get_term($furniture_term_id) ?? $furniture_term_id;

      $furniture_term = get_term_by('id', $furniture_term_id, $taxonomy_aside);
      $furniture_term_name = is_a($furniture_term, 'Wp_term') ? $furniture_term->name : '';
    } else {
      return;
    }  
    
    //Страница архива таксономии 
    $term = get_queried_object();

    if ( $term && is_a($term, 'WP_term') ) {
      //Получение всех родителей текущей таксономии
      $term_parents_list = get_term_parents_list($term->term_id, $taxonomy_aside, ['format'=>'slug', 'link'=>false]);

      if ($term_parents_list && !is_wp_error($term_parents_list)) {
        //Получение родителя верхнего уровня
        $term_parent_top_slug = explode('/', $term_parents_list)[0];

        if ($term_parent_top_slug) {
          $term_parent_top = get_term_by('slug', $term_parent_top_slug, $taxonomy_aside);

          //Если родитель существуем - меняем список пунктов, отображаемых
          //в Продукции или Оборудовании
          if ($term_parent_top && is_a($term_parent_top, 'WP_Term')) {
            //Продукция
            if ($term_parent_top->term_id === $products_term_id) {
              $products_term_id = $term->term_id;
            }

            //Оборудование
            if ($term_parent_top->term_id === $furniture_term_id) {
              $furniture_term_id = $term->term_id;
            }
          }              
        }
      }
    }

    // Продукция
    $products_terms_children = get_terms( array(
      'taxonomy' => $taxonomy_aside,
      'hide_empty' => false,
      'parent'   => $products_term_id
    ) );

    if ( $products_terms_children && !empty($products_terms_children) && is_array($products_terms_children) && !is_wp_error($products_terms_children) ) {
      ?>
        <li class="filter__wrap filter__wrap--open">
          <div class="filter__header">
            <h3 class="filter__title"><?= $products_term_name; ?></h3>
            <svg class="filter__arrow">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#header-arrow"></use>
            </svg>
          </div>
          <ul class="filter__list">            
            <?php
              foreach ($products_terms_children as $key => $products_terms_child) {            
                ?>
                  <li class="filter__item">
                    <!-- filter__link--active -->
                    <a class="filter__link " href="<?= get_term_link( $products_terms_child, $taxonomy_aside ); ?>">Реагенты
                      <?= $products_terms_child->name ?? ''; ?>
                    </a>
                  </li>        
                <?php                  
              }
            ?>
          </ul>
        </li>           
      <?php          
    }

    // Оборудование
    $furniture_terms_children = get_terms( array(
      'taxonomy' => $taxonomy_aside,
      'hide_empty' => false,
      'parent'   => $furniture_term_id
    ) );

    if ( $furniture_terms_children && !empty($furniture_terms_children) && is_array($furniture_terms_children) && !is_wp_error($furniture_terms_children) ) {
      ?>
        <li class="filter__wrap filter__wrap--open">
          <div class="filter__header">
            <h3 class="filter__title"><?= $furniture_term_name; ?></h3>
            <svg class="filter__arrow">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#header-arrow"></use>
            </svg>
          </div>
          <ul class="filter__list">            
            <?php
              foreach ($furniture_terms_children as $key => $furniture_terms_child) {            
                ?>
                  <li class="filter__item">
                    <!-- filter__link--active -->
                    <a class="filter__link " href="<?= get_term_link( $furniture_terms_child, $taxonomy_aside ); ?>">
                      <?= $furniture_terms_child->name ?? ''; ?>
                    </a>
                  </li>          
                <?php                  
              }
            ?>     
          </ul>
        </li>           
      <?php          
    }
  ?>
</ul>