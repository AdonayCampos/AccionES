<?php

namespace App\Http\Controllers;

use App\Models\DepdepartamentoModel;
use App\Models\MunmunicipioModel;
use App\Models\PerpersonaModel;
use App\Models\UsuusuarioModel;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroUsuario extends Controller
{

    public function index()
    {
        $dep = DepdepartamentoModel::all();
        $mun = MunmunicipioModel::all();
        return view('/registrar_usuario')->with(['dep' => $dep, 'mun' => $mun]);
    }

    public function obtenerMunicipios($departamentoId)
    {
        // Obtener los municipios correspondientes al departamento seleccionado
        $municipios = MunmunicipioModel::where('mun_id_dep', $departamentoId)->get();

        // Retornar los municipios en formato JSON
        return response()->json($municipios);
    }

    public function create_cid(Request $resquet)
    {
        //Validando datos datos
        $data = request()->validate([
            'per_primer_nombre' => 'required',
            'per_segundo_nombre' => 'nullable',
            'per_tercer_nombre' => 'nullable',
            'per_primer_apellido' => 'required',
            'per_segundo_apellido' => 'nullable',
            'per_apellido_casado' => 'nullable|required_if:tiene_apellido_casada,true',
            'per_dui' => 'required|regex:/\d{8}-\d/',
            'per_id_mun_residencia' => 'required',
            'per_direccion_residencia' => 'required',
            'per_fecha_nacimiento' => 'required|date'
        ]);
        $dataUsu = request()->validate([
            'usu_pass' => 'required',
            'usu_usuario' => 'required'
        ]);
        $data['per_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $data['per_usu_creacion'] = 1; // ID del usuario autenticado
        $data['per_usu_modificacion'] = 1; // ID del usuario autenticado
        $data['per_fecha_creacion'] = now(); // Fecha y hora actual
        $data['per_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        $nuevaPersona = PerpersonaModel::create($data);
        $idPer = $nuevaPersona->per_id;
        $dataUsu['usu_id_per'] = $idPer;
        $dataUsu['usu_pass'] = Hash::make($dataUsu['usu_pass']);
        $dataUsu['usu_rol'] = 3;
        $dataUsu['usu_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $dataUsu['usu_usu_creacion'] = 1; // ID del usuario autenticado
        $dataUsu['usu_usu_modificacion'] = 1; // ID del usuario autenticado
        $dataUsu['usu_fecha_creacion'] = now(); // Fecha y hora actual
        $dataUsu['usu_fecha_modificacion'] = now(); // Fecha y hora actual
        UsuusuarioModel::create($dataUsu);
        //Redireccionar 
        return redirect('/');
    }
}