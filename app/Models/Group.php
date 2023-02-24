<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public function dp()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    protected $fillable = [
        'name', 'department_id', 'tutor_id'
    ];
}
