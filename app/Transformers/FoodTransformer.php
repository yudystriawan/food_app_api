<?php

namespace App\Transformers;

use App\Models\Food;
use League\Fractal\TransformerAbstract;

class FoodTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Food $food)
    {
        return [
            'id' => $food->id,
            'foodName' => $food->name,
            'description' => $food->description,
            'ingredients' => $food->ingredients, 
            'price' => $food->price, 
            'rating' => $food->rate, 
            'situation' => $food->status, 
            'picture' => $food->image,
            'resto' => $food->resto_id,
            'creationDate' => (string) $food->created_at,
            'lastChange' => (string) $food->updated_at,
            'deletedDate' => isset($food->deleted_at) ? (string) $food->deleted_at : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'foodName' => 'name',
            'rating' => 'rate', 
            'situation' => 'status', 
            'picture' => 'image',
            'resto' => 'resto_id',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
