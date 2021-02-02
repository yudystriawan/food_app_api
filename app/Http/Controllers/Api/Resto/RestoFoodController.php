<?php

namespace App\Http\Controllers\Api\Resto;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Resto;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RestoFoodController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Resto $resto)
    {
        $foods = $resto->foods;

        return $this->showAll($foods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $resto)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048',
        ]);

        $data = $request->all();

        $data['status'] = Food::UNAVAILABLE;
        $data['rate'] = 0.0;
        $data['image'] = '1.jpg';
        $data['resto_id'] = $resto->id;

        $food = Food::create($data);

        return $this->showOne($food, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resto $resto, Food $food)
    {
        $request->validate([
            'status' => 'in:' . Food::AVAILABLE . ',' . Food::UNAVAILABLE,
            'image' => 'image|max:2048',
            'price' => 'integer'
        ]);

        $this->checkResto($resto, $food);

        $food->fill($request->only([
            'name',
            'description',
            'ingredients',
            'price',
            'status',
            'image',
        ]));

        if ($food->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 420);
        }

        $food->save();

        return $this->showOne($food);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resto $resto, Food $food)
    {
        $this->checkResto($resto, $food);

        $food->delete();

        return $this->showOne($food);
    }

    // Check the resto own the food
    protected function checkResto(Resto $resto, Food $food)
    {
        if ($resto->id != $food->resto_id) {
            throw new HttpException(422, 'The specified resto is not the actual resto of the food');
        }
    }
}
