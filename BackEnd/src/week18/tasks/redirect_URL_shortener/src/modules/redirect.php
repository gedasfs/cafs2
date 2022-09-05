<?php

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
echo time() . '<br>';
echo 'diff: ' . (time() - $_SESSION['firstRequestTime'])/60 . '<br>';