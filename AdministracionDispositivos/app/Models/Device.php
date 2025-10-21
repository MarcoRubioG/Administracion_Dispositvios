<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'numero_serie',
        'imei',
        'estado'
    ];


    public function assignments()
    {
        return $this->hasMany(DeviceAssignment::class);
    }

    public function currentAssignment()
    {
        return $this->hasOne(DeviceAssignment::class)->whereNull('fecha_devolucion')->latest();
    }
}