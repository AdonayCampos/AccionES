<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GesgestionModel extends Model
{
    
    protected $table = 'ges_gestion';
    protected $primaryKey = 'ges_id';
    public $timestamps = false;

    protected $fillable = [
        'ges_id_mun',
        'ges_nombre',
        'ges_descripcion',
        'ges_tipo_gestion',
        'ges_fecha_inicio',
        'ges_fecha_fin',
        'ges_num_benef',
        'ges_estado',
        'ges_usu_creacion',
        'ges_usu_modificacion',
        'ges_fecha_creacion',
        'ges_fecha_modificacion',
    ];



    
    public function municipio()
    {
        return $this->belongsTo(MunmunicipioModel::class, 'ges_id_mun', 'mun_id');
    }
}
