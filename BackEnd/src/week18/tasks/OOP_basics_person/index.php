<?php

require_once 'classes/Person.php';

$persons = [
    new Person('Vardenis1', 'Pavardenis1', 1),
    new Person('Vardenis2', 'Pavardenis2', 2),
    new Person('Vardenis3', 'Pavardenis3', 3),
];

foreach ($persons as $person) {
    echo sprintf("Vardas: %s, pavardė: %s, amžius: %d\n", $person->getFirstName(), $person->getLastName(), $person->getAge());
}