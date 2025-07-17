<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
