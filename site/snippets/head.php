<?php
  $seoTitle = $page->seoTitle();
  $pageTitle = $page->title();
  $title = $page->seoTitle()->isNotEmpty()
    ? $seoTitle
    : $pageTitle;
  $title = $title->html() . ' | keinLabel'
?>

<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <meta name="description" content="<?= $page->seoDescription() ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">

   <!-- SEO -->
  <link rel="canonical" href="<?= $page->url() ?>">

  <!-- Facebook -->
  <meta property="og:locale" content="<?= $site->language()->locale() ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $title ?>">
  <meta property="og:description" content="<?= $page->seoDescription() ?>">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:site_name" content="<?= $title ?>">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?= $title ?>">

  <?php
    if (option('isLive') === true) {
      echo Bnomei\Fingerprint::css('/assets/styles/main.min.css', ['integrity' => true]);
    } else {
      echo css('assets/styles/main.css');
    }
  ?>
  <?= $page->htmlhead_snippets() ?>

  <meta name="theme-color" content="#9f9f9f">

  <?php snippet('shared/matomo') ?>
</head>
