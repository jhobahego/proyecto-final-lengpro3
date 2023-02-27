<?php

  require_once 'bd.singleton.class.php';

  class Tarea {
    
    private $id;
    private $titulo;
    private $descripcion;

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

    public function setId($id){
      return $this->id = $id;
    }

    public function setTitulo($titulo){
      return $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion){
      return $this->descripcion = $descripcion;
    }

    public function guardar(){
      $consulta = "INSERT INTO tarea(titulo,descripcion) VALUES('$this->titulo','$this->descripcion')";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      if($this->conexion->get_link_id() != 0){
        if(mysqli_query($this->conexion->get_link_id(), $consulta)){
          return true;
        }else{
          return false;
        }
      }else {
        return false;
      }
    }

  }
?>