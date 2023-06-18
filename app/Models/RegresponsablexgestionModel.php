<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegresponsablexgestionModel extends Model
{
    protected $table = 'reg_responsablexgestion';
    protected $primaryKey = 'reg_id';
    public $timestamps = false;

    protected $fillable = [
        'reg_id_ges',
        'reg_id_per',
        'reg_cargo',
        'reg_estado',
        'reg_usu_creacion',
        'reg_usu_modificacion',
        'reg_fecha_creacion',
        'reg_fecha_modificacion',
    ];


    public function gestion()
    {
        return $this->belongsTo(GesgestionModel::class, 'reg_id_ges', 'ges_id');
    }


    public function persona()
    {
        return $this->belongsTo(PerpersonaModel::class, 'reg_id_per', 'per_id');
    }


}
