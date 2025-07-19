<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\User;


class Profile extends Model
{
    protected $fillable = [
        'user_id',
        // 'first_name',
        // 'last_name',
        'address_location',
        'phone_number',
        'personal_summary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

