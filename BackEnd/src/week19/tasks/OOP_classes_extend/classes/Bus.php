<?php

class Bus extends Vehicle
{
    public function __construct(protected string $make, protected string $model, protected string $year, protected ?int $wheels) 
    {
        parent::__construct($make, $model, $year, $wheels);
    }

    public function getFuelType(): array
    {
        return [2, 3];
    }
}