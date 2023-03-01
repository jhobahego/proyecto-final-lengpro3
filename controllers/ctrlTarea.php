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

        //$data = [ 'name' => 'God', 'age' => -1 ];
        header('Content-type: application/json');
        echo json_encode( $data );

        //echo $respuesta;
    }
?>