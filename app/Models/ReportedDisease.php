<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedDisease extends Model
{
    use HasFactory;
    protected $fillable=[
        'cooperative_id',
        'disease_id',
        'disease_category',
        'latitude',
        'longitude'
    ];
}
