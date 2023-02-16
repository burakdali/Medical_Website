<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public function doctorSpecialization()
    {
        return $this->hasMany(Doctor_Specialization::class);
    }
    protected $fillable = [
        'name'
    ];
}
