<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatchValidationRequest;
use App\Models\LotteryGameMatch;
use Illuminate\Http\Request;

class LotteryGameMatchController extends Controller
{
    public function create(StoreMatchValidationRequest $request)
    {
        $data = $request->validated();

        $match = LotteryGameMatch::create([
            'game_id' => $data['game_id'],
            'start_date' => $data['start_date'],
            'start_time' => $data['start_time'],
        ]);

        $match->save();

        return $match;
    }

    public function update(Request $request)
    {
        $match = LotteryGameMatch::query()->find($request['id']);

        if (!$match['is_finished']) {
            $match['is_finished'] = true;
            $match->save();
        }

        return $match['winner_id'];
    }

    public function show($gameId)
    {
        return LotteryGameMatch::query()->where('game_id', '=', $gameId)->get();
    }
}
