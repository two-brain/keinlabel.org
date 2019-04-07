<?php snippet('header') ?>

<?php snippet('home/slider') ?>

<section class="section artists">
  <div class="container">
    <div class="columns is-multiline is-variable is-6">
      <?php
        foreach ($artists as $artist) :
        $image = $artist->thumb()->toFile()->thumb('home');
      ?>
      <div class="column is-half">
        <a href="<?= url($artist) ?>">
          <figure data-philter-grayscale="100 0" class="image">
            <img src="<?= $image->url(); ?>" alt="<?= $artist->title()->html() ?>" width="<?= $image->width(); ?>" height="<?= $image->height(); ?>">
            <div class="artist is-overlay">
              <h4 class="is-size-1 has-text-white has-text-weight-semibold has-text-shadow">
                <?= $artist->title()->html() ?>
              </h4>
            </div>
          </figure>
        </a>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
