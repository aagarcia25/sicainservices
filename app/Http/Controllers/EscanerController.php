<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EscanerController extends Controller
{

    public function Escaner(Request $request)
    {

        $NUMCODE = 0;
        $STRMESSAGE = 'Exito';
        $response = "";
        $SUCCESS = true;

        try {

            $empleado = Empleado::where('NumeroEmpleado', $request->NumEmpleado)->first();

            if ($empleado) {
                $response = $empleado;
            } else {
                $response = false;
                $STRMESSAGE = "Empleado No Encontrado";

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
                ])));

    }
}
