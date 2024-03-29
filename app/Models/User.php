<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'user_role_id',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userRole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'user_role_id', 'id');
    }

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'customer_id', 'id');
        return $this->hasMany(Ticket::class, 'staff_id', 'id');
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'user_teams', 'user_id', 'team_id');
    }

    public function leadTeam(): BelongsTo
    {
        return $this->belongsTo(LeadTeam::class);
    }
    public function message(): HasMany
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
        return $this->hasMany(Message::class, 'created_by', 'id');
    }
}
