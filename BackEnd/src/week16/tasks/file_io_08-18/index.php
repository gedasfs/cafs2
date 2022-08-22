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

$csvFilePath = 'users.csv';
$apiUrl = 'https://randomuser.me/api/';

try {
    $data = file_get_contents($apiUrl);

    if (!$data) {
        throw new Exception('Data fetching failed.');
    }

    $data = json_decode($data, true);

    if (isset($data) && array_key_exists('results', $data)) {
        $headersSaved = false;

        $file = fopen($csvFilePath, 'a+');
        $fileData = fgetcsv($file);

        if (is_array($fileData) && in_array('#headers', $fileData)) {
            $headersSaved = true;
        }

        foreach ($data['results'] as $line) {
            $flatData = flatten($line);
            $flatData['#saved'] = date('Y-m-d H:i:s');
            $flatData['#headers'] = '#data';

            if (!$headersSaved) {
                fputcsv($file, array_keys($flatData));
                $headersSaved = true;
            }

            fputcsv($file, array_values($flatData));
        }

        fclose($file);

        echo "Info from '{$apiUrl}' saved to '{$csvFilePath}'";

    } else {
        throw new Exception('No data.');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
