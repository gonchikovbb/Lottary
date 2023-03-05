<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LotteryGameMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'start_date',
        'start_time',
        'winner_id',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(LotteryGame::class,'game_id','id');
    }

    public function winnerUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'winner_id','id');
    }
}
