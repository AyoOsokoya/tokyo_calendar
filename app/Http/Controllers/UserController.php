<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\Users\Actions\UserActionCreate;
use App\Domains\Users\Actions\UserActionDelete;
use App\Domains\Users\Models\User;
use App\Enums\EnumHttpResponseStatusCode;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function user(User $user): JsonResponse
    {
        return response()->json([
            $user,
        ], EnumHttpResponseStatusCode::OK->value);
    }

    public function createUser(UserCreateRequest $request): JsonResponse
    {
        // TODO: if Auth User is Admin, allow creation of any user type
        UserActionCreate::make(
            $request->validated()
        )->execute();

        return response()->json([
            'message' => 'User created successfully',
        ], EnumHttpResponseStatusCode::CREATED->value);
    }

    public function updateUser(): void
    {
        // Validate User Data
        // return appropriate error if validation fails
        // Update user
        // return appropriate error if save fails
        // Return OK status code
    }

    public function deleteUser(User $user): JsonResponse
    {
        // TODO: Check permissions
        UserActionDelete::make(
            $user
        )->execute();

        // self delete or admin delete is okay
        // return appropriate error if delete fails
        // Return OK status code
        return response()->json([
            'message' => 'User deleted successfully',
        ], EnumHttpResponseStatusCode::OK->value);
    }
}
