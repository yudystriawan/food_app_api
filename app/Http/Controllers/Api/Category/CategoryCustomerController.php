<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryCustomerController extends ApiController
{
    /**
     * Display a listing of the customer on specific category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $customers = $category->foods()
        ->whereHas('transactions')
        ->with('transactions.customer')
        ->get()
        ->pluck('transactions')
        ->collapse()
        ->pluck('customer')
        ->unique('id')
        ->values();

        return $this->showAll($customers);
    }
}
