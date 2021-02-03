<?php

namespace App\Models;

use App\Transformers\CustomerTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends User
{
    use HasFactory;

    public $transformer = CustomerTransformer::class;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
