<?php

namespace App\Http\Controllers\Api\Resto;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Resto;
use Illuminate\Http\Request;

class RestoTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Resto $resto)
    {
        $transactions = $resto->foods()
        ->whereHas('transactions')
        ->with('transactions')
        ->get()
        ->pluck('transactions')
        ->collapse();

        return $this->showAll($transactions);
    }
}
