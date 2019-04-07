<?php

use Kirby\Cms\Page;

class ArtistPage extends Page {
  function getRecords($type = '') {
    return site()->find('releases')->children()->getRecords($this, $type)->sortBy('year', 'desc');
  }
}
