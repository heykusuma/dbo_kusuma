<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Eloquent\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Customer::class;
    }   

}
