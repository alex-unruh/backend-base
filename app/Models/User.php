<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Hash the user password
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Change profile label to index
     *
     * @param string $profile_label
     * @return void
     */
    public function setProfileAttribute(string $profile_label): void
    {
        $profiles = __('auth.profiles');
        $this->attributes['profile'] = array_search($profile_label, $profiles);
    }

    /**
     * Change status boolean to label
     *
     * @param int $profile_index
     * @return string
     */
    public function getProfileAttribute(int $profile_index): string
    {
        $profiles = __('auth.profiles');
        return $profiles[$profile_index];
    }
}
