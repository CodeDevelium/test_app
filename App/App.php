<?php
/**
 * App.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App;

use App\Librerias\Get;
use Exception;

/**
 * Applicación
 * Class App
 *
 * @package App
 */
class App
{

    /**
     * Parámetros recibidos en la url
     *
     * @var string
     */
    private $query_string = '';

    /**
     * Constructor App.php
     *
     */
    public function __construct()
    {
        // Obtener lov valores de la url
        $this->query_string = rtrim(Get::get_str('qs'));
    }

    /**
     * Redireccionar entorno MVC
     */
    public function redireccionaMVC()
    {
        // Tratamos query string
        $array_query_string = explode('/', $this->query_string);

        // Elimina posibles espacios en blanco / nulos
        $array_query_string = array_filter($array_query_string, "strlen");

        // Valores por defecto, si algo falla
        $controlador_defecto = 'home';
        $vista_defecto       = 'index';
        $parametro_defecto   = null;

        $controlador = $controlador_defecto;
        $vista       = $vista_defecto;
        $parametro   = $parametro_defecto;

        $num_parametros = count($array_query_string);
        if ($num_parametros > 0) {

            // El controlador siempre es el primero
            $controlador = $array_query_string[ 0 ];

            if (1 == $num_parametros) {
                // Controlador
            } elseif (2 == $num_parametros) {

                $vista = $array_query_string[ 1 ];

            } elseif (3 == $num_parametros) {

                $vista     = $array_query_string[ 1 ];
                $parametro = $array_query_string[ 2 ];

            } else {

                // Varios parametros
                $vista = $array_query_string[ 1 ];

                // Creamos un array con todos los parámetros
                $parametro = [];
                for ($i = 2; $i < $num_parametros; $i++) {
                    $parametro[] = $array_query_string[ $i ];
                }
            }
        }

        // Añado sufijo Action
        $vista .= 'Action';

        $controlador = ucfirst($controlador).'Controller';

        $namespace_controlador = "App\\Controladores\\".$controlador;

        // Detectamos si es una clase MAESTRO
        if ( ! class_exists($namespace_controlador)) {
            $namespace_controlador = "App\\Controladores\\Maestro\\".$controlador;
        }

        if ( ! class_exists($namespace_controlador)) {
            $ControladorObj = 'Noexiste';
        } else {
            // Instanciamos controlador
            $ControladorObj = new $namespace_controlador();
        }

        // Existe método?
        if ( ! method_exists($ControladorObj, $vista)) {

            die();
        }


        try {

            if (empty($parametro)) {
                // Función sin parámetro
                $ControladorObj->{$vista}();
            } else {

                // Funcíón con un parámetro.
                // Si hay un valor, es el mismo valor
                // Si hay más de un valor es un array con todos los valores de los parámetros
                $ControladorObj->{$vista}($parametro);
            }
        } catch (Exception $ex) {

            die();
        }
    }

}