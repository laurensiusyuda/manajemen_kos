<?php

namespace App\Models;

use App\UnitStatus;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $guarded = ['id'];

    protected $casts = [
        'status' => UnitStatus::class,
    ];

    public function property()
    {
        return $this->belongsTo(Properti::class, 'property_id');
    }
}
