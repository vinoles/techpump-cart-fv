<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The list of attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'phone', 'address', 'city', 'state',
        'postal_code', 'country', 'shipping_address', 'shipping_email',
        'shipping_note', 'discounted', 'subtotal', 'total', 'user_id',
    ];

    /**
     * Relationship with the order items table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this
            ->hasMany(OrderItem::class)
            ->orderBy('id');
    }
}
