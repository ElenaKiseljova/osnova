<ul class="filter__navigation">
  <?php 
    $taxonomy_aside = 'products-category'; 
    
    $term_id = 0; 

    //Страница архива таксономии 
    $term = get_queried_object();

    if ( $term && is_a($term, 'WP_term') &&  $term->taxonomy !== 'products-tag') {
      $term_id = $term->term_id;
    }

    $term_children = get_terms( [
      'taxonomy' => $taxonomy_aside,
      'hide_empty' => true,
      'parent'   => 0,      
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
          'child_of' => $term_child_id,
        ] );
      ?>
      <?php if ( $sub_term_children && !empty($sub_term_children) && is_array($sub_term_children) && !is_wp_error($sub_term_children) ) : ?>
         <li class="filter__wrap filter__wrap--open">
            <div class="filter__header">
              <a class="filter__title <?= ($term_child_id === $term_id )  ? 'filter__title--current' : ''; ?>" href="<?= $term_child_link; ?>"><?= $term_child_mame; ?></a>
              <svg class="filter__arrow">
                <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#header-arrow"></use>
              </svg>
            </div>
            <ul class="filter__list"> 
              <?php foreach ($sub_term_children as $key => $sub_term_child) : ?>
                <?php 
                  $sub_term_child_id = $sub_term_child->term_id ?? null;
                  $sub_term_child_link = get_term_link( $sub_term_child, $taxonomy_aside ) ?? '';  
                  $sub_term_child_mame = $sub_term_child->name ?? ''; 
                ?>
                <li class="filter__item">
                  <a class="filter__link <?= ($sub_term_child_id === $term_id )  ? 'filter__link--active' : ''; ?>" href="<?= $sub_term_child_link; ?>">
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
  <?php endif; ?>
</ul>