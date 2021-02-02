<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryFoodController extends ApiController
{
    /**
     * Display a listing of the food on specific category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $foods = $category->foods;

        return $this->showAll($foods);
    }
}
