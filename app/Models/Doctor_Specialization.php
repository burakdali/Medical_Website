<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Specialization extends Model
{
    protected $fillable = [
        'name',
        'department_id',
    ];
    use HasFactory;
    public function user()
    {
        return $this->hasMany(User::class, 'doctor__specialization_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
