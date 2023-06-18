<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpersonaModel extends Model
{
    protected $table = 'per_persona';
    protected $primaryKey = 'per_id';
    public $timestamps = false;

    protected $fillable = [
        'per_id_mun_residencia',
        'per_primer_nombre',
        'per_segundo_nombre',
        'per_tercer_nombre',
        'per_primer_apellido',
        'per_segundo_apellido',
        'per_apellido_casado',
        'per_dui',
        'per_fecha_nacimiento',
        'per_codigo_emp',
        'per_direccion_residencia',
        'per_estado',
        'per_usu_creacion',
        'per_usu_modificacion',
        'per_fecha_creacion',
        'per_fecha_modificacion'
    ];

    // Relaciones con otras tablas
    // Ejemplo: 
    public function usuario()
    {
        return $this->hasOne(usu_usuario::class, 'usu_id_per', 'per_id');
    }

    public function municipio()
    {
        return $this->belongsTo(MunmunicipioModel::class, 'per_id_mun_residencia', 'mun_id');
    }


}