<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Classes\Tag;

$tagA = new Tag('a');

$tagA->setText('title')->setAttr('href', 'index.html')->show();
echo "\n<br>";
echo $tagA->setText('text2')->setAttr('href', 'index2.html')->setAttr('target', '_blank')->get();
echo "\n\n<br><br>";

$form = new Tag('form');
$formBody = (new Tag('label'))->setText('Label: name')->setAttr('id', 'name')->get();
$formBody .= "\n<br>";
$formBody .= (new Tag('input'))->setAttr('type', 'text')->setAttr('name', 'name')->setAttr('id', 'name')->setAttr('placeholder', 'your name')->get();
$formBody .= "\n<br>";
$formBody .= (new Tag('button'))->setAttr('type', 'submit')->setText('Go')->get();
$form->setAttr('method', 'POST')->setAttr('action', 'index.php')->setText($formBody);
$form->show();
echo "\n<br>";
