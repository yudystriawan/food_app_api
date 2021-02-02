<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class CustomerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        $transactions = $customer->transactions;

        return $this->showAll($transactions);
    }
}
