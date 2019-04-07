<?php

return [
  # General thumbnail settings
  'driver' => 'im',
  'quality'   => 85,
  'interlace' => true,

  # Thumbnail presets
  'presets' => [
    'home' => [
      'width' => 648,
      'height' => 432,
      'crop' => true,
    ],
    'hero' => [
      'width' => 1280,
      'height' => 768,
      'crop' => true,
      'grayscale' => true,
    ],
    'hero--launch' => [
      'width' => 1280,
      'height' => 768,
      'crop' => true,
    ],
    'slider' => [
      'width' => 1280,
      'height' => 768,
      'crop' => true,
    ],
    'cover' => [
      'width' => 200,
      'height' => 200,
      'crop' => true,
    ],
    'launch' => [
      'width' => 300,
      'height' => 300,
      'crop' => true,
    ],
  ],
];
