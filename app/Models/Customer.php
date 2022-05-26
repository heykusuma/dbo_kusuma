<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function searchableAs()
    {
        return 'custmomers_index';
    }

    public function toSearchableArray()
    {
        return [
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'address'       => $this->address,
            'phone_number'  => $this->phone_number
        ];
    }

}
