<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    protected $table = 'propertis';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
