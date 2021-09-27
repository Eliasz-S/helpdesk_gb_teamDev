<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Ticket extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "tickets";

    protected $fillable = [
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
    public function ticketStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }

    public function ticketPriority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id', 'id');
    }
    public function customerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function staffUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type_id', 'id');
    }
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'id', 'ticket_id');
    }
}
