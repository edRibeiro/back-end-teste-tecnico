<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Services\Contracts\CityServiceInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(protected CityServiceInterface $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CityCollection($this->service->findAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new CityResource($this->service->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
