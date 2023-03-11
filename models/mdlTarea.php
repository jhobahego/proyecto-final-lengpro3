<?php

  require_once 'bd.singleton.class.php';

  class Tarea {
    
    private $id;
    private $titulo;
    private $descripcion;
    private $estado;

    private $conexion;

    public function __construct(){

    }

    public function getId(){
      return $this->id;
    }

    public function getTitulo(){
      return $this->titulo;
    }

    public function getDescripcion(){
      return $this->descripcion;
    }

    public function getEstado(){
      return $this->estado;
    }

    public function setId($id){
      return $this->id = $id;
    }

    public function setTitulo($titulo){
      return $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion){
      return $this->descripcion = $descripcion;
    }

    public function setEstado($estado){
      return $this->estado = $estado;
    }

    public function guardar(){
      $consulta = "INSERT INTO tarea(titulo,descripcion) VALUES('$this->titulo','$this->descripcion')";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      if($this->conexion->get_link_id()){
        if(mysqli_query($this->conexion->get_link_id(), $consulta)){
          return ['status' => '200', 'message' => 'Guardado', 'icon' => 'success'];
        } else {
            return ['status' => '201', 'message' => 'Problemas con consulta', 'icon' => 'warning'];
        }
      }else {
        return ['status' => '500', 'message' => 'problemas en la conexion', 'icon' => 'error'];
      }
    }

    public function consultarTodos(){
      $consulta = "SELECT tarea_id, titulo, descripcion FROM tarea WHERE estado=0 ORDER BY titulo";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      $resultado = mysqli_query($this->conexion->get_link_id(), $consulta);

      $datos = array();

      while($fila = mysqli_fetch_assoc($resultado)){
        $datos[] = $fila;
      }
      
      return $datos;
    }

    public function consultar($id){
      $consulta = "SELECT tarea_id, titulo, descripcion FROM tarea WHERE tarea_id=$id";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      $resultado = mysqli_query($this->conexion->get_link_id(), $consulta);
      
      return $resultado;
    }

  }
