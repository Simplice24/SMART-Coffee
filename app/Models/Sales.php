<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table='sales';
    protected $fillable=[
        'customer',
        'product',
        'price',
        'quantity',
        'payment',
        'cooperative_id',
        'year'
    ];
    use HasFactory;
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }
}
