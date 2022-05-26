<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function getModel(): string
    {
        return User::class;
    }   

}
