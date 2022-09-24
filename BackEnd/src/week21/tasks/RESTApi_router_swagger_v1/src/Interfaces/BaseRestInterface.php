<?php

namespace App\Interfaces;

interface BaseRestInterface
{
    public function retrieve();

    public function create();

    public function update();

    public function delete();
}