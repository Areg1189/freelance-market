<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use TCG\Voyager\Traits\VoyagerUser;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;
    use VoyagerUser;
    use Favoriteability;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function verifyPayPalEmail()
    {
        return isset($this->employer->payer_email) and $this->employer->payer_email ? true : false;
    }

    public function jobs()
    {
        return $this->hasMany(Job::class,'user_id', 'id');
    }

    public function isOnline($id)
    {
        return Cache::has('user-is-online-'.$id);
    }


}
