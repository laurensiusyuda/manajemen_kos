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

    public function units()
    {
        return $this->hasMany(Unit::class, 'property_id');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'property_id');
    }
}
