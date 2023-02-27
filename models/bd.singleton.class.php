<?php

class CBaseDatos //Tipo Singleton
{
    //almacena un objeto resourse que tiene un identificador de
    //conexion "linkid" o 0 en caso de error   
    private $_oLinkId;      //Identificador de Conexión

    private static $_oSelf = null;  //Instancia

    private function __construct()
    {
    }

    /**
     * Este es el pseudo constructor singleton
     * Comprueba si la variable privada $_oSelf tienen un objeto
     * de esta misma clase, sino lo tiene lo crea y lo guarda
     */
    public static function get_instancia()
    {
        //Si no hay instancia de CBaseDatos 
        //en la variable estatica $_oSelf
        if (!self::$_oSelf instanceof self) {
            //Se crea un objeto de CBaseDatos guardandolo
            //en la varialbe estatica
            //new self ejecuta __construct()
            self::$_oSelf = new self;
        }
        //Se devuelve el objeto creado
        return self::$_oSelf;
    }

    /**
     * Crea un oRecurso de conexion y lo asigna a oLinkId.
     * Si oLinkId es 0. Es porque el recurso no existe
     * Realiza la conexion y devuelve el resultado
     * @return true si hubo exito en la conexion
     */
    // public function conectar($host, $user, $pass, $base, $port)
    public function conectar()
    {
        //Si no existe un recurso previo se intenta crear uno nuevo
        if (!$this->_oLinkId) {
            //VERIFICAMOS LA CONEXION AL MOTOR DE BD
            //oMysqlConnect es tipo resource si tiene exito y guarda un "link identifier"
            //algo como 5893, vamos un entero.
            //sino guarda un false (0)
            $oMysqlConnect = mysqli_connect('127.0.0.1', 'root', '', 'tareas-lenpro3');

            //si no es tipo resource es que no ha tenido exito la conexion;
            if (!$oMysqlConnect) {
                //Lanza la excepcion y se sale del procedimiento
                //throw new Exception($this->_sMensaje);
                die;

                return false;
            }

            //Guardamos el id del recurso conectado, esta propiedad nos servirá
            //cuando queramos ejecutar una SQL contra la BD deberemos utilizar 
            //la propiedad get_link_id(). Lo veremos más abajo en este post
            $this->_oLinkId = $oMysqlConnect;

            //VERIFICAMOS QUE EXISTA LA BASE DE DATOS EN EL MOTOR
            $bExisteBD  =  mysqli_select_db($oMysqlConnect, 'clubprogramacion');
            //si no se pudo encontrar esa BD lanza un error
            if (!$bExisteBD) {
                //Lanza la excepcion y se sale del procedimiento
                //throw new Exception($this->_sMensaje);
                die;
                return false;
            } else //Si se conecto
            {
                //$this->_sMensaje = "SE CONECTO CON EXITO";
                mysqli_set_charset($this->_oLinkId, 'utf8');
            }
        } //fin Ya existe recurso abierto por lo tanto se puede instanciar con get_link_id()
        return true;
    }



    /**
     * Devuelve un entero mayor a 0 si hay conexión. 
     * En caso contrario 0
     */
    public function get_link_id()
    {
        return $this->_oLinkId;
    }
}
?>