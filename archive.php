<?php
  get_header(  );
?>

<main class="main">
  <section class="section">
    <div class="container">     
      <?php 
        get_template_part( 'templates/catalog', 'category' );

        get_template_part( 'templates/catalog', 'products' );
      ?>   
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
