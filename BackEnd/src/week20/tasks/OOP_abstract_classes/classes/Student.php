<?php

class Student extends Person 
{
    public function greetings(): string
    {
        return sprintf("Hello, I'm %s.", $this->getName());
    }
}