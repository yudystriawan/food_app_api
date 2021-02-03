<?php

namespace App\Models;

use App\Transformers\RestoTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resto extends User
{
    use HasFactory;

    public $transformer = RestoTransformer::class;

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

}
