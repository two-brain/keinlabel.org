<ul id="social-icons" class="social-icons list-reset">
  <?php foreach ($socials as $social) : ?>
  <li class="item navbar-item">
    <a class="" href="<?= $social->link() ?>" title="<?= $page->title()->html() ?> auf <?= $providers[$social->provider()->value()] ?>" target="_blank">
      <svg class="icon is-medium">
        <use xlink:href="assets/images/icons.svg#<?= $social->provider() ?>"></use>
      </svg>
    </a>
  </li>
  <?php endforeach ?>
</ul>
