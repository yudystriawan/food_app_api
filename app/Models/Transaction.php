<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    const PENDING = 'pending';
    const CANCELED = 'canceled';
    const DELIVERED = 'delivered';
    const ON_DELIVERY = 'on delivery';

    protected $fillable = [
        'quantity',
        'total',
        'status',
        'customer_id',
        'food_id',
    ];

    public function isPending()
    {
        return $this->status == Transaction::PENDING;
    }

    public function isCanceled()
    {
        return $this->status == Transaction::CANCELED;
    }

    public function isDelivered()
    {
        return $this->status == Transaction::DELIVERED;
    }

    public function isOnDelivery()
    {
        return $this->status == Transaction::ON_DELIVERY;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

}
