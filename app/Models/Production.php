<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table='production';
    protected $fillable=[
        'season',
        'quantity',
        'cooperative_id'
    ];
    use HasFactory;
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }
}
