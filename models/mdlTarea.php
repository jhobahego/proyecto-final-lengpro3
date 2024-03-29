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
      $consulta = "call sp_guardarTarea('$this->titulo', '$this->descripcion')";
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
      $consulta = "call sp_consultarTarea(0)";
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
      $consulta = "call sp_consultarTarea($id)";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      $resultado = mysqli_query($this->conexion->get_link_id(), $consulta);
      
      return $resultado;
    }

    public function actualizar($id){
      $consulta = "call sp_editarTarea('$this->titulo', '$this->descripcion',$id)";

      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      if($this->conexion->get_link_id()){
        if(mysqli_query($this->conexion->get_link_id(), $consulta)){
          return ['status' => '200', 'message' => 'Actualizado', 'icon' => 'success'];
        } else {
            return ['status' => '201', 'message' => 'Problemas con consulta de actualización', 'icon' => 'warning'];
        }
      }else {
        return ['status' => '500', 'message' => 'problemas en la conexion al intentar actualizar', 'icon' => 'error'];
      }
    }

    public function tareaCompletada($id){
      // $consulta = "UPDATE `tarea` SET estado=1 WHERE tarea_id=$id";
      $consulta = "call sp_completarTarea($id)";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      if($this->conexion->get_link_id()){
        if(mysqli_query($this->conexion->get_link_id(), $consulta)){
          return ['status' => '200', 'message' => 'Tarea completada', 'icon' => 'success'];
        } else {
            return ['status' => '201', 'message' => 'Problemas con consulta de actualización', 'icon' => 'warning'];
        }
      }else {
        return ['status' => '500', 'message' => 'problemas en la conexion al intentar actualizar estado de la tarea', 'icon' => 'error'];
      }
    }

    public function eliminarTarea($id){
      $consulta = "call sp_eliminarTarea($id)";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      if($this->conexion->get_link_id()){
        if(mysqli_query($this->conexion->get_link_id(), $consulta)){
          return ['status' => '200', 'message' => 'Tarea eliminada', 'icon' => 'success'];
        } else {
            return ['status' => '201', 'message' => 'Problemas al eliminar tarea', 'icon' => 'warning'];
        }
      }else {
        return ['status' => '500', 'message' => 'problemas en la conexion al intentar eliminar la tarea', 'icon' => 'error'];
      }
    }

    public function estadisticas(){
      $consulta = "call sp_consultarEstadisticas()";
      $this->conexion = (CBaseDatos::get_instancia());
      $this->conexion->conectar();

      $resultado = mysqli_query($this->conexion->get_link_id(), $consulta);

      $datos = array();

      while($fila = mysqli_fetch_assoc($resultado)){
        $datos[] = $fila;
      }
      
      return $datos;
    }

  }
