<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComparisonMatrix extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'kemuh',
        'imm',
        'tauhid',
        'ibadah',
        'bta',
    ];
}
