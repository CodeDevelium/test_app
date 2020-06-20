<?php
/**
 * HomeController.php
 *
 * @version     1.0
 * @author      Code Develium
 */

namespace App\Controladores;

/**
 * Class HomeController
 *
 * @package App\Controladores
 */
class HomeController
{

    /**
     * Constructor HomeController.php
     *
     */
    public function __construct()
    {
    }

    /**
     * Index
     *
     * @param $param
     */
    public function indexAction($param = null)
    {
        echo "HomeControlle index";
        var_dump($param);
        echo '<script src="/scripps/app.js"></script>';
    }

}