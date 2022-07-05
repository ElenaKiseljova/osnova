<?php 
  $type = get_sub_field( 'type' ) ?? '';

  $video_id = get_sub_field( 'video_id' ) ?? '';
  $video_file = get_sub_field( 'video_file' ) ?? '';
  $video_banner = get_sub_field( 'video_banner' ) ?? '';

  $src = '';
?>
<div class="article__video">
  <div class="video">
    <?php if ( $type === 'vimeo' ) : 
      $src = 'https://player.vimeo.com/video/' . $video_id . '?h=e4d417a182&autoplay=1&color=7b42e9&title=0&byline=0&portrait=0&playsinline=1';
      ?>
      <div class="video__iframe">
        <div style="padding:62.5% 0 0 0;position:relative;">
          <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    <?php elseif( $type === 'youtube' ) : 
      $src = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=1&playsinline=1';
      ?>
      <div class="video__iframe">
        <iframe
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
    <?php elseif( $type === 'file' ) : ?>
      <video class="video__file" controls playsinline>
        <source src="<?= $video_file; ?>" type="video/mp4" />
      </video>
    <?php endif; ?>

    <div class="video__img" <?= ($type !== 'file') ? 'data-src="' . $src . '"' : ''; ?>">
      <?php if ( !empty($video_banner) ) : ?>
        <img src="<?= $video_banner; ?>" alt="<?= get_bloginfo( 'name' ); ?>" />
      <?php endif; ?>
      
      <button class="video__btn">
        <svg width="100" height="100">
          <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#play"></use>
        </svg>
      </button>
    </div>
  </div>
</div>