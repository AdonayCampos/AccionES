<?php

namespace App\Http\Controllers;

use App\Models\DepdepartamentoModel;
use App\Models\MunmunicipioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class MunicipioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function obtenerMunicipios($departamentoId)
    {
        // Obtener los municipios correspondientes al departamento seleccionado
        $municipios = MunmunicipioModel::where('mun_id_dep', $departamentoId)->get();

        // Retornar los municipios en formato JSON
        return response()->json($municipios);
    }

    public function obtenerMunicipiosMultiples(Request $request)
    {
        // Obtener los IDs de los departamentos seleccionados
        $departamentos = $request->input('departamentos', []);

        // Obtener los municipios correspondientes a los departamentos seleccionados
        $municipios = MunmunicipioModel::whereIn('mun_id_dep', $departamentos)->get();
        // Retornar los municipios en formato JSON
        return response()->json($municipios);
    }

    public function listar_dep()
    {
        $modulo = 'gestion';
        $departamentos = DepdepartamentoModel::select(
            "dep_departamento.dep_id",
            "dep_departamento.dep_nombre",
            "dep_departamento.dep_estado"
        )->where('dep_departamento.dep_estado', '!=', 2)->get();
        return view('/gestion/catalogos/departamentos/listar')->with(['modulo' => $modulo, 'departamentos' => $departamentos]);
    }

    public function listar_mun_byIdDep(DepdepartamentoModel $departamento)
    {
        $modulo = 'gestion';
        // Obtener los municipios correspondientes al departamento seleccionado
        $municipios = MunmunicipioModel::where('mun_id_dep', $departamento->dep_id)
            ->where('mun_estado', '!=', 2)->get();

        // Retornar los municipios en formato JSON
        return view('/gestion/catalogos/municipios/listar')->with(['modulo' => $modulo, 'municipios' => $municipios, 'dep' => $departamento]);
    }

    public function cargar_crear_dep()
    {
        $modulo = 'gestion';
        return view('/gestion/catalogos/departamentos/crear')->with(['modulo' => $modulo]);
    }

    public function create_dep(Request $resquet)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'dep_nombre' => 'required|unique:dep_departamento,dep_nombre'
        ]);
        $data['dep_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $data['dep_usu_creacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['dep_usu_modificacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['dep_fecha_creacion'] = now(); // Fecha y hora actual
        $data['dep_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        DepdepartamentoModel::create($data);

        //Redireccionar 
        return redirect('/gestiones/cat/departamentos')->with(['modulo' => $modulo]);
    }

    public function cargar_edit_dep(DepdepartamentoModel $departamento)
    {
        $modulo = 'gestion';
        return view('/gestion/catalogos/departamentos/editar')->with(['departamento' => $departamento, 'modulo' => $modulo]);
    }

    public function editar_dep(Request $resquet, DepdepartamentoModel $departamento)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'dep_nombre' => [
                'required',
                Rule::unique('dep_departamento', 'dep_nombre')->ignore($departamento->dep_id, 'dep_id')
            ],
            'dep' => 'required',
            'dep_estado' => 'required'
        ]);
        //Reemplazar datos anteriores con los nuevos

        $departamento->dep_id = $data['dep'];
        $departamento->dep_nombre = $data['dep_nombre'];
        $departamento->dep_estado = $data['dep_estado'];
        //Campos de auditoria
        $departamento->dep_usu_modificacion = Auth::user()->usu_id;
        $departamento->dep_fecha_modificacion = now();

        //Guardar la informacion (actualizar)
        $departamento->save();

        //Redireccionar 
        return redirect('/gestiones/cat/departamentos')->with(['modulo' => $modulo]);
    }

    public function eliminar_dep(DepdepartamentoModel $departamento)
    {
        //Eliminar empleado con id que recibimos
        $departamento->dep_estado = 2;
        $departamento->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function cargar_crear_mun(DepdepartamentoModel $departamento)
    {
        $modulo = 'gestion';
        return view('/gestion/catalogos/municipios/crear')->with(['modulo' => $modulo, 'departamento' => $departamento]);
    }

    public function create_mun(Request $resquet)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'mun_nombre' => 'required|unique:mun_municipio,mun_nombre',
            'mun_id_dep' => 'required'
        ]);
        $data['mun_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $data['mun_usu_creacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['mun_usu_modificacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['mun_fecha_creacion'] = now(); // Fecha y hora actual
        $data['mun_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        MunmunicipioModel::create($data);

        //Redireccionar 
        return redirect('/gestiones/cat/municipios/listar/' . $data['mun_id_dep'])->with(['modulo' => $modulo]);
    }

    public function cargar_edit_mun(MunmunicipioModel $municipio)
    {
        $modulo = 'gestion';
        return view('/gestion/catalogos/municipios/editar')->with(['modulo' => $modulo, 'municipio' => $municipio]);
    }

    public function editar_mun(Request $resquet, MunmunicipioModel $municipio)
    {
        $modulo = 'gestion';
        //Validando datos datos
        $data = request()->validate([
            'mun_nombre' => [
                'required',
                Rule::unique('mun_municipio', 'mun_nombre')->ignore($municipio->mun_id, 'mun_id')
            ],
            'mun' => 'required',
            'mun_id_dep' => 'required',
            'mun_estado' => 'required'
        ]);
        //Reemplazar datos anteriores con los nuevos

        $municipio->mun_id = $data['mun'];
        $municipio->mun_id_dep = $data['mun_id_dep'];
        $municipio->mun_nombre = $data['mun_nombre'];
        $municipio->mun_estado = $data['mun_estado'];
        //Campos de auditoria
        $municipio->mun_usu_modificacion = Auth::user()->usu_id;
        $municipio->mun_fecha_modificacion = now();

        //Guardar la informacion (actualizar)
        $municipio->save();

        //Redireccionar 
        return redirect('/gestiones/cat/municipios/listar/' . $data['mun_id_dep'])->with(['modulo' => $modulo]);
    }

    public function eliminar_mun(MunmunicipioModel $municipio)
    {
        //Eliminar empleado con id que recibimos
        $municipio->mun_estado = 2;
        $municipio->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }
}