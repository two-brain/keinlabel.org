<?php

return function($site, $pages, $page) {

  return [
    'slides' => $page->slider()->toStructure(),
    'artists' => $site->children()->filterBy('intendedTemplate', 'artist'),
  ];
};
