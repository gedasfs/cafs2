# Method chaining PHP

Parašykyte HTML tag'ų generatorių su galimybe iškviesti iš eilės kelis metodus.
 
```php
<?php

$tag = new Tag('a');
 
$tag->setText('title')->setAttr('href', 'index.html')->show();
// prints <a href="index.html">title</a>
$tag->setText('text')->setAttr('href', 'index.html')->get();
// return <a href="index.html">text</a>
```