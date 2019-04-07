<?php

return [
  # Thumbnails
  'thumbs' => require_once 'thumbs.php',

  # Routes / Redirects
  'routes' => require_once 'routes.php',

  'sitemap.ignore' => ['error'],

  'sylvainjule.matomo.url'        => 'https://analytics.keinlabel.org/',
  'sylvainjule.matomo.id'         => '1',
  'sylvainjule.matomo.token'      => 'e37437962f37a4da9be8196bfb179ddc',


  // 'bnomei.htmlhead.seo' => false,
  // 'bnomei.htmlhead.opengraph' => false,
  // 'bnomei.htmlhead.snippets' => ['shared/matomo'],
  // 'bnomei.htmlhead.a11ycss.debugOnly' => true,
  // 'bnomei.htmlhead.css' => [
  //   '/assets/styles/main.css',
  // ],
  // 'bnomei.htmlhead.js' => [
  //   '/assets/scripts/main.js',
  // ],
  'bnomei.htmlhead.webfontloader' =>
    "google: {
        families: ['Titillium Web']
    }",

  // 'bnomei.htmlhead.loadjs' => [
  //   '*' => [ // fallback
  //       'te"mplate' => [], // all templates
  //       'dependencies' => [
  //         '/assets/scripts/main.js',
  //         '/assets/styles/main.css', // css too!
  //       ],
  //   ],
  // ],
  'bnomei.fingerprint.hash' => function ($file) {
    $url = null;
    $fileroot = is_a($file, 'Kirby\Cms\File') || is_a($file, 'Kirby\Cms\FileVersion') ? $file->root() : kirby()->roots()->index() . DIRECTORY_SEPARATOR . ltrim(str_replace(kirby()->site()->url(), '', $file), '/');

    if (\Kirby\Toolkit\F::exists($fileroot)) {
      $filename = implode('.', [
        \Kirby\Toolkit\F::name($fileroot),
        \filemtime($fileroot),
        \Kirby\Toolkit\F::extension($fileroot)
      ]);

      if (is_a($file, 'Kirby\Cms\File') || is_a($file, 'Kirby\Cms\FileVersion')) {
        $url = str_replace($file->filename(), $filename, $file->url());
      } else {
        $dirname = str_replace(kirby()->roots()->index(), '', \dirname($fileroot));
        $url = ($dirname === '.') ? $filename : ($dirname . '/' . $filename);
      }
    } else {
      $url = $file;
    }
    return \url($url);
  },
];
