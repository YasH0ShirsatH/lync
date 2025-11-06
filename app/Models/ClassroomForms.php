<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Form;
class ClassroomForms extends Model
{
    protected $table = 'classroom_forms';

    protected $fillable = [
        'classroom_id',
        'form_id',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
        }
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
        }
}
