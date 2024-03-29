<?php

abstract class Person {
    public function __construct(private string $name)
    {

    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function greetings(): string;
}