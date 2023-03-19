<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketPriority extends Model
{
    use HasFactory;

    protected $table = 'ticket_priority';

    protected $fillable = [
        'code',
        'description'
    ];

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'priority_id', 'id');
    }
}
