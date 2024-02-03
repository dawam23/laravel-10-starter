<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Actions\UserAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
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
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getInitials()
    {
        preg_match_all('#([A-Z]+)#', $this->name, $capitals);
        if (count($capitals[1]) >= 2) {
            return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
        }
        return mb_strtoupper(mb_substr($this->name, 0, 2, 'UTF-8'), 'UTF-8');
    }

    /**
     * If the user avatar is empty, generate one using online service
     *
     * @return mixed|string
     */
    public function getAvatarUrl()
    {
        return (new UserAvatar)->get($this);
        // return ! empty($this->avatar) ?
        //     (new UserAvatar)->get($this) :
        //     config('avatar.service_url').'?name='.urlencode($this->name).'&color=fff&background='.substr(md5($this->name), 0, 6).'&size='.config('avatar.size');
    }

    public function getInitialsAvatar() {
        return empty($this->avatar) ?
            $this->getInitials(): '';
    }

}
