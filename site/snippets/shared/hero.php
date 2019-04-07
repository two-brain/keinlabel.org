<?php
  $style = $page->intendedTemplate() == 'launch' ? 'hero--launch' : 'hero';
?>

<section id="hero" class="hero">
  <div class="hero-image" style="background-image: url('<?= $teaser->thumb($style)->url() ?>')"></div>
  <div class="hero-foot"></div>
</section>
