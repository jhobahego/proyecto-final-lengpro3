<?php
    require_once '../models/mdlTarea.php';

    if( !isset( $_POST['accion'] ) ){
        echo 'No se determinó qué operación hacer.';
    }

    $objeto = new Tarea();

    if( isset( $_POST['titulo'] ) ){
        $objeto->setTitulo( $_POST['titulo'] );
    }
    if( isset( $_POST['descripcion'] ) ){
        $objeto->setDescripcion( $_POST['descripcion'] );
    }

    if( $_POST['accion'] == 'guardar' ){
        $data = $objeto->guardar();

        header('Content-type: application/json');
        echo json_encode( $data );
    }

    if( $_POST['accion'] == 'todos' ){
        $data = $objeto->consultarTodos();

        header('Content-type: application/json');
        echo json_encode( $data );
    }

    if( $_POST['accion'] == 'consultar' ){
        $data = $objeto->consultar($_POST['id']);

        $datos = array();
        if( $data instanceof mysqli_result){
            if($fila = mysqli_fetch_assoc($data)) {
                $datos[] = $fila;
            }
        }elseif(is_array($data)){
            $datos[] = $data;
        }

        header('Content-type: application/json');
        echo json_encode( $datos );
    }

    if( $_POST['accion'] == 'actualizar' ){
        $data = $objeto->actualizar( $_POST['id']);

        header('Content-type: application/json');
        echo json_encode( $data );
    }

    if( $_POST['accion'] == 'finalizada' ){
        $data = $objeto->tareaCompletada( $_POST['id']);

        header('Content-type: application/json');
        echo json_encode( $data );
    }

    if( $_POST['accion'] == 'eliminar' ){
        $data = $objeto->eliminarTarea( $_POST['id']);

        header('Content-type: application/json');
        echo json_encode( $data );
    }
?>