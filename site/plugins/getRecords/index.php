<?php

Kirby::plugin('keinLabel/getRecords', [
  'pagesMethods' => [
    'getRecords' => function ($musician, $type = '') {
        $records = $this->filter(function($child) use($musician, $type) {
          $artists = $child->artists()->toPages();
          $producer = $child->producer()->toPage();

          if($type === 'raps') {
            if ($artists->has($musician)) {
              return $child;
            }
          }

          if($type === 'instrumentals') {
            if ($producer == $musician) {
              return $child;
            }
          }

          if($type === '') {
            if ($artists->has($musician) || $producer == $musician) {
              return $child;
            }
          }
      });

      return $records;
    }
  ]
]);
