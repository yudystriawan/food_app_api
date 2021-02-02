<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerFoodController extends ApiController
{
    /**
     * Display a listing foods on specific customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        $foods = $customer->transactions()->with('food')
        ->get()
        ->pluck('food');

        return $this->showAll($foods);
    }
}
