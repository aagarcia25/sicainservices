<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{




 public function selectores(Request $request)
 {

  $NUMCODE = 0;
  $STRMESSAGE = 'Exito';
  $response = "";
  $SUCCESS = true;

  try {
     $data = $this->decryptData($request->b);
     $obj = json_decode($data);
     $type = $obj->NUMOPERACION;
    $query = ""; // Define la variable aquí
   if ($type == 1) {
        $query = " SELECT Id value, Descripcion label FROM SICAIN.Roles";
   }

   $response = DB::select($query);

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
