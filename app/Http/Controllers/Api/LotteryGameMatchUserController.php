<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordRequest;
use App\Models\LotteryGameMatchUser;

class LotteryGameMatchUserController extends Controller
{
    public function playerRecord(StoreRecordRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        $userId = $user->getId();
//print_r($data);die;
        $lotteryGameMatchId = $data['lottery_game_match_id'];


        $record = LotteryGameMatchUser::create([
            'user_id' => $userId,
            'lottery_game_match_id' => $lotteryGameMatchId,
        ]);

        $record->save();

        return $record;
    }
}
