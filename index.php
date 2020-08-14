<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/10/2018
 * Time: 11:28
 */
//Nunca dejes que nadie te sorprenda, porque de un momento a otro puedes PUTO EL QUE LEA ESTO :)
//Aqui implementaré la api con control de sessiones y gestion de roles
//Probando push
//Establecer zona horaria
date_default_timezone_set('America/Lima');

//Para Mostrar o No Errores (Comentado Para SI, Descomentado Para NO)
//error_reporting(E_ALL);

//Levantamiento del Log para registro de errores
require 'app/models/Log.php';

//LLamada a archivo gestor de base de datos
require 'core/Database.php';

//Inicio clase para la encriptacion de contenido
require 'app/models/Crypt.php';

//Levantamiento de registro de roles y permisos para acceso a vistas
require 'app/models/Menui.php';

//Inicio Clase Para Generación de Menus Dinamicos
require 'app/models/Navbar.php';

//Inicialización de clases
$errores = new Log();
$menui = new Menui();

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

//Variables de Sesion y Cookies
require 'core/session.php';

//Inicializacion de Turno
require 'core/turn.php';
//Inicio de Código de Verificación de Permisos

//Captura de Datos para Obtener el Controlador y la Accion

//Por Aquí Pasan Todas Las Funciones Para La Lectura de Vistas
if(isset($_GET['c'])){
    //Aqui se recibe el controlador, si es que no está declarado
    $controlador = $_GET['c'];
} else {
    //Si No Hay Controlador Declarado, Se Hace Validación

    //Esta Parte Del Código Es Para Software Que Sólo Funcionan Con Usuarios Registrados
//    if(isset($_COOKIE['role']) || isset($_SESSION['role'])){
//        //Si Entra Aquí, Es Porque Hay Una Sesión Iniciada
//        $controlador = "Index";
//    } else {
//        $controlador = "Login";
//    }

    //Esta Parte Del Código Es Para Software Que Tienes Varias Vistas Libres Para Varios Usuarios
    $controlador = "Admin";
}
$controlador = trim(ucfirst($controlador));
//Obtencion de Datos de Accion, Si No Hay Una Declarada, Se Pone "Index" Por Defecto
$accion = $_GET['a'] ?? "index";

//inicio array de prueba
/*$_SESSION['array'] = array();
array_push($_SESSION['array'], [1, 'Juan']);
array_push($_SESSION['array'], [2, 'Pedro']);
array_push($_SESSION['array'], [3, 'Diana']);
array_push($_SESSION['array'], [4, 'Dana']);
$buscar = 2;
$totalar = count($_SESSION['array']);
for($i=0; $i < $totalar; $i++){
    if($_SESSION['array'][$i][0] == $buscar){
        unset($_SESSION['array'][$i]);
    }
}
$_SESSION['array'] = array_values($_SESSION['array']);*/
//inicio fin

//Para usar en el menú
$_SESSION['accion'] = $accion;
$_SESSION['accionnav'] = $accion;
$_SESSION['controlador'] = $controlador;
//Variable Usada Para Declarar La Funcion En Caso De Error
$function_action = $controlador . "|" . $accion;

//Verificar existencia de los archivos
$archivo = 'app/controllers/' . $controlador . 'Controller.php';
//Verifica Si El Archivo Existe
if(file_exists($archivo)){
    //Variable Para Determinar Si Procede O No La Petición
    $autorizado = false;

    if(isset($_SESSION['role'])){
        $crypt = new Crypt();
        $role = $_SESSION['role'];
        $rol = $crypt->decrypt($role, _PASS_);
        $view = $controlador . '/' . $accion;
        $autorizado = $menui->verificateViewRole($rol, $controlador, $accion);
        $permiso = $menui->verificateStatusUser($crypt->decrypt($_SESSION['user_nickname'], _PASS_));
    } else {
        $view = $controlador . '/' . $accion;
        $autorizado = $menui->verificateViewRole(1, $controlador, $accion);
        $permiso = 1;
    }
    //Si $autorizado =  true Entra Aquí, Descomentar La Linea Siguiente Si Sólo Se Quiere Probar Funciones
    //$autorizado = true
    //$permiso = 1
    if($autorizado && $permiso == 1){
        try{
            //Entra Aquí Si La Clase Y La Funcion Existen
            require $archivo;
            $clase = sprintf('%sController', $_GET['c'] ?? $controlador);
            $accion = $_GET['a'] ?? "index";
            $clase = trim(ucfirst($clase));
            $accion = trim(strtolower($accion));
            $controller = new $clase;
            $controller->$accion();
            unset($_SESSION['accion']);
            unset($_SESSION['controlador']);
            unset($_SESSION['accionnav']);
        } catch (\Throwable $e){
            //Si La Funcion No Existe, Entra Aquí.
            require 'app/controllers/ErrorController.php';
            $clase = sprintf('%sController', 'Error');
            $clase = trim(ucfirst($clase));
            $accion = 'error';
            $controller = new $clase;
            $controller->$accion();
            $errores->insert($e->getMessage(), $function_action);
        }
    } else {
        if(isset($_COOKIE['role']) || isset($_SESSION['role'])){
            if($permiso == 0){
                //LLEGA AQUI SI FUE INHABILITADO PERO TENIA PERMISOS DE ACCESO
                $archivof = 'app/controllers/LoginController.php';
                $controlador = 'Login';
                $menui->singOut();
            } else {
                //LLEGA AQUI SI SE TRATA DE ACCEDER A ACCION O FUNCION SIN PERMISOS Y SI SE ESTA LOGUEADO
                $archivof = 'app/controllers/ErrorController.php';
                $controlador = 'Error';
            }

        } else {
            //LLEGA AQUI SI SE TRATA DE ACCEDER A ACCION O FUNCION SIN PERMISOS Y SI NO SE ESTA LOGUEADO
            $archivof = 'app/controllers/LoginController.php';
            $controlador = 'Login';

        }
        require $archivof;
        $clase = sprintf('%sController', $controlador);
        $clase = trim(ucfirst($clase));
        $accion = 'index';
        $controller = new $clase;
        $controller->$accion();
        $errores->insert("SIN PERMISOS SUFICIENTES", $function_action);

    }
} else {
    //Si el Archivo No Existe, Genera El Error Y Notifica En La Pantalla
    require 'app/controllers/ErrorController.php';
    $clase = sprintf('%sController', 'Error');
    $clase = trim(ucfirst($clase));
    $accion = 'error';
    $controller = new $clase;
    $controller->$accion();
    //Acciones si el archivo no existe
    //Automaticamente, notificar error
    $errores->insert("ACCESO A CONTROLADOR NO EXISTENTE", $function_action);
    //echo 2;
}