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

/**
 * @OA\Info(
 *      title="API de Usuários",
 *      version="1.0.0",
 *      description="API para gerenciamento de usuários",
 *      @OA\Contact(
 *          email="admin@example.com",
 *          name="Equipe de Desenvolvimento"
 *      )
 * )
 */
class UserController extends Controller
{
    public function __construct(protected UserServiceInterface $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="address_id", type="integer"),
     *                 @OA\Property(property="address", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="street", type="string"),
     *                     @OA\Property(property="number", type="string"),
     *                     @OA\Property(property="complement", type="string", nullable=true),
     *                     @OA\Property(property="neighborhood", type="string"),
     *                     @OA\Property(property="city_id", type="integer"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(property="city", type="object",
     *                         @OA\Property(property="id", type="integer"),
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(property="state_id", type="integer"),
     *                         @OA\Property(property="created_at", type="string", format="date-time"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time"),
     *                         @OA\Property(property="state", type="object",
     *                             @OA\Property(property="id", type="integer"),
     *                             @OA\Property(property="name", type="string"),
     *                             @OA\Property(property="created_at", type="string", format="date-time"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        return new UserCollection($this->service->findAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create a new user",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\JsonContent(
     *             required={"name","email","address"},
     *             @OA\Property(property="name", type="string", example="Pedro Silva"),
     *             @OA\Property(property="email", type="string", format="email", example="pedrosilva@test.com"),
     *             @OA\Property(property="address", type="object",
     *                 @OA\Property(property="street", type="string", example="Rua Projetada"),
     *                 @OA\Property(property="number", type="string", example="100"),
     *                 @OA\Property(property="complement", type="string", nullable=true),
     *                 @OA\Property(property="neighborhood", type="string", example="Kennedy"),
     *                 @OA\Property(property="city", type="object",
     *                     @OA\Property(property="name", type="string", example="Itaperuna"),
     *                     @OA\Property(property="state", type="object",
     *                         @OA\Property(property="name", type="string", example="RJ")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string", format="email"),
     *                 @OA\Property(property="address_id", type="integer"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="address", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="street", type="string"),
     *                     @OA\Property(property="number", type="string"),
     *                     @OA\Property(property="complement", type="string", nullable=true),
     *                     @OA\Property(property="neighborhood", type="string"),
     *                     @OA\Property(property="city_id", type="integer"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(property="city", type="object",
     *                         @OA\Property(property="id", type="integer"),
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(property="state_id", type="integer"),
     *                         @OA\Property(property="created_at", type="string", format="date-time"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time"),
     *                         @OA\Property(property="state", type="object",
     *                             @OA\Property(property="id", type="integer"),
     *                             @OA\Property(property="name", type="string"),
     *                             @OA\Property(property="created_at", type="string", format="date-time"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.street", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.number", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.neighborhood", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.city.name", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.city.state.name", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
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
            return $this->errorResponse($validator->errors(), 422);
        }

        $dto = UserDtoFactory::makeFromArray($validator->safe()->all());
        return new UserResource($this->service->new($dto));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Get a specific user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string", format="email"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="address_id", type="integer"),
     *                 @OA\Property(property="address", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="street", type="string"),
     *                     @OA\Property(property="number", type="string"),
     *                     @OA\Property(property="complement", type="string", nullable=true),
     *                     @OA\Property(property="neighborhood", type="string"),
     *                     @OA\Property(property="city_id", type="integer"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(property="city", type="object",
     *                         @OA\Property(property="id", type="integer"),
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(property="state_id", type="integer"),
     *                         @OA\Property(property="created_at", type="string", format="date-time"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time"),
     *                         @OA\Property(property="state", type="object",
     *                             @OA\Property(property="id", type="integer"),
     *                             @OA\Property(property="name", type="string"),
     *                             @OA\Property(property="created_at", type="string", format="date-time"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User not found.")
     *         )
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show(int $id)
    {
        return new UserResource($this->service->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Update a specific user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated user data",
     *         @OA\JsonContent(
     *             required={"name","email","address"},
     *             @OA\Property(property="name", type="string", example="New Name"),
     *             @OA\Property(property="email", type="string", format="email", example="newemail@test.com"),
     *             @OA\Property(property="address", type="object",
     *                 @OA\Property(property="street", type="string", example="New Street"),
     *                 @OA\Property(property="number", type="string", example="200"),
     *                 @OA\Property(property="complement", type="string", nullable=true, example="New Complement"),
     *                 @OA\Property(property="neighborhood", type="string", example="New Neighborhood"),
     *                 @OA\Property(property="city", type="object",
     *                     @OA\Property(property="name", type="string", example="New City"),
     *                     @OA\Property(property="state", type="object",
     *                         @OA\Property(property="name", type="string", example="NY")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string", format="email"),
     *                 @OA\Property(property="address_id", type="integer"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="address", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="street", type="string"),
     *                     @OA\Property(property="number", type="string"),
     *                     @OA\Property(property="complement", type="string", nullable=true),
     *                     @OA\Property(property="neighborhood", type="string"),
     *                     @OA\Property(property="city_id", type="integer"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(property="city", type="object",
     *                         @OA\Property(property="id", type="integer"),
     *                         @OA\Property(property="name", type="string"),
     *                         @OA\Property(property="state_id", type="integer"),
     *                         @OA\Property(property="created_at", type="string", format="date-time"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time"),
     *                         @OA\Property(property="state", type="object",
     *                             @OA\Property(property="id", type="integer"),
     *                             @OA\Property(property="name", type="string"),
     *                             @OA\Property(property="created_at", type="string", format="date-time"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.street", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.number", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.neighborhood", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.city.name", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="address.city.state.name", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Delete a specific user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User successfully deleted",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="message", type="string", example="User successfully deleted.")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User not found.")
     *         )
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
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
