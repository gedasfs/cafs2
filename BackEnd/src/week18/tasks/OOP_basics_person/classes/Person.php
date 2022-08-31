<?php

/*
 * Sukurti klasę Person, kuri turėtų atributus vardas, pavarde, amzius ir 
 * sukurti tris skirtingus tos klasės objektus.
*/

class Person {

    public $firstName;
    public $lastName;
    public $age;

    function __construct(string $firstname, string $lastname, int $age)
    {
        $this->setFirstName($firstname);
        $this->setLastName($lastname);
        $this->setAge($age);
    }

    public function setFirstName($firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName): void {
        $this->lastName = $lastName;
    }

    public function setAge($age): void {
        $this->age = $age;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getAge(): int {
        return $this->age;
    }
}