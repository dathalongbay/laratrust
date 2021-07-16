<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';
    protected $primaryKey = 'id';

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
