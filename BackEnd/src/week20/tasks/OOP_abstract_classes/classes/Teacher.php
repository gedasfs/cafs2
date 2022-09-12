<?php

class Teacher extends Person 
{
    public function greetings(): string
    {
        return sprintf("Hello students, I'm %s.", $this->getName());
    }
}