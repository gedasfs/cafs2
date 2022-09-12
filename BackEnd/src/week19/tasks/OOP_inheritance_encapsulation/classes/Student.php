<?php

// Sukurkite klasę Student, kuri paveldės User klasę ir įneš papildomas viešais neprienamas savybes stipendija, kursas bei jiems reikalingus metodus

class Student extends User
{
    private float $scholarship;
    private int $course;

    public function setScholarship($scholarship): void 
    {
        $this->scholarship = $scholarship;
    }

    public function setCourse($course): void 
    {
        $this->course = $course;
    }

    public function getScholarship(): float 
    {
        return $this->scholarship;
    }

    public function getCourse(): string 
    {
        return $this->course;
    }
}