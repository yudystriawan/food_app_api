<?php

namespace App\Transformers;

use App\Models\Customer;
use League\Fractal\TransformerAbstract;

class CustomerTransformer extends TransformerAbstract
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
    public function transform(Customer $customer)
    {
        return [
            'id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'isVerified' => (int) $customer->verified,
            'address' => $customer->address,
            'houseNumber' => $customer->house_number,
            'phoneNumber' => $customer->phone_number,
            'city' => $customer->city,
            'image' => $customer->profile_photo_url,
            'creationDate' => (string) $customer->created_at,
            'lastChange' => (string) $customer->updated_at,
            'deletedDate' => isset($customer->deleted_at) ? (string) $customer->deleted_at : null,
        ];
    }
}
