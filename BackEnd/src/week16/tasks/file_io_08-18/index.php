<?php
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

function writeCsvToFile($fileRes, $content) {
    $result = fputcsv($fileRes, $content);

    if (!$result) {
        throw new Exception('Failed to write to file.');
    }
}

$csvFilePath = 'users.csv';
$apiUrl = 'https://randomuser.me/api/';

try {
    $apiData = file_get_contents($apiUrl);

    if (!$apiData) {
        throw new Exception('Data fetching failed.');
    }

    $apiData = json_decode($apiData, true);

    if (isset($apiData) && array_key_exists('results', $apiData)) {
        $headersSaved = false;

        $file = fopen($csvFilePath, 'a+');
        $fileData = fgetcsv($file);

        if (is_array($fileData) && in_array('#headers', $fileData)) {
            $headersSaved = true;
        }

        foreach ($apiData['results'] as $line) {
            $flatApiData = flatten($line);
            $flatApiData['#saved'] = date('Y-m-d H:i:s');
            $flatApiData['#headers'] = '#data';

            if (!$headersSaved) {
                writeCsvToFile($file, array_keys($flatApiData));
                $headersSaved = true;
            }

            writeCsvToFile($file, array_values($flatApiData));
        }

        fclose($file);

        echo "Info from '{$apiUrl}' saved to '{$csvFilePath}'";

    } else {
        throw new Exception('No data.');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
