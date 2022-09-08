<?php

class Vehicle
{   

    protected ?int $wheels = null;

    public function __construct(protected string $make, protected string $model, protected string $year) 
    {

    }

    public function setWheelsNumber(int $wheels): void
    {
        $this->wheels=$wheels;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getIntroduction(): string
    {
        return sprintf('%s %s', $this->getMake(), $this->getModel());
    }

    public function getFullYear(): int
    {
        return date('Y');
    }

    public function getAge(): int
    {
        return $this->getFullYear() - $this->year;
    }

    public function getAgeText(): string
    {
        if ($this->getAge() <= 10) {
            return '10 years or newer.';
        } else {
            return '11 years or older';
        }
    }

    public function getWheelsNumber(): int 
    {
        return $this->wheels;
    }

    public function getWheelsNumberText(): string
    {
        return sprintf('This %s has %d wheels.', static::class, $this->getWheelsNumber());
    }

    public function getFuelType()
    {
        throw new Exception('Fuel type not found', 1);
    }

}