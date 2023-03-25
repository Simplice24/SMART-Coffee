<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $table='farmers';
    protected $fillable=[
        'name',
        'idn',
        'cooperative_name',
        'category',
        'gender',
        'number_of_trees',
        'fertilizer',
        'phone',
        'province',
        'district',
        'sector',
        'cell',
        'cooperative_id'
    ];
    public function cooperatives(){
        return $this->belongsTo(Cooperative::class);
    }
    public function diseases(){
        return $this->belongsToMany(Disease::class,'farmer_diseases');
    }
    
    
}
