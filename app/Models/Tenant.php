<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Properti::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
