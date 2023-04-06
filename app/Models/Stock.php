<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable=[
        'product',
        'season',
        'quantity',
        'cooperative_id'
    ];
    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }
}
