<?php

namespace App\Traits;


use App\Models\Plantilla;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

trait MailTrait
{




    public function sendMailNotificacion($correo, $Encabezado, $body, $adjunto = null)
    {

        if ($correo !== '') {
            try {
                // Crear un mensaje de Laravel Mail
                Mail::send([], [], function (Message $message) use ($correo, $Encabezado, $body, $adjunto) {
                    $message->to($correo)
                        ->subject($Encabezado);
                    // Establecer el cuerpo del mensaje en formato HTML
                    $message->html($body);
                    // Adjuntar el archivo si está definido
                    if ($adjunto !== null) {
                        $message->attach($adjunto);
                    }
                });
            } catch (\Exception $e) {
                // Manejar la excepción en caso de un error al guardar el archivo
                info('No se Envio correo ' . $e->getMessage());
            }
        }
    }

    public function getplantilla($referencia, $parametros)
    {
        $plantilla = Plantilla::where('referencia', $referencia)
            ->first();
        $body = '';

        if ($plantilla) {
            $body = $plantilla->body;

            // Reemplaza los marcadores en el contenido de la plantilla
            foreach ($parametros as $key => $p) {
                $body = str_replace('{{' . $key . '}}', $p, $body);
            }
            $plantilla->body = $body;
        }

        return $plantilla;
    }
}
