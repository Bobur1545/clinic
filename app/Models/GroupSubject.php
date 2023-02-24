<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id', "subject_id"
    ];
}
