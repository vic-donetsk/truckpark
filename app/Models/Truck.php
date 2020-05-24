<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{

    protected $fillable = [
        'name', 'driver', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parks()
    {
        return $this->belongsToMany(Park::class, 'park_truck', 'truck_id', 'park_id');
    }

    // проверка наличия машины в базе по госномеру
    public static function isExist($name) {
        return (self::where('name', '=', $name)->exists());
    }
}
