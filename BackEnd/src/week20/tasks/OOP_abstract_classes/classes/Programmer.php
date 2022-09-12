<?php

class Programmer extends Person 
{
    public function greetings(): string
    {
        return sprintf("Hello world! I'm %s.", $this->getName());
    }
}