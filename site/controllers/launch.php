<?php

return function($site, $pages, $page) {

  // Teaser image
  $teaser = $page->teaser()->toFile();

  return compact(
    'teaser'
  );

};
