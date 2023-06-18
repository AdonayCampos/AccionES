<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\PerpersonaModel;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UsuusuarioModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usu_usuario';
    protected $primaryKey = 'usu_id';
    public $timestamps = false;

    // Define las columnas que se pueden llenar mediante asignación en masa
    protected $fillable = [
        'usu_id_per',
        'usu_usuario',
        'usu_pass',
        'usu_rol',
        'usu_estado',
        'usu_usu_creacion',
        'usu_usu_modificacion',
        'usu_fecha_creacion',
        'usu_fecha_modificacion'
    ];

    // fk  usu_id_per  -> per_id 
    public function persona()
    {
        return $this->belongsTo(PerpersonaModel::class, 'usu_id_per', 'per_id');
    }

    //Para verificar que los roles coincidan con las validacion del Middleware
    public function hasAnyRole(...$roles)
    {
        return in_array($this->usu_rol, $roles);
    }

    protected $hidden = [
        'usu_pass',
        'usu_toke_ofi'
    ];

    public function getAuthPassword()
    {
        return $this->usu_pass;
    }

    public function setRememberToken($value)
    {
        $this->usu_toke_ofi = $value;
    }
}