<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$archivo = "base.xml";

/*
|--------------------------------------------------------------------------
| COMPROBAR XML
|--------------------------------------------------------------------------
*/

if(!file_exists($archivo)){
    die("No existe el archivo XML");
}

/*
|--------------------------------------------------------------------------
| CARGAR XML
|--------------------------------------------------------------------------
*/

$xml = simplexml_load_file($archivo);

if($xml === false){

    die("Error cargando XML");

}

/*
|--------------------------------------------------------------------------
| NUEVO ID
|--------------------------------------------------------------------------
*/

$id = count($xml->encuesta) + 1;

/*
|--------------------------------------------------------------------------
| NUEVA ENCUESTA
|--------------------------------------------------------------------------
*/

$encuesta = $xml->addChild("encuesta");
$encuesta->addAttribute("id", $id);

/*
|--------------------------------------------------------------------------
| USUARIO
|--------------------------------------------------------------------------
*/

$usuario = $encuesta->addChild("usuario");
$usuario->addChild("tipo", $_POST["usuario"] ?? "");
$usuario->addChild("frecuencia", $_POST["frecuencia"] ?? "");

/*
|--------------------------------------------------------------------------
| ACCESIBILIDAD
|--------------------------------------------------------------------------
*/

$accesibilidad = $encuesta->addChild("accesibilidad");
$accesibilidad->addChild("contacto", $_POST["contacto"] ?? "");
$accesibilidad->addChild("canal", $_POST["canal"] ?? "");

/*
|--------------------------------------------------------------------------
| TIEMPO
|--------------------------------------------------------------------------
*/

$tiempo = $encuesta->addChild("tiempo");
$tiempo->addChild("espera", $_POST["espera"] ?? "");
$tiempo->addChild("resolucion", $_POST["resolucion_tiempo"] ?? "");

/*
|--------------------------------------------------------------------------
| CALIDAD
|--------------------------------------------------------------------------
*/

$calidad = $encuesta->addChild("calidad");
$calidad->addChild("trato", $_POST["trato"] ?? "");
$calidad->addChild("ayuda", $_POST["ayuda"] ?? "");
$calidad->addChild("claridad", $_POST["claridad"] ?? "");

/*
|--------------------------------------------------------------------------
| VALORACION
|--------------------------------------------------------------------------
*/

$valoracion = $encuesta->addChild("valoracion");
$valoracion->addChild("problema", $_POST["problema"] ?? "");
$valoracion->addChild("general", $_POST["valoracion"] ?? "");
$valoracion->addChild("recomendacion", $_POST["recomendacion"] ?? "");
$valoracion->addChild("puntuacion", $_POST["puntuacion"] ?? "");
$valoracion->addChild("sentimiento", $_POST["sentimiento"] ?? "");

/*
|--------------------------------------------------------------------------
| GUARDAR XML
|--------------------------------------------------------------------------
*/

$resultado = $xml->asXML($archivo);

if(!$resultado){
    die("No se pudo guardar el XML");
}

/*
|--------------------------------------------------------------------------
| RESPUESTA
|--------------------------------------------------------------------------
*/

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset='UTF-8'>
<title>Encuesta enviada</title>

<style>

body{
    font-family:Segoe UI;
    background:#eef3f8;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
    text-align:center;
}

h1{
    color:#005ea8;
}

a{
    display:inline-block;
    margin-top:20px;
    background:#005ea8;
    color:white;
    padding:12px 25px;
    border-radius:10px;
    text-decoration:none;
}

</style>
</head>

<body>

<div class='card'>

<h1>Encuesta enviada correctamente</h1>

<a href='index.html'>Volver</a>

</div>

</body>
</html>
";
?>