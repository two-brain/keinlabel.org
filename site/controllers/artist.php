<?php

return function($site, $pages, $page) {
  
  // Teaser image
  $teaser = $page->teaser()->toFile();

  // Available providers
  $providers = $page->blueprint()->field('socials')['fields']['provider']['options'];

  // Social Media channels
  $socials = $page->socials()->toStructure()->sortBy('provider', 'asc');

  // Releases
  $releases = $page->getRecords();
  $raps = $page->getRecords('raps');
  $instrumentals = $page->getRecords('instrumentals');

  return compact(
    'teaser',
    'providers',
    'socials',
    'releases',
    'raps',
    'instrumentals'
  );
};
