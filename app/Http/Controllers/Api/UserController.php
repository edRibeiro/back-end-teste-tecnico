<?php

namespace App\Http\Controllers\Api;

use App\Dtos\UserDtoFactory;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public function __construct(protected UserServiceInterface $service)
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'address.street' => 'required',
            'address.number' => 'required',
            'address.complement' => 'nullable|string',
            'address.neighborhood' => 'required',
            'address.city.name' => 'required',
            'address.city.state.name' => 'required|max:2',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator, 422);
        }

        $dto = UserDtoFactory::makeFromArray($validator->safe()->all());
        return new UserResource($this->service->new($dto));
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
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'address.street' => 'required',
            'address.number' => 'required',
            'address.complement' => 'nullable|string',
            'address.neighborhood' => 'required',
            'address.city.name' => 'required',
            'address.city.state.name' => 'required|max:2',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $dto = UserDtoFactory::makeFromArray($validator->safe()->all());
        return new UserResource($this->service->update($dto, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);
        } catch (NotFoundHttpException $th) {
            return $this->errorResponse(Response::$statusTexts[Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
        }
        return response()->json(['data' => ["message" => "User successfully deleted."]], Response::HTTP_OK);
    }
}
