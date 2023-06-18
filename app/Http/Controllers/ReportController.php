<?php

namespace App\Http\Controllers;

use App\Models\DepdepartamentoModel;
use App\Models\GesgestionModel;
use App\Models\MunmunicipioModel;
use App\Models\Product;
use App\Models\RegresponsablexgestionModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $modulo = 'reportes';
        $this->middleware('auth');
    }

    public function reporte_principal(Request $request)
    {
        $modulo = 'reportes';
        $departamentos = DepdepartamentoModel::where('dep_estado', '=', 1)->get();
        $municipios = MunmunicipioModel::where('mun_estado', '=', 1)->get();

        // Obtener las gestiones filtradas por departamento y municipio
        $gestiones = GesgestionModel::query();

        if ($request->filled('municipio')) {
            $municipiosSeleccionados = $request->input('municipio');
            $gestiones->whereIn('ges_id_mun', $municipiosSeleccionados)
                ->where(function ($query) {
                    $query->where('ges_estado', '=', 2)
                        ->orWhere('ges_estado', '=', 3);
                });
            $gestiones = $gestiones->get();
            // Convertir las fechas a objetos Carbon
            foreach ($gestiones as $gestion) {
                $gestion->ges_fecha_inicio = $gestion->ges_fecha_inicio ? Carbon::parse($gestion->ges_fecha_inicio) : null;
                $gestion->ges_fecha_fin = $gestion->ges_fecha_fin ? Carbon::parse($gestion->ges_fecha_fin) : null;
            }
        }

        return view('/reports/inicio')->with(['modulo' => $modulo, 'departamentos' => $departamentos, 'municipios' => $municipios, 'gestiones' => $gestiones]);
    }

    public function pantalla_gestionesxestado(Request $request)
    {
        $modulo = 'reportes';
        // Obtener las gestiones filtradas
        $gestiones = GesgestionModel::query();

        if ($request->filled('estado')) {
            $estadosSelect = $request->input('estado');
            $gestiones->whereIn('ges_estado', $estadosSelect);
            $gestiones = $gestiones->get();
            // Convertir las fechas a objetos Carbon
            foreach ($gestiones as $gestion) {
                $gestion->ges_fecha_inicio = $gestion->ges_fecha_inicio ? Carbon::parse($gestion->ges_fecha_inicio) : null;
                $gestion->ges_fecha_fin = $gestion->ges_fecha_fin ? Carbon::parse($gestion->ges_fecha_fin) : null;
            }
        }

        return view('/reports/gesxestado')->with(['modulo' => $modulo, 'gestiones' => $gestiones]);
    }
    public function generar_gestionesxestado($gestionesEncoded)
    {
        $gestionesDecoded = json_decode(base64_decode($gestionesEncoded), true);
        $gesIds = array_column($gestionesDecoded, 'ges_id');
        $gestiones = GesgestionModel::query();
        $gestiones->whereIn('ges_id', $gesIds);
        $gestiones = $gestiones->get();
        // Convertir las fechas a objetos Carbon
        foreach ($gestiones as $gestion) {
            $gestion->ges_fecha_inicio = $gestion->ges_fecha_inicio ? Carbon::parse($gestion->ges_fecha_inicio) : null;
            $gestion->ges_fecha_fin = $gestion->ges_fecha_fin ? Carbon::parse($gestion->ges_fecha_fin) : null;
        }

        // Cargar la vista del reporte
        $pdf = Pdf::loadView('/reports/pdf/reporte_gesxestado', compact('gestiones'));
        $pdf->setPaper('letter', 'landscape');

        return $pdf->stream('Reporte de Gestiones por estado.pdf');
    }

    public function pantalla_gestionesxmun(Request $request)
    {
        $modulo = 'reportes';
        $departamentos = DepdepartamentoModel::where('dep_estado', '=', 1)->get();
        $municipios = MunmunicipioModel::where('mun_estado', '=', 1)->get();

        // Obtener las gestiones filtradas por departamento y municipio
        $gestiones = GesgestionModel::query();

        if ($request->filled('municipio')) {
            $municipiosSeleccionados = $request->input('municipio');
            $gestiones->whereIn('ges_id_mun', $municipiosSeleccionados);
            $gestiones = $gestiones->get();
            // Convertir las fechas a objetos Carbon
            foreach ($gestiones as $gestion) {
                $gestion->ges_fecha_inicio = $gestion->ges_fecha_inicio ? Carbon::parse($gestion->ges_fecha_inicio) : null;
                $gestion->ges_fecha_fin = $gestion->ges_fecha_fin ? Carbon::parse($gestion->ges_fecha_fin) : null;
            }
        }

        return view('/reports/gesxmun')->with(['modulo' => $modulo, 'departamentos' => $departamentos, 'municipios' => $municipios, 'gestiones' => $gestiones]);
    }

    public function generar_gestionesxmunicipio($gestionesEncoded)
    {
        $gestionesDecoded = json_decode(base64_decode($gestionesEncoded), true);
        $gesIds = array_column($gestionesDecoded, 'ges_id');
        $gestiones = GesgestionModel::query();
        $gestiones->whereIn('ges_id', $gesIds);
        $gestiones = $gestiones->get();
        // Convertir las fechas a objetos Carbon
        foreach ($gestiones as $gestion) {
            $gestion->ges_fecha_inicio = $gestion->ges_fecha_inicio ? Carbon::parse($gestion->ges_fecha_inicio) : null;
            $gestion->ges_fecha_fin = $gestion->ges_fecha_fin ? Carbon::parse($gestion->ges_fecha_fin) : null;
        }

        // Cargar la vista del reporte
        $pdf = Pdf::loadView('/reports/pdf/reporte_gesxmun', compact('gestiones'));
        $pdf->setPaper('letter', 'landscape');

        return $pdf->stream('Reporte de Gestiones por Departamento y Municipio.pdf');
    }

    public function pantalla_resxges(Request $request)
    {
        $modulo = 'reportes';
        $gestiones = GesgestionModel::where('ges_estado', '!=', 0)->get();

        // Obtener las gestiones filtradas por departamento y municipio
        $responsables = RegresponsablexgestionModel::query();

        if ($request->filled('gestion')) {
            $gestionSeleccionados = $request->input('gestion');
            $responsables->whereIn('reg_id_ges', $gestionSeleccionados);
            $responsables = $responsables->get();
        }

        return view('/reports/resxges')->with(['modulo' => $modulo, 'responsables' => $responsables, 'gestiones' => $gestiones]);
    }

    public function generar_responsablexges($responsableEncoded)
    {
        $responsableDecoded = json_decode(base64_decode($responsableEncoded), true);
        $resIds = array_column($responsableDecoded, 'reg_id_ges');
        $responsables = RegresponsablexgestionModel::query();
        $responsables->whereIn('reg_id_ges', $resIds)->orderBy('reg_id_ges');
        $responsables = $responsables->get();
        // Cargar la vista del reporte
        $pdf = Pdf::loadView('/reports/pdf/reporte_resxges', compact('responsables'));
        $pdf->setPaper('letter', 'landscape');

        return $pdf->stream('Reporte de Responsables por Gestiones.pdf');
    }
}