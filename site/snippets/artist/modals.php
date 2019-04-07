<?php
  foreach ($releases as $release) :

  // Linking modals
  $slug = str::slug($release->title());

  // Fetching archive
  $archive = $release->download()->toFile();
  $size = $archive
    ? '<span class="is-size-5 has-text-grey-light">(' . $archive->niceSize() . ')</span>'
    : '';
?>
<div class="modal" data-modal="<?= $slug ?>">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head has-text-centered">
      <p class="modal-card-title"><?= $release->title() ?> (<?= $release->type() ?>) (<?= $release->year() ?>) <?= $size ?></p>
      <button class="delete" aria-label="close"></button>
    </header>
    <?php if ($hasText = $release->text()->isNotEmpty()) : ?>
    <section class="modal-card-body">
      <div class="content is-size-5">
        <?= $release->text()->kt() ?>
      </div>
    </section>
    <?php endif ?>
    <footer class="modal-card-<?php e($hasText, 'foot', 'body') ?>">
      <?php snippet('shared/buttons', ['release' => $release]) ?>
    </footer>
  </div>
</div>
<?php endforeach ?>
