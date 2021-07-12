<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ParticipantScore extends Model
{
    use HasFactory;

    protected $fillable =[
        'participant_id',
        'kemuhammadiyahan',
        'imm',
        'tauhid',
        'ibadah',
        'bta'
    ];
}
