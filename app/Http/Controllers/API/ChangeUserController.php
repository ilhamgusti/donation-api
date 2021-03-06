<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Transformers\UserTransformer;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChangeUserController extends Controller
{
    public function index(ChangeUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = UserTransformer::toInstance($request->validated(), User::findOrFail($request->user()->id));
            $user->save();
            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }

        return (new UserResource($user))
            ->additional([
                'meta' => [
                    'success' => true,
                    'message' => "User Updated"
                ]
            ]);
    }
}
