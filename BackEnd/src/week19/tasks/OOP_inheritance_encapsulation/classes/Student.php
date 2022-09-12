<?php

// Sukurkite klasę Student, kuri paveldės User klasę ir įneš papildomas viešais neprienamas savybes stipendija, kursas bei jiems reikalingus metodus

class Student extends User
{
    private float $scholarship;
    private string $courseName;

    public function setScholarship($scholarship): void 
    {
        $this->scholarship = $scholarship;
    }

    public function setCourseName($courseName): void 
    {
        $this->courseName = $courseName;
    }

    public function getScholarship(): float 
    {
        return $this->scholarship;
    }

    public function getCourseName(): string 
    {
        return $this->courseName;
    }
}