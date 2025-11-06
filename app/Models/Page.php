<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Dotlogics\Grapesjs\App\Contracts\Editable;

class Page extends Model implements Editable
{
    use EditableTrait;

    protected $fillable = ['name', 'slug', 'page_data', 'teacher_id'];
}
