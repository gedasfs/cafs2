<?php

$excelFilePath = 'excelFile.csv';
$data = json_decode(file_get_contents('https://randomuser.me/api/'), true)['results'][0];

// https://stackoverflow.com/questions/526556/how-to-flatten-a-multi-dimensional-array-to-simple-one-in-php
function flatten($array, $prefix = '') {
    $result = [];

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, flatten($value, $prefix . $key . '.'));
        } else {
            $result[$prefix . $key] = $value;
        }
    }

    return $result;
}

$data = flatten($data);

$file = fopen($excelFilePath, 'w');
fputcsv($file, array_keys($data));
fputcsv($file, array_values($data));
fclose($file);

// var_dump($data);

