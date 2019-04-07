<?php snippet('header') ?>

<?php snippet('shared/hero', ['teaser' => $teaser]) ?>

<section id="about" class="section is-medium">
  <div class="container is-narrow">
    <div class="content is-size-4 has-text-centered">
      <h1><?= $page->title()->html() ?></h1>
      <?= $page->text()->kt() ?>
    </div>
  </div>
</section>

<section id="downloads" class="section is-medium">
  <div class="container">
    <?php
      if($raps->isNotEmpty()) {
        snippet('artist/releases', ['title' => 'Raps', 'releases' => $raps]);
      }

      if($instrumentals->isNotEmpty()) {
        snippet('artist/releases', ['title' => 'Instrumentals', 'releases' => $instrumentals]);
      }
    ?>
  </div>
</section>

<section id="social-media" class="section social">
  <?php snippet('artist/socials', ['socials' => $socials]) ?>
</section>

<?php if ($page->video()->isNotEmpty()) : ?>
<section id="featured-video" class="section is-medium">
  <div class="container is-narrow">
    <div class="content">
      <div class="embed embed-for-wxh-75">
        <iframe
          src="https://www.youtube.com/embed/videoseries?list=<?= $page->video() ?>"
          frameborder="0"
          allow="autoplay; encrypted-media"
          allowfullscreen
          width="960"
          height="480"
        >
        </iframe>
      </div>
    </div>
  </div>
</section>
<?php endif ?>

<section id="modals">
  <?php snippet('artist/modals', ['releases' => $releases, 'providers' => $providers]) ?>
</section>

<?php snippet('footer') ?>
