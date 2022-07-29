<?php 

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {
    public static function index (Router $router) {
        
        iniciaSesion();
        isAdmin();
        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear (Router $router) {

        iniciaSesion();
        isAdmin();
        $servicio = new Servicio;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
               // Crear mensaje de exito
               Servicio::setAlerta('exito', 'Servicio Creado Correctamente!'); 
               // Redireccionar al login
               header('Refresh: 3; url= /servicios');
            }
        }

        $alertas = Servicio::getAlertas();
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar (Router $router) {

        iniciaSesion();
        isAdmin();
        
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if(!$id) return;

        $servicio = Servicio::find($id);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                Servicio::setAlerta('exito', 'Servicio Actualizado Correctamente!');
                // Redireccionar al login
                header('Refresh: 3; url= /servicios');
            }
        }

        $alertas = Servicio::getAlertas();
        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar () {

        iniciaSesion();
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            // Redireccionar a servicios
            header('Location: /servicios');
        }
    }

}