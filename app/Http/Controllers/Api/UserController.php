<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    public function index(): Collection
    {
        return User::with('winnerUser')->get();
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'points' => $data['points'],
        ], $data);

        $user->save();

        return response()->json(['message' => 'User added successfully'],200);
    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'first_name' => 'string|max:60',
            'last_name' => 'string|max:60',
            'email' => 'string|max:60|email|unique:users',
            'password' => 'string|min:6|max:60',
            'points' => 'integer|max:10000',
        ]);

        $user = auth()->user();

        DB::beginTransaction();

        try {

            if (!empty($data['first_name'])) $user->update(['first_name' => $data['first_name']]);
            if (!empty($data['last_name'])) $user->update(['last_name' => $data['last_name']]);
            if (!empty($data['email'])) $user->update(['email' => $data['email']]);
            if (!empty($data['password'])) $user->update(['password' => $data['password']]);
            if (!empty($data['points'])) $user->update(['points' => $data['points']]);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $user->save();

        return response()->json(['message' => 'User data changed successfully'],200);
    }

    public function delete()
    {
        $user = auth()->user();

        $user->delete();

        return response()->json(['message' => 'User deleted'],200);
    }
}
