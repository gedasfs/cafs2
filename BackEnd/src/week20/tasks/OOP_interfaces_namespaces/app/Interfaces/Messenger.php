<?php

namespace Interfaces;

interface Messenger
{
    public function send(string $sendTo, string $body);
}