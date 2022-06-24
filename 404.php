<?php
  get_header(  );
?>

<main class="main">
  <section class="section fatal">
    <div class="container fatal__container">
      <span class="fatal__number">404</span>
      <h1 class="fatal__title"><?= __( 'Страница не найдена', 'osnova' ); ?></h1>
      <p class="fatal__text">
        <?= __( 'Возможно вы ошиблись в адресе или страница перемещена или удалена. Вы можете вернуться на главную.', 'osnova' ); ?>
      </p>

      <a href="<?= get_bloginfo( 'url' ); ?>" class="fatal__btn"><?= __( 'на главную', 'osnova' ); ?></a>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
