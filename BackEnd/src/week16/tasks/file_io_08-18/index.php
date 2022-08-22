<?php

$csvFilePath = 'excelFile.csv';
$apiUrl = 'https://randomuser.me/api/';

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

try {
    $data = json_decode(file_get_contents($apiUrl), true);

    if (isset($data) && array_key_exists('results', $data)) {
        $flatData = [];
        $headerSaved = false;

        foreach ($data['results'] as $line) {
            $flatData[] = flatten($line);
        }

        $file = fopen($csvFilePath, 'w');

        foreach ($flatData as $line) {
            if (!$headerSaved) {
                fputcsv($file, array_keys($line));
                $headerSaved = true;
            }

            fputcsv($file, array_values($line));
        }

        fclose($file);

        echo "Info from '{$apiUrl}' saved to '{$csvFilePath}'";
        exit;
    } else {
        throw new Exception('Problems with receiving data.');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
