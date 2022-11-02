<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answerModel extends Model
{
    use HasFactory;
    protected $table = "answer_currency";
    public $timestamps = false;

    protected $fillable = [
        'result'
    ];
}

