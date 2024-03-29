<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketType extends Model
{
    use HasFactory;

    protected $table = 'ticket_types';

    protected $fillable = [
        'code',
        'description',
        'is_active'
    ];

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'type_id', 'id');
    }
}
