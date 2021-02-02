<?php

namespace App\Http\Controllers\Api\Food;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Food $food)
    {
        $buyers = $food->transactions()
            ->with('customer')
            ->get()
            ->pluck('customer')
            ->unique('id')
            ->values();

        return $this->showAll($buyers);
    }
}
