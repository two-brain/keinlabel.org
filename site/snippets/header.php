<!DOCTYPE html>
<html class="no-js" lang="de">

  <?php snippet('head') ?>

  <body class="template-<?= $page->template() ?>">
    <header class="header">
      <div class="container">
        <div class="level is-mobile">
          <div class="level-left">
            <div class="navbar-item">
              <a class="" href="/">
                <?php $keinlogo = (new Asset('assets/images/keinlogo.png'))->resize(130); ?>
                <img src="<?= $keinlogo->url() ?>" alt="Logo von keinLabel" width="<?= $keinlogo->width() ?>" height="<?= $keinlogo->height() ?>">
              </a>
            </div>
          </div>
          <div class="level-right">
            <?php snippet('shared/social') ?>
            <div class="navbar-item">
              <a class="button is-primary is-uppercase has-text-weight-semibold" href="<?= $site->shop() ?>" target="_blank">
                <span>zum Shop</span>
                <svg class="icon provider-icon">
                  <use xlink:href="assets/images/icons.svg#shopping-cart"></use>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>
