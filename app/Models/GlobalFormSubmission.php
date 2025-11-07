<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalFormSubmission extends Model
{
    protected $fillable = [
        'form_id',
        'submitter_name',
        'submitter_email',
        'submitter_type',
        'user_id',
        'form_responses',
        'ip_address',
        'user_agent'
    ];


    protected $casts = [
        'form_responses' => 'array'
    ];

    public function form()
    {
        return $this->belongsTo(\App\Models\Form::class);
    }

 

}
