<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confidence extends Model
{
    use HasFactory;
    protected $table = 'confidence'; 

    protected $fillable = ['confidence','status','set_by'];
}
