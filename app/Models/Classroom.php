<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClassroomForms;
use App\Models\ClassroomStudents;
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

    public function classroomStudents()
    {
        return $this->hasMany(ClassroomStudents::class, 'classroom_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_students', 'classroom_id', 'student_id');
    }
}
