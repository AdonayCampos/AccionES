<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunmunicipioModel extends Model
{
    protected $table = 'mun_municipio';
    protected $primaryKey = 'mun_id';
    public $timestamps = false;

    protected $fillable = [
        'mun_id_dep',
        'mun_nombre',
        'mun_estado',
        'mun_usu_creacion',
        'mun_usu_modificacion',
        'mun_fecha_creacion',
        'mun_fecha_modificacion',
    ];

    public function departamento()
    {
        return $this->belongsTo(DepdepartamentoModel::class, 'mun_id_dep', 'dep_id');
    }

    public function personas()
    {
        return $this->hasMany(PerpersonaModel::class, 'per_id_mun_residencia', 'mun_id');
    }
    

}
