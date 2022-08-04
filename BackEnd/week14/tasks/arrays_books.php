<?php
// Sukurti masyvą, kuris aprašytų knygos duomenis: title, author, year, genre
$singleBook = [
    'title' => 'The Hotel Nantucket',
    'author' => 'Elin Hilderbrand',
    'year' => 2022,
    'genre' => 'Fiction'
];

// Sukurti masyvą, kurio elementai būtų masyvai aprašantys knygas. Minimum 3.
$books = [
    $singleBook,
    [
        'title' => 'Dissapearing Earth',
        'author' => 'Julia Philips',
        'year' => 2019,
        'genre' => 'Fiction'
    ],
    [
        'title' => 'Empire of Cotton: A Global History',
        'author' => 'Sven Beckert',
        'year' => 2015,
        'genre' => 'Non Fiction'
    ],
];

// Išvesti visus knygų masyvo elementus su var_dump;
var_dump($books);

// Išvesti visų visų knygų metų vidurkį;
$yearAverage = array_sum(array_column($books, 'year')) / count($books);
$yearAverage = number_format($yearAverage, 2);
echo "Books year average: {$yearAverage}";
