<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatchUser;
use Illuminate\Http\Request;

class LotteryGameMatchUserController extends Controller
{
    public function playerRecord(Request $request)
    {
        $user = auth()->user();
        $userId = $user->getId();
        $lotteryGameMatchId = $request['lottery_game_match_id'];

        $record = LotteryGameMatchUser::create([
            'user_id' => $userId,
            'lottery_game_match_id' => $lotteryGameMatchId,
        ]);

        $record->save();

        return $record;
    }
}
