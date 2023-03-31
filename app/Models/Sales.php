<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table='production';
    protected $fillable=[
        'price',
        'quantity',
        'cooperative_id'
    ];
    use HasFactory;
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }
}
