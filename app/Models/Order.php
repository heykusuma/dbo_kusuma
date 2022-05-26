<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, Searchable;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function searchableAs()
    {
        return 'orders_index';
    }

    public function toSearchableArray()
    {
        return [
            'customer_id'    => $this->customer_id,
            'order_date'     => $this->order_date,
            'total_cost'     => $this->total_cost
        ];
    }

}
