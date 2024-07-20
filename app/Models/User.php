<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    const ADMIN = 'Admin';
    const STAFF = 'Staff';
    const PERSONNEL = 'Personnel';
    const STUDENT = 'Student';

    const ROLES = [
    //   User::ADMIN => User::ADMIN, 
      User::STAFF => User::STAFF, 
      User::PERSONNEL => User::PERSONNEL, 
      User::STUDENT => User::STUDENT, 
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function fullName(){
        return $this->name;
    }

    public function dashBoardBaseOnRole(){
        switch($this->role){
            case User::ADMIN :
            return redirect()->route('users');
            default:
            return redirect()->route('unauthorizepage');
        }
    }

    public function getImage()
        {
            if (!empty($this->profile_photo_path) && Storage::disk('public')->exists($this->profile_photo_path)) {
                return Storage::disk('public')->url($this->profile_photo_path);
            } else {
                return asset('images/placeholder-image.jpg'); // Return default image URL
            }
        }


        public function scopeNotAdmin($query)
        {
            return $query->where('role', '!=', User::ADMIN);
        }

}
