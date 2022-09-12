<?php

// Sukurkite klasę Driver, kuri paveldėtų Worker klasę ir įneštų papildomas savybes: vairavimo patirtis, vairavimo kategorija (A, B, C).

class Driver extends Worker
{
    private int $expInYears;
    private string $drivingCategory;

    public function setExperience($expInYears): void
    {
        $this->expInYears = $expInYears;
    }

    public function setDrivingCategory($drivingCategory): void
    {
        $this->drivingCategory = $drivingCategory;
    }

    public function getExperience(): int
    {
        return $this->expInYears;
    }

    public function getDrivingCategory(): string
    {
        return $this->drivingCategory;
    }
}