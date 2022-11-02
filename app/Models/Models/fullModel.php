<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fullModel extends Model
{
    use HasFactory;
    protected $table = "full_currency";
    public $timestamps = false;

    protected $fillable = [
        'cur',
        'toCur',
        'result'
    ];
}