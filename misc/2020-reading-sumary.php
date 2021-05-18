<?php

$libFile = "/home/wesley/projects/whurdwfd.github.io/_data/library.yaml";

$library = yaml_parse_file($libFile);

$filtered = [];
$pages = [];
$noPages = [];
$noTime = [];
foreach ($library as $item) {
  if (isset($item['read_when']) && is_array($item['read_when']) && count ($item['read_when']) > 0) {
    foreach ($item['read_when'] as $date) {
      if (substr($date,0, 4) == '2020') {
        $filtered[] = $item;
        if (!empty($item['pages'])) {
          $pages[] = $item['pages'];
        } else {
          $noPages[] = $item;
        }

        if (empty($item['took'])) {
          $noTime[] = $item;
        }
        break 1;
      }
    }
  }
}

$totalpages = array_sum($pages);

$avg = $totalpages / count($pages);

foreach ($filtered as $book) {
  echo "{$book['title']} by {$book['authors']}\n";
}

$test = '';