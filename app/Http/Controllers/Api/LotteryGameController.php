<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LotteryGame;

class LotteryGameController extends Controller
{
    public function index()
    {
        return LotteryGame::with('gameMatches')->get();
    }
}
