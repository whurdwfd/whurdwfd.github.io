<?php

$libFile = "/home/wesley/projects/whurdwfd.github.io/_data/library.yaml";

$library = yaml_parse_file($libFile);

foreach ($library as $book) {
  if (empty($book['loaned_to'])) {
    continue;
  }
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

  echo "{$book['loaned_to']}: {$book['title']} by {$styledAuthor}\n";
}

$test = '';