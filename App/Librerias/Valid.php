<?php
/**
 * Valid.php
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Librerias;

/**
 * Valiaciones de valroes
 * Class Valid
 * @package App\Librerias
 */
abstract class Valid
{

    /**
     * Comprueva si un valor esta vacío.
     * Se consideran vacios: Espacios en blanco y fechas a cero (formato yyyy-mm-dd).
     * No vacio: valor 0, true o false.
     *
     * @param mixed $valor
     *
     * @return bool
     */
    public static function is_empty($valor): bool
    {
        if ($valor === false) {
            return false;
        }
        if (is_object($valor)) {
            return false;
        }
        if (is_array($valor) && count($valor) === 0) {
            return true;
        }
        if (is_array($valor) && count($valor) !== 0) {
            return false;
        }
        $tmp = strtolower(trim(''.$valor));
        if ($tmp === '0') {
            return false;
        }
        if ($tmp === '0000-00-00' || $tmp === '0000-00-00 00:00:00' || $tmp === 'null') {
            return true;
        }
        return ($tmp === "");
    }

}

/*
$e   = empty('');              // true
$e   = empty('    ');          // false
$e   = empty("");              // true
$e   = empty("    ");          // false
$e   = empty(null);            // true
$e   = empty(0);               // true
$e   = empty('0');             // true
$e   = empty("0");             // true
$e   = empty(true);            // false
$e   = empty(false);           // true
$e   = empty($ClassObject);    // false
$arr = array();
$e   = empty($arr);            // true
$arr = array('0');
$e   = empty($arr);            // false
$arr = array(0);
$e   = empty($arr);            // false

$e = Valid::is_empty('');             // true
$e = Valid::is_empty('    ');         // true
$e = Valid::is_empty("");             // true
$e = Valid::is_empty("    ");         // true
$e = Valid::is_empty(null);           // true
$e = Valid::is_empty(0);              // false
$e = Valid::is_empty('0');             // false
$e = Valid::is_empty("0");             // false
$e = Valid::is_empty(true);           // false
$e = Valid::is_empty(false);          // false

$arr = array();
$e   = Valid::is_empty($arr);          // true
$arr = array('0');
$e   = Valid::is_empty($arr);          // false
$arr = array(0);
$e   = Valid::is_empty(($arr);          // false
*/