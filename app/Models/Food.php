<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    const AVAILABLE = 'available';
    const UNAVAILABLE = 'unavailable';

    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'price',
        'rate',
        'status',
        'image',
        'resto_id',
    ];

    public function isAvailable()
    {
        return $this->status == Food::AVAILABLE;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function resto()
    {
        return $this->belongsTo(Resto::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
