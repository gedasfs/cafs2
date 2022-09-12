<?php

// Sukurkite klasę User su viešai neprienamom savybėm: name, age ir viešai prieinamais metodas: setName, getName, setAge, getAge.

class User 
{
    private string $name;
    private int $age;

    public function __construct($name, $age)
    {
        $this->setName($name);
        $this->setAge($age);
    }

    public function setName($name): void 
    {
        $this->name = $name;
    }

    public function setAge($age): void 
    {
        $this->age = $age;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function getAge(): int 
    {
        return $this->age;
    }
}