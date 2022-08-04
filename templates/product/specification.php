<?php 
  $title = get_sub_field( 'title' ) ?? '';
  $list = get_sub_field( 'list' ) ?? [];
?>

<?php if (!empty($list) && is_array($list) && !is_wp_error( $list )) : ?>
  <section class="section specification">
    <div class="container specification__container">
      <h2 class="specification__title title"><?= $title; ?></h2>
    
      <ul class="products__list products__list--specification">
        <?php foreach ($list as $key => $item) : ?>
          <?php 
            $name = $item['title'] ?? '';  
            $description = $item['description'] ?? '';  
          ?>
          <li class="products__item products__item--specification">
            <div class="products__accordion products__accordion--specification">
              <h3 class="products__heading products__heading--specification"><?= $name; ?></h3>
              <button class="products__btn products__btn--specification">
                <svg class="products__icon products__icon--specification" fill="none">
                  <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#accordion-btn"></use>
                </svg>
              </button>
            </div>
            <div class="products__content products__content--specification">
              <p class="products__text"><?= $description; ?></p>
            </div>
          </li>
        <?php endforeach; ?>        
      </ul> 
    </div>
  </section>
<?php endif; ?>
