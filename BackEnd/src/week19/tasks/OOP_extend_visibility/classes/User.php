<?php

class User
{   
    protected string $createdAt;

    function __construct(
        protected string $firstname, 
        protected string $lastname
    )
    {
        $this->createdAt = time();
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getCreatedTime(): int
    {
        return $this->createdAt;
    }

    public function getCreatedTimeFormated(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, $this->createdAt);
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstname(), $this->getLastname());
    }
}