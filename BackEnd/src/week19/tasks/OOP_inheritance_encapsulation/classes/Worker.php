<?php

// Sukurkite klasę Worker, kuri paveldės User klasę ir įneš papildomą viešai neprienamą savybę salary ir viešai prieinamus metodus getSalary ir setSalary.

class Worker extends User 
{
    protected float $salary;

    public function setSalary($salary) : void
    {
        $this->salary = $salary;
    }

    public function getSalary() : float
    {
        return $this->salary;
    }
}