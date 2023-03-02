<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LotteryGameMatch;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DataCollector\TimeDataCollector;

class LotteryGameMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $game_id = $request['game_id'];
        $start_date = $request['start_date'];
        $start_time = $request['start_time'];

        if ($start_date < date('Y-m-d'))
            return response()->json(['message' => 'Match start date cannot be before now!'], 200);

        $match = LotteryGameMatch::create([
            'game_id' => $game_id,
            'start_date' => $start_date,
            'start_time' => $start_time,
        ]);

        $match->save();

        return response()->json(['message' => 'Match created!'],200);
    }

    public function endOfTheMatch(Request $request)
    {
        $game_id = $request['game_id'];

        $match = json_decode(LotteryGameMatch::query()->where('game_id', '=', $game_id)->get(),true);

        $id = $match['0']['id'];

        $match = LotteryGameMatch::query()->find($id);

        $match->update([
            'winner_id' => $request['winner_id'],
        ]);

        $match->save();

        return response()->json(['message' => 'Congratulations!'],200);
    }

    public function show($game_id)
    {
        return LotteryGameMatch::query()->where('game_id', '=', $game_id)->get();
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
