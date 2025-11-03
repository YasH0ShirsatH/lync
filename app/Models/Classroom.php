<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;;
use App\Models\ClassroomForms;
class Classroom extends Model
{
    protected $fillable = [
        'name',
        'description',
        'teacher_id',
        'password',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function classroomForms()
    {
        return $this->hasMany(ClassroomForms::class, 'classroom_id');
    }

}
