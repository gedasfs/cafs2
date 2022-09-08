<?php

class Boat extends Vehicle
{
    public function getWheelsNumberText(): string
    {
        return sprintf('Are you serious?');
    }

    public function getType(): string
    {
        return 'Cruiser';
    }

    public function getFuelType(): array
    {
        return [2];
    }
}