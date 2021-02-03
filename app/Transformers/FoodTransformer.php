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
            'name' => $food->name,
            'description' => $food->description,
            'ingredients' => $food->ingredients, 
            'price' => $food->price, 
            'rating' => $food->rate, 
            'situtation' => $food->status, 
            'picture' => $food->image,
            'resto' => $food->resto_id,
            'creationDate' => (string) $food->created_at,
            'lastChange' => (string) $food->updated_at,
            'deletedDate' => isset($food->deleted_at) ? (string) $food->deleted_at : null,
        ];
    }
}
