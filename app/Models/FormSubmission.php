<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['form_id', 'student_id', 'responses', 'form_version', 'form_updated_after_submission'];
    
    protected $casts = [
        'form_version' => 'datetime',
        'form_updated_after_submission' => 'boolean'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}