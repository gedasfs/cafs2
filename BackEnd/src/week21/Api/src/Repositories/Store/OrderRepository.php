<?php

namespace App\Repositories\Store;

use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    const PATH = ROOT_PATH . '/data/store/orders.json';

    protected $name = 'Order';
}