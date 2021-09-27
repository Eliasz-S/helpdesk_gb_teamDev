<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketStatus extends Model
{
    use HasFactory;

    protected $table = 'ticket_status';

    protected $fillable = [
        'code',
        'description'
    ];

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'status_id', 'id');
    }
}
