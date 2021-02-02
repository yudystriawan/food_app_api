<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRestoController extends ApiController
{
    /**
     * Display a listing of the resto on specific category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $restos = $category->foods->with('resto')
        ->get()
        ->pluck('resto')
        ->unique()
        ->values();

        return $this->showOne($restos);


    }
}
