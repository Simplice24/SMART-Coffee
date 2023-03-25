<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperative extends Model
{
    protected $table='cooperatives';
    protected $fillable=[
        'name',
        'manager_name',
        'category',
        'email',
        'status',
        'starting_date',
        'province',
        'district',
        'sector',
        'cell'
    ];
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function farmers()
    {
        return $this->hasMany(Farmer::class);
    }
}
