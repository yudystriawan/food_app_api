<?php

namespace App\Http\Controllers\Api\Food;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodCustomerTransactionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Food $food, Customer $customer)
    {
        if ($customer->id == $food->resto_id) {
            return $this->errorResponse('The customer account must be different from the resto account', 409);
        }

        if (!$customer->isVerified()) {
            return $this->errorResponse('The customer must be a verified user', 409);
        }
        
        if (!$food->resto->isVerified()) {
            return $this->errorResponse('The resto must be a verified user', 409);
        }
    }
}
