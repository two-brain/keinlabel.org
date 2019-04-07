<div class="buttons<?php e($page->intendedTemplate() == 'artist', ' is-centered') ?>">
  <?php
    $archive = $release->download()->toFile();
    $hosts = $release->hosts()->toStructure();

    if ($page->intendedTemplate() == 'launch') {
      // Available providers
      $providers = $release->blueprint()->field('hosts')['fields']['provider']['options'];
    }

    foreach ($hosts as $host) :
    $provider = $host->provider()->value();
  ?>
  <a class="button is-primary is-medium is-rounded" href="<?= $host->link() ?>" title="Download auf <?= $providers[$provider] ?>" target="_blank">
    <svg class="icon provider-icon has-text-white">
      <use xlink:href="assets/images/icons.svg#<?= $provider ?>"></use>
    </svg>
    <span><?= $providers[$provider] ?></span>
  </a>
  <?php endforeach ?>
  <?php if ($archive) : ?>
  <a class="button is-primary is-medium is-rounded" href="<?= $archive->url() ?>" title="Direkt vom Erzeuger" target="_blank">
    <svg class="icon provider-icon has-text-white">
      <use xlink:href="assets/images/icons.svg#file-archive"></use>
    </svg>
    <span>Direktdownload</span>
  </a>
  <?php endif ?>
  <?php if ($release->shop()->isNotEmpty()) : ?>
  <a class="button is-primary is-medium is-rounded" href="<?= $release->shop() ?>" title="Direkt vom Erzeuger" target="_blank">
    <svg class="icon provider-icon has-text-white">
      <use xlink:href="assets/images/icons.svg#shopping-cart"></use>
    </svg>
    <span>keinLabel-Shop</span>
  </a>
  <?php endif ?>
</div>
