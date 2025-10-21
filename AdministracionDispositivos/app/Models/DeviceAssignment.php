<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'fecha_asignacion',
        'fecha_devolucion',
        'observaciones'
    ];

    protected $casts = [
        'fecha_asignacion' => 'date',
        'fecha_devolucion' => 'date',
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}