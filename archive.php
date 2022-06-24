<?php
  get_header(  );
?>

<main class="main">
  <section class="section fatal">
    <div class="container fatal__container">     
      <?php 
        $taxonomy = 'products-category';

        $furniture_term_name = '';

        $products_term_id = get_field( 'products_term_id', 'options' );
        $furniture_term_id = get_field( 'furniture_term_id', 'options' );

        if ($products_term_id && $furniture_term_id) {
          //Продукция
          $products_term_id = pll_get_term($products_term_id) ?? $products_term_id;

          $products_term = get_term_by('id', $products_term_id, $taxonomy);
          $products_term_name = is_a($products_term, 'Wp_term') ? $products_term->name : '';

          //Оборудование
          $furniture_term_id = pll_get_term($furniture_term_id) ?? $furniture_term_id;

          $furniture_term = get_term_by('id', $furniture_term_id, $taxonomy);
          $furniture_term_name = is_a($furniture_term, 'Wp_term') ? $furniture_term->name : '';
        } else {
          return;
        }  
        
        //Страница архива таксономии
        $term = get_queried_object();

        if ($term && is_a($term, 'WP_term')) {
          $term_parents_list = get_term_parents_list($term->term_id, $taxonomy, ['format'=>'slug', 'link'=>false]);

          if ($term_parents_list && !is_wp_error($term_parents_list)) {
            $term_parent_top_slug = explode('/', $term_parents_list)[0];

            if ($term_parent_top_slug) {
              $term_parent_top = get_term_by('slug', $term_parent_top_slug, $taxonomy);

              if ($term_parent_top && is_a($term_parent_top, 'WP_Term')) {
                if ($term_parent_top->term_id === $products_term_id) {
                  $products_term_id = $term->term_id;
                }

                if ($term_parent_top->term_id === $furniture_term_id) {
                  $furniture_term_id = $term->term_id;
                }
              }              
            }
          }
        }

        $products_terms_children = get_terms( array(
          'taxonomy' => $taxonomy,
          'hide_empty' => false,
          'parent'   => $products_term_id
        ) );

        if ( $products_terms_children && !empty($products_terms_children) && is_array($products_terms_children) && !is_wp_error($products_terms_children) ) {
          ?>
            <h3><?= $products_term_name; ?></h3>
            <ul>
              <?php
                foreach ($products_terms_children as $key => $products_terms_child) {            
                  ?>
                    <li><a href="<?= get_term_link( $products_terms_child, $taxonomy ); ?>"><?= $products_terms_child->name ?? ''; ?></a></li>          
                  <?php                  
                }
              ?>
            </ul>            
          <?php          
        }

        // Оборудование
        $furniture_terms_children = get_terms( array(
          'taxonomy' => $taxonomy,
          'hide_empty' => false,
          'parent'   => $furniture_term_id
        ) );

        if ( $furniture_terms_children && !empty($furniture_terms_children) && is_array($furniture_terms_children) && !is_wp_error($furniture_terms_children) ) {
          ?>
            <h3><?= $furniture_term_name; ?></h3>
            <ul>
              <?php
                foreach ($furniture_terms_children as $key => $furniture_terms_child) {            
                  ?>
                    <li><a href="<?= get_term_link( $furniture_terms_child, $taxonomy ); ?>"><?= $furniture_terms_child->name ?? ''; ?></a></li>          
                  <?php                  
                }
              ?>
            </ul>            
          <?php          
        }
      ?>
      <h2>Товары:</h2>
      <?php 
        if ( have_posts() ) :
          ?>
            <ul class="latest__cards">                
              <?php 
                while ( have_posts() ) : the_post();
                  // get_template_part( 'templates/post', 'card' );
                  the_title(  );
                  echo '<br />';
                endwhile;
              ?>
            </ul>

            <div class="latest__pagination">
              <?php 
                $args = array(
                  'show_all'     => false, // показаны все страницы участвующие в пагинации
                  'end_size'     => 3,     // количество страниц на концах
                  'mid_size'     => 3,     // количество страниц вокруг текущей
                  'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                  'prev_text'    => '<span class="visually-hidden">' . __('Previous') . '</span>',
                  'next_text'    => '<span class="visually-hidden">' . __('Next') . '</span>',
                  'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                  'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
                  'screen_reader_text' => __( 'Posts navigation' ),
                  'class'        => 'pagination', // CSS класс, добавлено в 5.5.0.
                );
                
                the_posts_pagination( $args ); 
              ?>
            </div>
          <?php          
        else :
            _e( 'Sorry, no posts were found.', 'ateam' );
        endif;
      ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
