    <footer class="section has-background-light">
      <div class="container">
        <div class="level">
          <div class="level-left">
            <div class="navbar-item">
              &copy; <?= date('Y') ?> <?= $site->title()->html() ?>
            </div>
            <?php snippet('shared/social') ?>
          </div>
          <div class="level-right">
            <a class="navbar-item" href="<?= url('datenschutz') ?>">Datenschutz</a>
            <a class="navbar-item" href="<?= url('impressum') ?>">Impressum</a>
          </div>
        </div>
      </div>
    </footer>

    <?php
      if (option('isLive') === true) {
        echo Bnomei\Fingerprint::js('/assets/scripts/main.min.js', ['integrity' => true]);
      } else {
        echo js('assets/scripts/main.js');
      }
    ?>

  </body>
</html>
