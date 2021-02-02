<?php

namespace App\Http\Controllers\Api\Resto;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Resto;
use Illuminate\Http\Request;

class RestoCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Resto $resto)
    {
        $customers = $resto->foods()
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
