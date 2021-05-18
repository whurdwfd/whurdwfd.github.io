<?php

$libFile = "/home/wesley/projects/whurdwfd.github.io/_data/library.yaml";

$library = yaml_parse_file($libFile);

$filtered = [];
$pages = [];
$noPages = [];
$noTime = [];
foreach ($library as $item) {
  if (isset($item['own']) && $item['own'] == 1) {
    $filtered[] = $item;
    if (!empty($item['pages'])) {
      $pages[] = $item['pages'];
    } else {
      $noPages[] = $item;
    }
  }
}

$totalpages = array_sum($pages);

$avg = $totalpages / count($pages);

foreach ($filtered as $book) {
  $authors = [];
  $styledAuthor = '';
  if (is_array($book['authors'])) {
    foreach ($book['authors'] as $author) {
      $authParts = explode(', ', $author);
      $authors[] = $authParts[1] . ' ' . $authParts[0];
    }
    $styledAuthor = implode(' and ', $authors);
  } else {
    foreach (explode(';', $book['authors']) as $author) {
      $authParts = explode(', ', $author);
      if (count($authParts) >= 2)  {
        $authors[] = $authParts[1] . ' ' . $authParts[0];
      } else {
        $authors[] = $authParts[0];
      }

    }
    $styledAuthor = implode(' and ', $authors);
  }

  echo "{$book['title']} by {$styledAuthor}\n";
}

$test = '';