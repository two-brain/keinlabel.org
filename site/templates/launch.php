<?php snippet('header') ?>

<?php snippet('shared/hero', ['teaser' => $teaser]) ?>

<?php
  $launch = $page->release()->toPage();
  $cover = $launch->cover()->toFile();
  $image = $cover->thumb('launch');
?>

<section id="about" class="section is-medium">
  <div class="container is-narrow">
    <div class="content is-size-4 has-text-centered">
      <h1><?= $page->title()->html() ?></h1>
      <?= $launch->text()->kt() ?>
    </div>
  </div>
</section>

<section id="out-now" class="section is-medium">
  <div class="container">
    <div class="columns">
      <div class="column is-half-tablet is-one-third-desktop has-text-centered">
        <figure class="image is-inline-block is-300x300">
          <img src="<?= $image->url() ?>" title="<?= $launch->title() ?> - zum Download oder im Stream" alt="Cover von <?= $launch->title() ?>" width="<?= $image->width(); ?>" height="<?= $image->height() ?>">
          <strong class="tag is-secondary is-large">Neu!</strong>
        </figure>
      </div>
      <div class="column is-half-tablet is-two-thirds-desktop">
        <h2 class="title has-text-centered has-text-left-tablet">
          <?php e($page->subtitle()->isNotEmpty(), $page->subtitle()->html(), $page->title()->html() . ' gibt\'s hier:') ?>
        </h2>
        <?php snippet('shared/buttons', ['release' => $launch]) ?>
      </div>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
