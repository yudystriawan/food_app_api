<?php

namespace App\Http\Controllers\Api\Food;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Food $food)
    {
        $transactions = $food->transactions;

        return $this->showAll($transactions);
    }
}
