<?php

// Abstraction PHP
// Sukurkite abstrakčią klasę Person, kuri priimtų konstruktoriuje vardą ir turetų abstrakų metodą greetings
// Sukurkite klasę Programmer, kuri paveldės Person klasę.
// Sukurkite klasę Student, kuri paveldės Person klasę.
// Sukurkite klasę Teacher, kuri paveldės Person klasę.
// Išveskite sveikinimą, atitinkanti kievienai klasei. Pvz. programuotojas sveikinasi: "Hello world! I'm Kiril", studentas: "Hello, I'm Kiril", o mokytojas: "Hello students, I'm Kiril".

require_once dirname(__DIR__) . '/autoloader.php';

$persons = [
    new Programmer('John'),
    new Student('Jane'),
    new Teacher('Mark'),
];

foreach ($persons as $person) {
    echo sprintf("%s<br>\n", $person->greetings());
}