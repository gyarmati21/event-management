<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'location', 'image', 'type', 'description', 'is_vip', 'created_by'];
    protected $table = 'events';

    public const TYPES = [
        'Concert',
        'Workshop',
        'Seminar',
        'Webinar',
        'Festival',
        'Conference',
        'Meetup',
        'Networking Event',
        'Sporting Event',
        'Exhibition'
    ];

    // User who created the event
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // users who joined the event
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }

    // get count of users who joined the event
    public function joinedUserCount()
    {
        return $this->users()->count();
    }
}
