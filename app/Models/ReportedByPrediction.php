<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedByPrediction extends Model
{
    protected $table='reported_by_prediction';
    protected $fillable=[
        'cooperative_id',
        'predicted_class',
        'image',
        'confidence',
        'latitude',
        'longitude'
    ];
    use HasFactory;
}
