<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerRestoController extends ApiController
{
    /**
     * Display a listing of the resto.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        $restos = $customer->transactions()->with('food.resto')
        ->get()
        ->pluck('food.resto')
        ->unique('id')
        ->values();

        return $this->showAll($restos);
    }
}
