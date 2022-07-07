<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use MVC\Router;

class CitaController {
   
    public static function index ( Router $router) {

        isAuth();
    
        $router->render('cita/index',[
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}