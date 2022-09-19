<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Classes\Tag;

$tagA = new Tag('a');

$tagA->setText('title')->setAttr('href', 'index.html')->show();
echo "\n\n";
echo $tagA->setText('text2')->setAttr('href', 'index2.html')->setAttr('target', '_blank')->get();