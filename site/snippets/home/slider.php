<section class="hero">
  <div class="hero-body is-paddingless">
    <div class="slider-container" style="position: relative">
      <div class="hero-slider">
        <?php
          foreach ($slides as $slide) :
          $background = $slide->background()->toFile();
          $item = $slide->product()->toFile()->crop('256');
          $type = $slide->link()->yaml()['type'];
          $link = $slide->link()->yaml()['link'];

          if($type == 'page') {
            if($pagelink = page($link)) {
              $link = $pagelink->url();
            }
          }
        ?>
        <<?php e($link == '', 'div', 'a href="' . $link . '"') ?> class="hero-slide has-text-shadow" style="background-image: url('<?= $background->thumb('slider')->url() ?>')">
          <div class="container">
            <div class="columns">
              <div class="column is-narrow">
                <figure class="has-text-centered" role="group">
                  <img src="<?= $item->url(); ?>" alt="" width="<?= $item->width() ?>" height="<?= $item->height() ?>">
                </figure>
              </div>
              <div class="column has-text-centered-mobile">
                <div class="is-uppercase has-text-left has-text-centered-mobile">
                  <p class="title is-2 has-text-white">
                    <?= $slide->title()->html() ?>
                  </p>
                  <p class="subtitle is-4 has-text-white">
                    <?= $slide->text()->html() ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        <?php e($link == '', '</div>', '</a>') ?>
        <?php endforeach ?>
      </div>
      <div class="hero-controls">
        <?php foreach ($slides as $slide) : ?>
        <button class="button is-primary" title="<?= $slide->title()->html() ?>"></button>
        <?php endforeach ?>
      </div>
    </div>
  </div>
  <div class="hero-foot"></div>
</section>
