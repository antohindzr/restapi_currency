<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requestModel extends Model
{
    use HasFactory;
    protected $table = "request_currency";
    public $timestamps = false;

    protected $fillable = [
        'cur'        
    ];
}

