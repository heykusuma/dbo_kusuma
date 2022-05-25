<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Eloquent\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Order::class;
    }   

}
