<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    protected $fillable = [
        'name', 'address', 'work_schedule'
    ];

    public function trucks()
    {
        return $this->belongsToMany(Truck::class, 'park_truck', 'park_id', 'truck_id');
    }
}
