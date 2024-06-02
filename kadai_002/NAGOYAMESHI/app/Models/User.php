<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomResetPassword;
use Overtrue\LaravelFavorite\Traits\Favoriter;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Favoriter, Billable;

    public function sendEmailVarificationNotification() {
        $this->notify(new CustomVerifyEmail());
    }

    public function sendPasswordResetNotidication($token) {
        $this->notify(new CustomResetPassword($token));
    }

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'credit_card',
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
    ];
}
