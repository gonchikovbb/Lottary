<?php

namespace App\Http\Controllers\Api;

use App\Events\MatchUserEvent;
use App\Events\MatchUsersFullEvent;
use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatchUser;
use Illuminate\Http\Request;

class LotteryGameMatchUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function playerRecord(Request $request)
    {
        $user = auth()->user();
        $userId = $user['id'];
        $lotteryGameMatchId = $request['lottery_game_match_id'];

        MatchUserEvent::dispatch($userId, $lotteryGameMatchId);
        MatchUsersFullEvent::dispatch($lotteryGameMatchId);

        $record = LotteryGameMatchUser::create([
            'user_id' => $userId,
            'lottery_game_match_id' => $lotteryGameMatchId,
        ]);

        $record->save();

        return response()->json(['message' => 'Good Lack'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
