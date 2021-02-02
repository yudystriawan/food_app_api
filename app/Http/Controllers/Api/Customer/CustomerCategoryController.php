<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerCategoryController extends ApiController
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        $categories = $customer->transactions()
        ->with('food.categories')
        ->get()
        ->pluck('food.categories')
        ->collapse()
        ->unique('id')
        ->values();

        return $this->showAll($categories);
    }
}
