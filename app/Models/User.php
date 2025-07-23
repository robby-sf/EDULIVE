<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use App\Models\Education;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    public function studySessions()
    {
        return $this->hasMany(StudySession::class);
    }


    protected function profileCompleteness(): Attribute {
        return Attribute::make(
            get:function () {
                $totalPoints = 6; //total kriteria (nama, alamat, telp, email, summary, edukasi)
                $completedPoints = 0;

                // 1. Cek nama dari model User
                if (!empty($this->name)) {
                    $completedPoints++;
                }

                // 2. Cek email dari model User
                if (!empty($this->email)) {
                    $completedPoints++;
                }

                // Cek data dari relasi profile
                if ($this->profile) {
                    // 3. Cek alamat
                    if (!empty($this->profile->address_location)) {
                        $completedPoints++;
                    }
                    // 4. Cek nomor telepon
                    if (!empty($this->profile->phone_number)) {
                        $completedPoints++;
                    }
                    // 5. Cek personal summary
                    if (!empty($this->profile->personal_summary)) {
                        $completedPoints++;
                    }
                }

                // 6. Cek riwayat pendidikan (minimal 1)
                if ($this->educations()->exists()) {
                    $completedPoints++;
                }

                 if ($totalPoints == 0) {
                    return 0;
                }

                 return round(($completedPoints / $totalPoints) * 100);
            }
        );
    }
}
