<?php if ($page == page('defcon')) : ?>
<h2 class="title has-text-centered"><?= $title ?></h2>
<?php endif ?>
<div class="columns is-mobile is-centered is-multiline has-text-centered">
  <?php
    foreach ($releases as $release) :
    $slug = str::slug($release->title());
    $cover = $release->cover()->toFile();
    $image = $cover->thumb('cover');
  ?>
  <div data-philter-grayscale="100 0" class="column is-narrow">
    <a class="modal-toggle" data-toggle="<?= $slug ?>" href="#">
      <img src="<?= $image->url() ?>" title="<?= $release->title() ?>" alt="Cover von <?= $release->title() ?>" width="<?= $image->width(); ?>" height="<?= $image->height() ?>">
    </a>
  </div>
  <?php endforeach ?>
</div>
