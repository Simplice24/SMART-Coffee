<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperativeStock extends Model
{
    use HasFactory;
    protected $table='cooperative_stocks';
    protected $fillable=[
        'product_category',
        'quantity',
        'cooperative_id'
        
    ];
}
