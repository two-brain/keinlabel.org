<?php snippet('header') ?>

<section class="section">
  <div class="container">
    <div class="content">
      <h1>
        <?= $page->title()->html() ?>
      </h1>
      <?= $page->text()->kt() ?>
    </div>
  </div>
</section>

<?php snippet('footer') ?>
