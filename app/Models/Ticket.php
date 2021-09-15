<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    // use HasFactory;
    protected $table = "tickets";

    protected $fillable = [
        'source',
        'subject',
        'status_id',
        'priority_id',
        'type_id',
        'customer_id',
        'staff_id',
        'team_id',
        'created_at',
        'updated_at'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'customer_id', 'id');
    }
}
