<?php

namespace App\Http\Controllers;

use App\Models\DepdepartamentoModel;
use App\Models\GesgestionModel;
use App\Models\MunmunicipioModel;
use App\Models\PerpersonaModel;
use App\Models\RegresponsablexgestionModel;
use App\Models\UsuusuarioModel;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GestionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $modulo = 'gestion';
        $this->middleware('auth');
    }


    public function index()
    {
        $modulo = 'gestion';
        return view('/gestion/inicio')->with(['modulo' => $modulo]);
    }

    public function listar_todo()
    {
        $modulo = 'gestion';
        $gestiones = GesgestionModel::select(
            "ges_gestion.ges_id",
            "ges_gestion.ges_nombre",
            "ges_gestion.ges_descripcion",
            "ges_gestion.ges_tipo_gestion",
            "ges_gestion.ges_fecha_inicio",
            "ges_gestion.ges_fecha_fin",
            "ges_gestion.ges_num_benef",
            "ges_gestion.ges_estado",
            "ges_gestion.ges_id_mun"
        )->where('ges_gestion.ges_estado', '!=', 0)->get();
        foreach ($gestiones as $gestion) {
            $gestion->ges_fecha_inicio = Carbon::parse($gestion->ges_fecha_inicio);
            $gestion->ges_fecha_fin = Carbon::parse($gestion->ges_fecha_fin);
        }
        return view('/gestion/listar')->with(['modulo' => $modulo, 'gestiones' => $gestiones]);
    }

    public function cargar_crear()
    {
        $modulo = 'gestion';
        $dep = DepdepartamentoModel::all();
        $mun = MunmunicipioModel::all();
        return view('/gestion/crear')->with(['dep' => $dep, 'modulo' => $modulo, 'mun' => $mun]);
    }

    public function create_gest(Request $resquet)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'ges_nombre' => 'required|unique:ges_gestion,ges_nombre,NULL,id,ges_tipo_gestion,' . $resquet->input('ges_tipo_gestion'),
            'ges_descripcion' => 'nullable',
            'ges_tipo_gestion' => 'required',
            'ges_num_benef' => 'required',
            'ges_id_mun' => 'nullable',
            'ges_fecha_inicio' => 'required',
            'ges_fecha_fin' => 'required'
        ]);
        $data['ges_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $data['ges_usu_creacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['ges_usu_modificacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['ges_fecha_creacion'] = now(); // Fecha y hora actual
        $data['ges_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        GesgestionModel::create($data);

        //Redireccionar 
        return redirect('/gestiones/listar')->with(['modulo' => $modulo]);
    }

    public function cargar_edit(GesgestionModel $gestion)
    {
        $modulo = 'gestion';
        $dep = DepdepartamentoModel::all();
        $mun = MunmunicipioModel::all();
        return view('/gestion/editar')->with(['gestion' => $gestion, 'modulo' => $modulo, 'dep' => $dep, 'municipios' => $mun]);
    }

    public function edit_gest(Request $resquet, GesgestionModel $gestion)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'ges_nombre' => 'required|unique:ges_gestion,ges_nombre,' . $gestion->ges_id . ',ges_id,ges_tipo_gestion,' . $resquet->input('ges_tipo_gestion'),
            'ges_descripcion' => 'nullable',
            'ges_tipo_gestion' => 'required',
            'ges_num_benef' => 'required',
            'ges_id_mun' => 'nullable',
            'ges_fecha_inicio' => 'required',
            'ges_fecha_fin' => 'required',
            'ges' => 'required'
        ]);
        $gestion->ges_nombre = $data['ges_nombre'];
        $gestion->ges_descripcion = $data['ges_descripcion'];
        $gestion->ges_tipo_gestion = $data['ges_tipo_gestion'];
        $gestion->ges_id_mun = $data['ges_id_mun'];
        $gestion->ges_num_benef = $data['ges_num_benef'];
        $gestion->ges_fecha_inicio = $data['ges_fecha_inicio'];
        $gestion->ges_fecha_fin = $data['ges_fecha_fin'];
        $gestion->ges_id = $data['ges'];
        $gestion->ges_estado = $gestion->ges_estado;
        //Campos de auditoria
        $gestion->ges_usu_modificacion = Auth::user()->usu_id;
        $gestion->ges_fecha_modificacion = now();

        //Guardar la informacion (actualizar)
        $gestion->save();

        //Redireccionar 
        return redirect('/gestiones/listar')->with(['modulo' => $modulo]);
    }

    public function eliminar_ges(GesgestionModel $gestion)
    {
        //Eliminar Gestion con id que recibimos
        $gestion->per_estado = 0;
        $gestion->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function aprobar_ges(GesgestionModel $gestion)
    {
        //Aprobar la gestion
        $gestion->ges_estado = 2;
        $gestion->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function ejecutar_ges(GesgestionModel $gestion)
    {
        //Aprobar la gestion
        $gestion->ges_estado = 3;
        $gestion->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function finalizar_ges(GesgestionModel $gestion)
    {
        //Aprobar la gestion
        $gestion->ges_estado = 4;
        $gestion->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function revertir_ges(GesgestionModel $gestion)
    {
        //Aprobar la gestion
        $gestion->ges_estado = $gestion->ges_estado - 1;
        $gestion->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function listar_responxGesId(GesgestionModel $gestion)
    {
        $modulo = 'gestion';
        $responsables = RegresponsablexgestionModel::select(
            "reg_responsablexgestion.reg_id",
            "reg_responsablexgestion.reg_id_ges",
            "reg_responsablexgestion.reg_id_per",
            "reg_responsablexgestion.reg_cargo"
        )->where('reg_responsablexgestion.reg_id_ges', '=', $gestion->ges_id)->get();

        return view('/gestion/responsable/listar')->with(['modulo' => $modulo, 'gestion' => $gestion, 'responsables' => $responsables]);
    }

    public function cargar_crear_reg(GesgestionModel $gestion)
    {
        $modulo = 'gestion';
        $empleados = PerpersonaModel::select(
            "per_persona.per_id",
            "per_persona.per_primer_nombre as primer_nombre",
            "per_persona.per_segundo_nombre as segundo_nombre",
            "per_persona.per_primer_apellido as primer_apellido",
            "per_persona.per_segundo_apellido as segundo_apellido"
        )->Join("usu_usuario", "usu_usuario.usu_id_per", "=", "per_persona.per_id")->where('per_persona.per_estado', '!=', 2)->where('usu_usuario.usu_rol', '=', 2)
            ->get();
        return view('/gestion/responsable/crear')->with(['empleados' => $empleados, 'modulo' => $modulo, 'gestion' => $gestion]);
    }

    public function create_reg(Request $resquet)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'reg_id_per' => 'required|unique:reg_responsablexgestion,reg_id_per,NULL,id,reg_id_ges,' . $resquet->input('reg_id_ges'),
            'reg_id_ges' => 'required',
            'reg_cargo' => 'required'
        ]);
        $data['reg_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $data['reg_usu_creacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['reg_usu_modificacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['reg_fecha_creacion'] = now(); // Fecha y hora actual
        $data['reg_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        RegresponsablexgestionModel::create($data);

        //Redireccionar 
        return redirect('/gestiones/' . $data['reg_id_ges'] . '/responsable/listar')->with(['modulo' => $modulo]);
    }

    public function eliminar_reg($id)
    {
        //Eliminar usuario con id que recibimos
        RegresponsablexgestionModel::destroy($id);

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }
}