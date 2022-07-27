<ul class="filter__navigation">
  <?php 
    $taxonomy_aside = 'products-category'; 
    
    $term_id = 0; 

    //Страница архива таксономии 
    $term = get_queried_object();

    if ( $term && is_a($term, 'WP_term') ) {
      $term_id = $term->term_id;
    }

    $term_children = get_terms( [
      'taxonomy' => $taxonomy_aside,
      'hide_empty' => true,
      'parent'   => $term_id
    ] );
  ?>

  <?php if ( $term_children && !empty($term_children) && is_array($term_children) && !is_wp_error($term_children) ) : ?>    
    <?php foreach ($term_children as $key => $term_child) : ?>
      <?php 
        $term_child_id = $term_child->term_id ?? null;  
        $term_child_mame = $term_child->name ?? ''; 
        $term_child_link = get_term_link( $term_child, $taxonomy_aside ) ?? '';  

        $sub_term_children = get_terms( [
          'taxonomy' => $taxonomy_aside,
          'hide_empty' => true,
          'parent'   => $term_child_id 
        ] );
      ?>
      <?php if ( $sub_term_children && !empty($sub_term_children) && is_array($sub_term_children) && !is_wp_error($sub_term_children) ) : ?>
         <li class="filter__wrap filter__wrap--open">
            <div class="filter__header">
              <a class="filter__title" href="<?= $term_child_link; ?>"><?= $term_child_mame; ?></a>
              <svg class="filter__arrow">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#header-arrow"></use>
              </svg>
            </div>
            <ul class="filter__list"> 
              <?php foreach ($sub_term_children as $key => $sub_term_child) : ?>
                <?php 
                  $sub_term_child_link = get_term_link( $sub_term_child, $taxonomy_aside ) ?? '';  
                  $sub_term_child_mame = $sub_term_child->name ?? ''; 
                ?>
                <li class="filter__item">
                  <!-- filter__link--active -->
                  <a class="filter__link " href="<?= $sub_term_child_link; ?>">
                    <?= $sub_term_child_mame; ?>
                  </a>
                </li> 
              <?php endforeach; ?>   
                        
            </ul>
          </li>  
      <?php else : ?>
        <li class="filter__wrap">
          <div class="filter__header">
            <a class="filter__title <?= $term_child_id === $term_id ? 'filter__title--current' : ''; ?>" href="<?= $term_child_link; ?>"><?= $term_child_mame; ?></a>
          </div>      
        </li>     
      <?php endif; ?>         
    <?php endforeach; ?>  
  <?php else : ?>      
    <?php 
      // Нет дочерних категорий
      $term_parent_id = $term->parent ?? null;

      $term_parent = get_term_by( 'id', $term_parent_id, $taxonomy_aside ) ?? null;

      $term_parent_link = get_term_link( $term_parent, $taxonomy_aside ) ?? ''; 
      $term_parent_name = $term_parent->name ?? '';   

      $term_parent_children = get_terms( [
        'taxonomy' => $taxonomy_aside,
        'hide_empty' => true,
        'parent'   => $term_parent_id
      ] );
    ?>

    <?php if ( $term_parent_children && !empty($term_parent_children) && is_array($term_parent_children) && !is_wp_error($term_parent_children) ) : ?>
      <li class="filter__wrap filter__wrap--open">
        <div class="filter__header">
          <a class="filter__title" href="<?= $term_parent_link; ?>"><?= $term_parent_name; ?></a>
          <svg class="filter__arrow">
            <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#header-arrow"></use>
          </svg>
        </div>
        <ul class="filter__list">            
          <?php foreach ($term_parent_children as $key => $term_parent_child) : ?>
            <?php 
              $term_parent_child_id = $term_parent_child->term_id ?? null;  
              $term_parent_child_mame = $term_parent_child->name ?? ''; 
              $term_parent_child_link = get_term_link( $term_parent_child, $taxonomy_aside ) ?? '';  
            ?>
            <li class="filter__item">
              <a class="filter__link <?= ($term_parent_child_id === $term_id) ? 'filter__link--active' : ''; ?>" href="<?= $term_parent_child_link; ?>">
                <?= $term_parent_child_mame; ?>
              </a>
            </li>        
          <?php endforeach; ?>    
        </ul>
      </li>       
    <?php endif; ?>
  <?php endif; ?>
</ul>