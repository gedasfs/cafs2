<?php

/**
 * Parašyti PHP klasę, kuri parašytų “Sveiki, mano vardas yra {vardas}”,
 * kur {vardas} būtų metodo argumento vertė klasės viduje
 */

class User {
    public $userName;

    function __construct(string $username) {
        $this->userName = $username;
    }

    public function sayHello(): void {
        echo sprintf('Sveiki, mano vardas yra %s.', $this->userName);
    }
}