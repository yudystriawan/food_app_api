<?php

namespace App\Traits;

use GrahamCampbell\ResultType\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {

        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $tranformer = $collection->first()->transformer;

        $collection = $this->filterData($collection, $tranformer);
        $collection = $this->sortData($collection, $tranformer);
        $collection = $this->paginate($collection);
        $collection = $this->transformData($collection, $tranformer);

        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {
        $transformer = $instance->transformer;

        $instance = $this->transformData($instance, $transformer);

        return $this->successResponse($instance, $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function filterData(Collection $collection, $transformer)
    {
        foreach (request()->query() as $query => $value) {
            if ($query != 'sort_by' && $query != 'page') {
                $attribute = $transformer::originalAttribute($query);

                $collection = $collection->where($attribute, $value);
            }
        }

        return $collection;
    }

    protected function sortData(Collection $collection, $transformer)
    {
        if (request()->has('sort_by')) {
            $attribute = $transformer::originalAttribute(request()->sort_by);

            $collection = $collection->sortBy->{$attribute};
        }

        return $collection;
    }

    protected function paginate(Collection $collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }

    protected function transformData($data, $transformer)
    {
        $newCollection = fractal($data, new $transformer)->toArray();

        return $newCollection;
    }
}
