<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationRequest extends Model
{
    use HasFactory;

    public function requestable()
    {
        return $this->morphTo();
    }
}
