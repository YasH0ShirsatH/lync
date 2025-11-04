<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ClassroomForms;
use App\Models\FormSubmission;
class Form extends Model
{
    protected $fillable = [
        'title',
        'html_content',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function classroomForms()
    {
        return $this->hasMany(ClassroomForms::class, 'form_id');
    }
    
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'form_id');
    }
}
