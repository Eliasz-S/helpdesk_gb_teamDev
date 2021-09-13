<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Issue extends Model
{
    use HasFactory, Notifiable;

    protected $table = "issues";

    protected $fillable = [
        'name', 
        'email', 
        'subject', 
        'priority',
        'specialist',
        'updated_at',
        'created_at',
    ];
}

