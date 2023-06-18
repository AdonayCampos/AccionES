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

class SeguridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $modulo = 'seguridad';
        $this->middleware('auth');
    }


    public function index()
    {
        $modulo = 'seguridad';
        return view('/seguridad/inicio')->with(['modulo' => $modulo]);
    }

    public function listar_usuarios()
    {
        $modulo = 'seguridad';
        if (Auth::user()->usu_rol == 2) {
            $usuarios = UsuusuarioModel::select(
                "usu_usuario.usu_id",
                "usu_usuario.usu_usuario",
                "usu_usuario.usu_rol",
                "usu_usuario.usu_estado",
                "per_persona.per_id as per_id",
                "per_persona.per_primer_nombre as primer_nombre",
                "per_persona.per_segundo_nombre as segundo_nombre",
                "per_persona.per_primer_apellido as primer_apellido",
                "per_persona.per_segundo_apellido as segundo_apellido"
            )->join("per_persona", "per_persona.per_id", "=", "usu_usuario.usu_id_per")->where('usu_usuario.usu_rol', '=', 3)->get();
        } else {
            $usuarios = UsuusuarioModel::select(
                "usu_usuario.usu_id",
                "usu_usuario.usu_usuario",
                "usu_usuario.usu_rol",
                "usu_usuario.usu_estado",
                "per_persona.per_id as per_id",
                "per_persona.per_primer_nombre as primer_nombre",
                "per_persona.per_segundo_nombre as segundo_nombre",
                "per_persona.per_primer_apellido as primer_apellido",
                "per_persona.per_segundo_apellido as segundo_apellido"
            )->join("per_persona", "per_persona.per_id", "=", "usu_usuario.usu_id_per")->get();

        }
        return view('/seguridad/usuarios/listar')->with(['modulo' => $modulo, 'usuarios' => $usuarios]);
    }
    public function cargar_edit(UsuusuarioModel $usuario)
    {
        $modulo = 'seguridad';
        return view('/seguridad/usuarios/editar')->with(['usuario' => $usuario, 'modulo' => $modulo]);
    }

    public function editar_usu(Request $resquet, UsuusuarioModel $usuario)
    {
        $modulo = 'seguridad';
        //Validando datos datos
        $data = request()->validate([
            'nombre_usu' => 'required',
            'rol' => 'required',
            'estado' => 'required',
            'contrasena' => request()->input('modificar_contrasena') ? 'required' : '',
            'per' => 'required'
        ]);
        //Reemplazar datos anteriores con los nuevos
        $usuario->usu_id_per = $data['per'];
        $usuario->usu_usuario = $data['nombre_usu'];
        $usuario->usu_rol = $data['rol'];
        $usuario->usu_estado = $data['estado'];
        //Validar la contraseña
        if (isset($data['contrasena']) && $data['contrasena'] != '') {
            $usuario->usu_pass = Hash::make($data['contrasena']);
        } else {
            // Mantener la misma contraseña sin modificar
            unset($data['contrasena']); // Eliminar la clave 'contrasena' del array de datos
        }
        $usuario->usu_usu_modificacion = Auth::user()->usu_id;
        $usuario->usu_fecha_modificacion = now();

        //Guardar la informacion (actualizar)
        $usuario->save();

        //Redireccionar 
        return redirect('/usuario')->with(['modulo' => $modulo]);
    }

    public function eliminar_usu($id)
    {
        //Eliminar usuario con id que recibimos
        UsuusuarioModel::destroy($id);

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function listar_empleados()
    {
        $modulo = 'seguridad';
        if (Auth::user()->usu_rol == 2) {
            $empleados = PerpersonaModel::select(
                "per_persona.per_id",
                "per_persona.per_primer_nombre as primer_nombre",
                "per_persona.per_segundo_nombre as segundo_nombre",
                "per_persona.per_primer_apellido as primer_apellido",
                "per_persona.per_segundo_apellido as segundo_apellido",
                "per_persona.per_apellido_casado as apellido_casado",
                "per_persona.per_dui as dui",
                "per_persona.per_fecha_nacimiento as fecha_nac",
                "per_persona.per_codigo_emp as codigo",
                "per_persona.per_estado as estado",
                "usu_usuario.usu_usuario as usuario",
                "usu_usuario.usu_id as usu_id",
                "mun_municipio.mun_nombre as municipio"
            )->leftJoin("usu_usuario", "usu_usuario.usu_id_per", "=", "per_persona.per_id")
                ->join("mun_municipio", "mun_municipio.mun_id", "=", "per_persona.per_id_mun_residencia")->where('usu_usuario.usu_rol', '=', 3)->
                where('per_persona.per_estado', '!=', 2)
                ->get();
            foreach ($empleados as $empleado) {
                $empleado->fecha_nac = Carbon::parse($empleado->fecha_nac);
            }
        } else {
            $empleados = PerpersonaModel::select(
                "per_persona.per_id",
                "per_persona.per_primer_nombre as primer_nombre",
                "per_persona.per_segundo_nombre as segundo_nombre",
                "per_persona.per_primer_apellido as primer_apellido",
                "per_persona.per_segundo_apellido as segundo_apellido",
                "per_persona.per_apellido_casado as apellido_casado",
                "per_persona.per_dui as dui",
                "per_persona.per_fecha_nacimiento as fecha_nac",
                "per_persona.per_codigo_emp as codigo",
                "per_persona.per_estado as estado",
                "usu_usuario.usu_usuario as usuario",
                "usu_usuario.usu_id as usu_id",
                "mun_municipio.mun_nombre as municipio"
            )->leftJoin("usu_usuario", "usu_usuario.usu_id_per", "=", "per_persona.per_id")
                ->join("mun_municipio", "mun_municipio.mun_id", "=", "per_persona.per_id_mun_residencia")->where('per_persona.per_estado', '!=', 2)->where(function ($query) {
                    $query->orWhere('usu_usuario.usu_rol', '!=', 3)
                        ->orWhereNull('usu_usuario.usu_rol');
                })
                ->get();
            foreach ($empleados as $empleado) {
                $empleado->fecha_nac = Carbon::parse($empleado->fecha_nac);
            }
        }
        return view('/seguridad/empleados/listar')->with(['modulo' => $modulo, 'empleados' => $empleados]);
    }

    public function cargar_edit_emp(PerpersonaModel $empleado)
    {
        $modulo = 'seguridad';
        $dep = DepdepartamentoModel::all();
        $municipios = MunmunicipioModel::all();
        return view('/seguridad/empleados/editar')->with(['empleado' => $empleado, 'modulo' => $modulo, 'dep' => $dep, 'municipios' => $municipios]);
    }

    public function editar_emp(Request $resquet, PerpersonaModel $empleado)
    {
        $modulo = 'seguridad';
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
            'per_fecha_nacimiento' => 'required|date',
            'per_codigo_emp' => [
                'required',
                Rule::unique('per_persona', 'per_codigo_emp')->ignore($empleado->per_id, 'per_id')
            ],
            'per_estado' => 'required',
            'per' => 'required'
        ]);
        //Reemplazar datos anteriores con los nuevos

        $empleado->per_id = $data['per'];
        $empleado->per_primer_nombre = $data['per_primer_nombre'];
        $empleado->per_segundo_nombre = $data['per_segundo_nombre'];
        $empleado->per_tercer_nombre = $data['per_tercer_nombre'];
        $empleado->per_primer_apellido = $data['per_primer_apellido'];
        $empleado->per_segundo_apellido = $data['per_segundo_apellido'];
        if (isset($data['per_apellido_casado']) && $data['per_apellido_casado'] != '') {
            $empleado->per_apellido_casado = $data['per_apellido_casado'];
        } else {
            $empleado->per_apellido_casado = "";
        }

        $empleado->per_dui = $data['per_dui'];
        $empleado->per_id_mun_residencia = $data['per_id_mun_residencia'];
        $empleado->per_direccion_residencia = $data['per_direccion_residencia'];
        $empleado->per_fecha_nacimiento = $data['per_fecha_nacimiento'];
        $empleado->per_codigo_emp = $data['per_codigo_emp'];
        $empleado->per_estado = $data['per_estado'];
        //Campos de auditoria
        $empleado->per_usu_modificacion = Auth::user()->usu_id;
        $empleado->per_fecha_modificacion = now();

        //Guardar la informacion (actualizar)
        $empleado->save();

        //Redireccionar 
        return redirect('/empleado')->with(['modulo' => $modulo]);
    }

    public function create_emp(Request $resquet)
    {
        $modulo = 'seguridad';
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
            'per_fecha_nacimiento' => 'required|date',
            'per_codigo_emp' => 'required|unique:per_persona,per_codigo_emp'
        ]);
        $data['per_estado'] = '1';
        // Agregar los valores de los campos auditoria
        $data['per_usu_creacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['per_usu_modificacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['per_fecha_creacion'] = now(); // Fecha y hora actual
        $data['per_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        PerpersonaModel::create($data);

        //Redireccionar 
        return redirect('/empleado')->with(['modulo' => $modulo]);
    }

    public function eliminar_emp(PerpersonaModel $empleado)
    {
        //Eliminar empleado con id que recibimos
        $empleado->per_estado = 2;
        $empleado->save();

        //Retornar una respuesta json
        return response()->json(array('res' => true));
    }

    public function crear_emp()
    {
        $modulo = 'seguridad';
        $dep = DepdepartamentoModel::all();
        $mun = MunmunicipioModel::all();
        return view('/seguridad/empleados/crear')->with(['dep' => $dep, 'modulo' => $modulo, 'mun' => $mun]);
    }
    public function cargar_edit_usu_emp(UsuusuarioModel $usuario)
    {
        $modulo = 'seguridad';
        return view('/seguridad/empleados/editar_usu')->with(['usuario' => $usuario, 'modulo' => $modulo]);
    }

    public function editar_usu_emp(Request $resquet, UsuusuarioModel $usuario)
    {
        $modulo = 'seguridad';
        //Validando datos datos
        $data = request()->validate([
            'nombre_usu' => 'required',
            'rol' => 'required',
            'estado' => 'required',
            'contrasena' => request()->input('modificar_contrasena') ? 'required' : '',
            'per' => 'required'
        ]);
        //Reemplazar datos anteriores con los nuevos
        $usuario->usu_id_per = $data['per'];
        $usuario->usu_usuario = $data['nombre_usu'];
        $usuario->usu_rol = $data['rol'];
        $usuario->usu_estado = $data['estado'];
        //Validar la contraseña
        if (isset($data['contrasena']) && $data['contrasena'] != '') {
            $usuario->usu_pass = Hash::make($data['contrasena']);
        } else {
            // Mantener la misma contraseña sin modificar
            unset($data['contrasena']); // Eliminar la clave 'contrasena' del array de datos
        }
        $usuario->usu_usu_modificacion = Auth::user()->usu_id;
        $usuario->usu_fecha_modificacion = now();

        //Guardar la informacion (actualizar)
        $usuario->save();

        //Redireccionar 
        return redirect('/empleado')->with(['modulo' => $modulo]);
    }

    public function cargar_crear_usu_emp(PerpersonaModel $empleado)
    {
        $modulo = 'seguridad';
        return view('/seguridad/empleados/crear_usu')->with(['empleado' => $empleado, 'modulo' => $modulo]);
    }

    public function create_usu_emp(Request $resquet)
    {
        $modulo = 'seguridad';
        //Validando datos datos
        $data = request()->validate([
            'usu_usuario' => 'required|unique:usu_usuario,usu_usuario',
            'usu_pass' => 'required',
            'usu_rol' => 'required',
            'usu_id_per' => 'required'
        ]);
        $data['usu_pass'] = Hash::make($data['usu_pass']);
        // Agregar los valores de los campos auditoria
        $data['usu_estado'] = '1'; // Por defecto el estado es activo
        $data['usu_usu_creacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['usu_usu_modificacion'] = Auth::user()->usu_id; // ID del usuario autenticado
        $data['usu_fecha_creacion'] = now(); // Fecha y hora actual
        $data['usu_fecha_modificacion'] = now(); // Fecha y hora actual
        //Guardar la informacion (insertar)
        UsuusuarioModel::create($data);

        //Redireccionar 
        return redirect('/empleado')->with(['modulo' => $modulo]);
    }
}