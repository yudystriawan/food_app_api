<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resto extends User
{
    use HasFactory;

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

}
