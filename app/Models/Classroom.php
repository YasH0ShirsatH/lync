<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function classroomforms()
    {
        return $this->hasMany(ClassroomForm::class, 'classroom_id');
    }
}
