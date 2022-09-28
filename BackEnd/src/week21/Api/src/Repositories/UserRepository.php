<?php

namespace App\Repositories;

class UserRepository extends BaseRepository
{
    const PATH = ROOT_PATH . '/data/users.json';

    protected $name = 'User';
}