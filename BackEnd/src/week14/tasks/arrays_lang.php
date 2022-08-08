<?php
// Sukurkite dvimatį masyvą. Pirmieji du raktai yra lt ir en.
// Raktai turi savaitės dienų vardų masyvus lietuviškai ir angliškai.
// Naudodamiesi šiuo masyvu, pirmadienį parodykite lietuvių kalba, o trečiadienį - anglų kalba.
// Parodikite dabartinės dienos pavadinimą
// Sukurkite kintamuosius lang (reikšmės lt arba en) ir parodykite dieną

$weekDays = [
    'lt' => ['Pirmadienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis', 'Sekmadienis'],
    'en' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
];

$newIndexes = range(1, 7);

// foreach ($weekDays as &$days) {
//     $days = array_combine($newIndexes, $days);
// }

foreach ($weekDays as $lang => $days) {
    $weekDays[$lang] = array_combine($newIndexes, $days);
}

var_dump($weekDays);

$day1 = 1;
$day3 = 3;
$langEn = 'en';
$langLt = 'lt';

echo "lt day {$day1}: {$weekDays[$langLt][$day1]}, en day {$day3}: {$weekDays[$langEn][$day3]}<br>\n";

$currDay = date('N');
echo "Current day name: in lt -> {$weekDays[$langLt][$currDay]}, in en -> {$weekDays[$langEn][$currDay]}<br>\n";
