<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = 'deals';

    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'comments', 'status'];

    const STATUS_PENDING = 'pending';
    const STATUS_VIEWED = 'viewed';
    const STATUS_APPROVED = 'approved';
    const STATUS_DENY = 'deny';
    const STATUS_ARCHIVED = 'archived';
}
