<?php
// Paveldėjimas + Inkapsuliacija [PHP]
// Sukurkite klasę User su viešai neprienamom savybėm: name, age ir viešai prieinamais metodas: setName, getName, setAge, getAge.
// Sukurkite klasę Worker, kuri paveldės User klasę ir įneš papildomą viešai neprienamą savybę salary ir viešai prieinamus metodus getSalary ir setSalary.
// Sukurkite klasę Student, kuri paveldės User klasę ir įneš papildomas viešais neprienamas savybes stipendija, kursas bei jiems reikalingus metodus
// Sukurkite klasę Driver, kuri paveldėtų Worker klasę ir įneštų papildomas savybes: vairavimo patirtis, vairavimo kategorija (A, B, C).
// Sukurkite vieną studentą ir viena vairuotoją ir užduokite jiems visas reikiamas savybes. Vardą ir amžių nustatykite sukurimo metu

spl_autoload_register(function ($className) {
    $classPath = sprintf('%s/classes/%s.php', dirname(__DIR__), $className);

    if (file_exists($classPath)) {
        require_once $classPath;
    } else {
        throw new Exception('Class file not found', 1);
    }
});

try {
    $student = new Student('Mark', 25);
    $student->setScholarship(400);
    $student->setCourse(3);

    $driver = new Driver('John', 40);
    $driver->setExperience(20);
    $driver->setDrivingCategory('B');
    $driver->setSalary(800);

    var_dump($student);
    var_dump($driver);
} catch (Exception $e) {
    echo sprintf('Error: "%s", (%s)', $e->getMessage(), $e->getCode());
}