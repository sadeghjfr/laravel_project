<?php

namespace App\Models;

use App\Models\Admin\Content\Comment;
use App\Models\Admin\Ticket\Ticket;
use App\Models\Admin\Ticket\TicketAdmin;
use App\Models\Admin\User\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'status',
        'user_type',
        'activation',
        'profile_photo_path',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    }

    public function ticketAdmin(){

        return $this->hasOne(TicketAdmin::class);
    }

    public function tickets(){

        return $this->hasMany(Ticket::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {

            $user->tickets()->each(function ($ticket) {
                $ticket->delete();
            });

            $user->comments()->each(function ($comment) {
                $comment->delete();
            });
        });

    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
