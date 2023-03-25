<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;
    protected $table='diseases';
    protected $fillable=[
        'disease_name',
        'category',
        'description',
        'image',
        
    ];
   
    public function members(){
        return $this->belongsToMany(Member::class,'farmer_diseases');
    }
}
