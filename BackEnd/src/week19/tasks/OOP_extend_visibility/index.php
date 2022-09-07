<?php

// Sukurkite klasę Student, kuri paveldės User klasę ir 
// įneš papildomas viešai neprienamas savybes: 
// stipendija ir kursas bei jiems reikalingus metodus.

require_once 'classes/User.php';
require_once 'classes/Student.php';

$student1 = new Student(
    lastname: 'Pavardenis', 
    firstname: 'Vardenis', 
    scholarship: 250, 
    courseNames: ['Computer Science', 'Algorithms', 'Cyber Security']
);

echo sprintf(
    "Student %s (created %s) attends courses:<br>\n %s.", 
    $student1->getFullName(), 
    $student1->getCreatedTimeFormated('y-m-d'), 
    $student1->getCourseNamesAsStr()
);