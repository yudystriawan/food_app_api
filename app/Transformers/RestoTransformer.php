<?php

namespace App\Transformers;

use App\Models\Resto;
use League\Fractal\TransformerAbstract;

class RestoTransformer extends TransformerAbstract
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
    public function transform(Resto $resto)
    {
        return [
            'id' => $resto->id,
            'restoName' => $resto->name,
            'email' => $resto->email,
            'isVerified' => (int) $resto->verified,
            'address' => $resto->address,
            'houseNumber' => $resto->house_number,
            'phoneNumber' => $resto->phone_number,
            'city' => $resto->city,
            'image' => $resto->profile_photo_url,
            'creationDate' => (string) $resto->created_at,
            'lastChange' => (string) $resto->updated_at,
            'deletedDate' => isset($resto->deleted_at) ? (string) $resto->deleted_at : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'restoName' => 'name',
            'isVerified' => 'verified',
            'houseNumber' => 'house_number',
            'phoneNumber' => 'phone_number',
            'image' => 'profile_photo_url',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : $index;
    }
}
