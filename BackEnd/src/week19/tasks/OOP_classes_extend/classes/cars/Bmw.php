<?php 

class Bmw extends Car
{
    public function __construct(protected string $model, protected string $year, protected ?int $wheels) 
    {
        parent::__construct('BMW', $model, $year, $wheels);
    }
}