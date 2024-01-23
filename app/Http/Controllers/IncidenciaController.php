<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Traits\MailTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class IncidenciaController extends Controller
{

    use MailTrait;
    public function incidencia(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $data = $this->decryptData($request->b);
            $obj = json_decode($data);

            // Verifica si la propiedad 'Foto' en $obj no es null antes de acceder a ella
            if ($obj && property_exists($obj, 'Foto')) {
                $foto = $obj->Foto;
            } else {
                throw new \Exception('La propiedad "Foto" no está presente o es null en el objeto.');
            }


            $fecha = Carbon::now('America/Monterrey');
            $id = Str::uuid();
            $datosIncidencia = [
                'Id'   => $id,
                'Foto' => $foto,
                'Observaciones' => urldecode($obj->Observaciones),
                'IdEmpleado' => $obj->IdEmpleado,
                'FechaCreacion' => $fecha
            ];

            $response = Incidencia::create($datosIncidencia);
            if ($response) {
                $rsu = DB::table('SICAIN.Incidencias as inc')
                    ->select('inc.Observaciones', 'inc.FechaCreacion', 'emp.NumeroEmpleado', 'emp.RazonSocial', DB::raw('CONCAT(emp.Nombre, " ", emp.ApellidoP, " ", emp.ApellidoM) as Nombre'))
                    ->leftJoin('SICAIN.Empleados as emp', 'emp.Id', '=', 'inc.IdEmpleado')
                    ->where('inc.id', '=', $id)
                    ->first();

                $parametros = [
                    'Fecha' => $rsu->FechaCreacion,
                    'Empleado' => $rsu->NumeroEmpleado,
                    'RazonSocial' => $rsu->RazonSocial,
                    'Nombre' => $rsu->Nombre,
                    'Observacion' => $rsu->Observaciones,
                ];

                $plantilla = $this->getplantilla('001', $parametros);
                $this->sendMailNotificacion('adolfoangelgarcia66@gmail.com', $plantilla->Encabezado, $plantilla->body);
            }
        } catch (\Exception $e) {
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);
            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ]
            ))
        );
    }

    public function incidenciaList(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
              SELECT inc.*,
                     emp.NumeroEmpleado,
                     emp.Nombre,
                     emp.ApellidoP,
                     emp.ApellidoM,
                     emp.RazonSocial
               FROM SICAIN.Incidencias inc
               LEFT JOIN SICAIN.Empleados emp ON emp.Id = inc.IdEmpleado
            ');
        } catch (\Exception $e) {
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ]
            ))
        );
    }

    public function totalincidencias(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
            SELECT COUNT(1) total FROM SICAIN.Incidencias
            ');
        } catch (\Exception $e) {
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ]
            ))
        );
    }

    public function Incidenciasporfecha(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $response = DB::select('
           SELECT COUNT(1) total,FechaCreacion FROM SICAIN.Incidencias group BY FechaCreacion
            ');
        } catch (\Exception $e) {
            $this->logInfo($e->getMessage(), __METHOD__, __LINE__);

            $NUMCODE = 1;
            $STRMESSAGE = $e->getMessage();
            $SUCCESS = false;
        }
        return response()->json(
            $this->encryptData(json_encode(
                [
                    'NUMCODE' => $NUMCODE,
                    'STRMESSAGE' => $STRMESSAGE,
                    'RESPONSE' => $response,
                    'SUCCESS' => $SUCCESS,
                ]
            ))
        );
    }
}
