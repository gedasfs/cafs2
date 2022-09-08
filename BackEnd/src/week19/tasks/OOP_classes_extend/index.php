<?php

// Perrašykite JS klases į PHP ir išveskite visą informaciją apie transporto priemones.

require_once 'classes/Vehicle.php';
require_once 'classes/Plane.php';
require_once 'classes/Motorcycle.php';
require_once 'classes/Car.php';
require_once 'classes/Bus.php';
require_once 'classes/Boat.php';
require_once 'classes/cars/Bmw.php';

$vehicles = [
    new Plane('Boeing', '777', 1995, 6),
    new Motorcycle('Suzuki', 'Katana', 1980, 2),
    new Car('Audi', 'A6', 2018, 4),
    new Bmw('i4', 2018, 4),
    new Bus('Toyota', 'Hiace', 2022, 4),
    new Boat('Sea Fox', 'Commander 368', 2020),
];

foreach ($vehicles as $vehicle) {
    echo sprintf("%s, age: %s, wheels: %s<br>\n", $vehicle->getIntroduction(), $vehicle->getAgeText(), $vehicle->getWheelsNumberText());
}