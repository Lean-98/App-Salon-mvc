<?php

namespace Model;

class Usuario extends ActiveRecord {

    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password2;
    public $password_nuevo;
    public $password_nuevo2;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->password_nuevo2 = $args['password_nuevo2'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de la cuenta
    public function validarNuevaCuenta() {
        if( !$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio!';
        }

        if( !$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio!';
        }

        if( !$this->email) {
            self::$alertas['error'][] = 'El campo E-mail es Obligatorio!';
        }

        if( !$this->password) {
            self::$alertas['error'][] = 'El campo Password es Obligatorio!';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres!';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] ='Los Passwords son diferentes!';
        }

        if( !$this->telefono) {
            self::$alertas['error'][] = 'El Teléfono es Obligatorio!';
        }

        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio';
        }

        return self::$alertas;
    }

     public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es Obligatorio!';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres!';
        }
        
        return self::$alertas;
    }

    public function nuevoPassword() : array {
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo no puede ir Vacio!';
        }
        if(strlen($this->password_nuevo) <6 ) {
            self::$alertas['error'][] ='El Password debe Contener al menos 6 Caracteres!';
        }
        if($this->password_nuevo !== $this->password_nuevo2) {
            self::$alertas['error'][] ='Los Passwords Nuevos son diferentes!';
        }
        return self::$alertas;
    }

    // Revisa si el usuario ya existe
    public function existeUsuario() {
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El Usuario ya esta Registrado!';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        
        $resultado = password_verify($password, $this->password);
        
        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada!';
        } else {
            return true;
        }
    }

}