<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:32
 */

class Crypt{
    function encrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
    }

    function decrypt($string, $key) {
        if ($string == ''){
            $result = null;
        } else {
            $result = '';
            $string = base64_decode($string); //decodifica el id_user
            for($i=0; $i<strlen($string); $i++) { //sirve para contar el número de letras que tiene una cadena de caracteres
                $char = substr($string, $i, 1); //devuelve los caracteres de una cadena que comienzan en una localización especificada
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)-ord($keychar));
                $result.=$char;
            }
        }
        return $result;
    }
}