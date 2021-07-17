<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empleado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'email',
        'sexo',
        'area_id',
        'boletin',
        'descripcion'];

    public static function seleccionar()
    {
        return static::select(
            'id',
            'nombre',
            'email',
            "sexo",
            "area_id",
            DB::raw('(select nombre from areas where id = area_id) as area'),
            'descripcion',
            'boletin'
        );
    }
}
