<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
    'user_id',
    'institution_name',
    'degree',
    'field_of_study',
    'start_year',
    'end_year',
];
}
