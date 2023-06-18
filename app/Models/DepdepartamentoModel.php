<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepdepartamentoModel extends Model
{
    use HasFactory;

    protected $table = 'dep_departamento';
    protected $primaryKey = 'dep_id';
    protected $fillable = ['dep_nombre', 'dep_estado', 'dep_usu_creacion', 'dep_usu_modificacion', 'dep_fecha_creacion', 'dep_fecha_modificacion'];

    // Opcional: Si no deseas utilizar los campos 'created_at' y 'updated_at'
    public $timestamps = false;
    // Relación uno a muchos con la tabla de municipios
    public function municipios()
    {
        return $this->hasMany(MunmunicipioModel::class, 'mun_id_dep', 'dep_id');
    }
}