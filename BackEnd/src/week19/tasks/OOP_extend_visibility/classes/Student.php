<?php

class Student extends User
{
    function __construct(
        protected string $firstname, 
        protected string $lastname, 
        private int $scholarship, 
        private array $courseNames
    )
    {
        parent::__construct($firstname, $lastname);
    }

    public function getScholarship(): string
    {
        return $this->scholarship;
    }

    private function getCourseNames(): array
    {
        return $this->courseNames;
    }

    public function getCourseNamesAsStr(): string
    {
        return implode(', ', $this->getCourseNames());
    }
}