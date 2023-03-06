<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreUserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): Collection
    {
        return User::with('winnerMatches')->get();
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

        return $user;
    }

    public function update(StoreUserUpdateRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        if (!empty($data['first_name'])) {
            if ($data['first_name'] !== $user->getFirstName()) {
                $user->setFirstName($data['first_name']);
            }
        }

        if (!empty($data['last_name'])) {
            if ($data['last_name'] !== $user->getLastName()) {
                $user->setLastName($data['last_name']);
            }
        }

        if (!empty($data['email'])) {
            if ($data['email'] !== $user->getEmail()) {
                $user->setEmail($data['email']);
            }
        }

        if (!empty($data['password'])) {
            if ($data['password'] !== $user->getPassword()) {
                $user->setPassword(Hash::make($data['password']));
            }
        }

        if (!empty($data['points'])) {
            if ($data['points'] !== $user->getPoints()) {
                $user->setPoints($data['points']);
            }
        }

        $user->update();

        $user->save();

        return $user;
    }

    public function delete()
    {
        $user = auth()->user();

        $user->delete();

        return response()->json(['message' => 'User deleted'],200);
    }
}
