<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\State;
use App\Services\Contracts\StateServiceInterface;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct(protected StateServiceInterface $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection($this->service->findAll());
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
        return new UserResource($this->service->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        //
    }
}
