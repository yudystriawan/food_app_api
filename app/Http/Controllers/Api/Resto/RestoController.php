<?php

namespace App\Http\Controllers\Api\Resto;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Resto;
use Illuminate\Http\Request;

class RestoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restos = Resto::has('foods')->get();

        return $this->showAll($restos);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function show(Resto $resto)
    {
        $result = $resto->has('foods')->findOrFail($resto->id);
        
        return $this->showOne($result);
    }
}
