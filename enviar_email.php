<?php
if(isset($_POST['email'])) {

    // Edita las líneas siguientes con tu dirección de correo y asunto

    $email_to = "sierrahuacha@gmail.com";

    $email_subject = "Reserva Cabañas";

    function died($error) {

        // si hay algún error, el formulario puede desplegar su mensaje de aviso

        echo "Lo sentimos, hay un error en sus datos y el formulario no puede ser enviado. ";

        echo "Detalle de los errores.<br /><br />";

        echo $error."<br /><br />";

        echo "Porfavor corrije los errores e inténtelo de nuevo.<br /><br />";
        die();
    }

    // Se valida que los campos del formulairo estén llenos

    if(!isset($_POST['nombre']) ||

        !isset($_POST['apellido']) ||

        !isset($_POST['n_documento']) ||

        !isset($_POST['email']) ||

        !isset($_POST['telefono']) ||

        !isset($_POST['celular']) ||

        !isset($_POST['adultos']) ||

        !isset($_POST['niños']) ||

        !isset($_POST['ingreso']) ||

        !isset($_POST['salida']) ||

        !isset($_POST['message'])) {

        died('Lo sentimos pero parece haber un problema con los datos enviados.');

    }
 //Valor "name" nos sirve para crear las variables que recolectaran la información de cada campo

    $nombre = $_POST['nombre']; // requerido

    $apellido = $_POST['apellido']; // requerido

    $n_documento = $_POST['n_documento']; // requerido

    $email_from = $_POST['email']; // requerido

    $telefono = $_POST['telefono']; // no requerido

    $celular = $_POST['celular']; // requerido

    $adultos = $_POST['adultos']; // requerido

    $niños = $_POST['niños']; // requerido

    $ingreso = $_POST['ingreso']; // requerido

    $salida = $_POST['salida']; // requerido

    $message = $_POST['message']; // requerido

    $error_message = "Error";

//Verificar que la dirección de correo sea válida

   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {

    $error_message .= 'La dirección de correo proporcionada no es válida.<br />';

  }

//Validadacion de cadenas de texto

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$nombre)) {

    $error_message .= 'El formato del nombre no es válido<br />';

  }

  if(!preg_match($string_exp,$apellido)) {

    $error_message .= 'el formato del apellido no es válido.<br />';

  }

  if(strlen($message) < 2) {

    $error_message .= 'El formato del texto no es válido.<br />';

  }

  if(strlen($error_message) < 0) {

    died($error_message);

  }

//Plantilla de mensaje

    $email_message = "Contenido del Mensaje.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "Nombre: ".clean_string($nombre)."\n";

    $email_message .= "Apellido: ".clean_string($apellido)."\n";

    $email_message .= "n_documento: ".clean_string($n_documento)."\n";

    $email_message .= "Email: ".clean_string($email_from)."\n";

    $email_message .= "Teléfono: ".clean_string($telefono)."\n";

    $email_message .= "celular: ".clean_string($celular)."\n";

    $email_message .= "adultos: ".clean_string($adultos)."\n";

    $email_message .= "niños: ".clean_string($niños)."\n";

    $email_message .= "ingreso: ".clean_string($ingreso)."\n";

    $email_message .= "salida: ".clean_string($salida)."\n";

    $email_message .= "Mensaje: ".clean_string($message)."\n";


//Encabezados

$headers = 'From: '.$email_from."\r\n".

'CC: '.$email_from."\r\n".

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);

?>

<!-- Mensaje de Éxito-->

Muchas Gracias! Proximamente Estaremos en Contacto.

<?php
}
?>
