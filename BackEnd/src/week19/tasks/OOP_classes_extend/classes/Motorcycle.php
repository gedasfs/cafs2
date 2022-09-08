<?php

class Motorcycle extends Vehicle
{
    public function __construct(protected string $make, protected string $model, protected string $year, protected ?int $wheels) 
    {
        parent::__construct($make, $model, $year);
    }

    public function getFuelType(): array
    {
        return [1, 2];
    }
}