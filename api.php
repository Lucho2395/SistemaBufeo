<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 21/09/2018
 * Time: 0:34
 */
//Nunca dejes que nadie te sorprenda, porque de un momento a otro puedes PUTO EL QUE LEA ESTO :)
//Aqui implementaré la api con control de sessiones y gestion de roles

//Establecer zona horaria
date_default_timezone_set('America/Lima');

//LLamada a archivo gestor de base de datos
require 'core/Database.php';
//Levantamiento del Log para registro de errores
require 'app/models/Log.php';
//Levantamiento de registro de roles y permisos para acceso a vistas
require 'app/models/Rolei.php';
//Inicio clase para la encriptacion de contenido
require 'app/models/Crypt.php';

//Inicialización de clases
$errores = new Log();
$rolei = new Rolei();

// Manejo de Errores Personalizado de PHP a Try/Catch
function exception_error_handler($severidad, $mensaje, $fichero, $linea) {
    $cadena =  '[LEVEL]: ' . $severidad . ' IN ' . $fichero . ': ' . $linea . '[MESSAGGE]' . $mensaje . "\n";
    $guardar = new Log();
    $guardar->insert($cadena, "Excepcion No Manejada");
    //echo $cadena;
}

//Para manejo de caracteres
header("Content-Type: text/html;charset=utf-8");
//Especificar el manejo de errores personalizados
set_error_handler("exception_error_handler");
//Inicio de Sesion
session_start();

//Variables Globales
require 'core/globals.php';

//Inicio de Código de Verificación de Permisos

//Captura de Datos para Obtener el Controlador y la Accion

//Inicio de codigo de la api
//Verificar existencia de los archivos
$controlador = $_GET['c'] ?? "none";
$accion = $_GET['a'] ?? "none";
$function_action = $controlador . "|" . $accion;
$archivo = 'app/controllers/' . $controlador . 'Controller.php';

if(file_exists($archivo)){
    //Variable Para Determinar Si Procede O No La Petición
    $autorizado = false;

    if(isset($_COOKIE['role']) || isset($_SESSION['role'])){
        $crypt = new Crypt();
        $role = $_COOKIE['role'] ?? $_SESSION['role'];
        $rol = $crypt->decrypt($role, _PASS_);
        $autorizado = $rolei->verificatePermitRole($rol, $controlador, $accion);
        $permiso = $rolei->verificateStatusUser($crypt->decrypt($_SESSION['user_nickname'], _PASS_));

    } else {
        $autorizado = $rolei->verificatePermitRole(1, $controlador, $accion);
        $permiso = 1;
    }
    //Si $autorizado =  true Entra Aquí, Descomentar La Linea Siguiente Si Sólo Se Quiere Probar Funciones
    //$autorizado = true
    if($autorizado && $permiso == 1){
        try{
            //Entra Aquí Si La Clase Y La Funcion Existen
            require $archivo;
            $clase = sprintf('%sController', $_GET['c'] ?? $controlador);
            $clase = trim(ucfirst($clase));
            $accion = trim(strtolower($accion));
            $controller = new $clase;
            $controller->$accion();
        } catch (\Throwable $e){
            $errores->insert($e->getMessage(), $function_action);
            echo 2;
        }
    } else {
        $errores->insert("SIN PERMISOS SUFICIENTES", $function_action);
        if($permiso == 0){
            $rolei->singOut();
        }
        echo 2;
    }
} else {
    //Acciones si el archivo no existe
    //Automaticamente, notificar error
    $errores->insert("ACCESO A CONTROLADOR NO EXISTENTE", $function_action);
    echo 2;
}