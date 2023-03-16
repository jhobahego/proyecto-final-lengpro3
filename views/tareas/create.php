<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <base href="http://localhost/ProyectoFinalLenPro3/">
  <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
  <title>Tareas | Crear</title>
</head>

<body>
  <div class="container-fluid">
    <header>
      <div class="container menuContainer my-4"></div>
    </header>
    <main>
      <div class="container my-4">
        <div class="card">
          <h5 class="card-header">Crear tarea</h5>
          <div class="card-body">
            <form action="" id="formulario">
              <div class="row mb-4">
                <div class="form-group col">
                  <label for="titulo">Titulo</label>
                  <input type="text" class="form-control" name="titulo" id="titulo">
                  <label for="descripcion">Descripcion</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion">
                </div>
              </div>
              <input type="button" id="guardar" class="btn btn-primary" value="Guardar"></input>
              <a href="views/tareas/index.html" class="btn btn-danger">cancelar</a>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    $(document).ready(function () {
      $('.menuContainer').load('views/layouts/navbar.html');
    });

    function validarDatos() {
      let titulo = document.getElementById('titulo');
      let descripcion = document.getElementById('descripcion');
      titulo.value = titulo.value.trim();
      descripcion.value = descripcion.value.trim();
      if(titulo.value == 0){
        titulo.focus();
        Swal.fire({
          text: 'Se requiere ingresar un titulo',
          icon: 'info'
        })
        return false;
      }else if(descripcion.value == 0){
        descripcion.focus();
        Swal.fire({
          text: 'Se requiere ingresar una descripción',
          icon: 'info'
        })
        return false;
      }
      return true;
    }

    function guardarDatos() {
      let datos = $("#formulario").serialize();
      $.ajax({
        url: "controllers/ctrlTarea.php",
        type: "POST",
        data: datos + "&accion=guardar",
        success: function (msj) {
          Swal.fire({
            text: msj['message'],
            icon: msj['icon']
          }).then((result) => {
            if(result.isConfirmed){
              location.replace("views/tareas/index.html");
            }
          })
        },
        error: function (msj) {
          Swal.fire({
            text: msj['message'],
            icon: msj['icon']
          })
        },

      });
    }

    function guardar() {
      if(validarDatos()){
        guardarDatos();
      }
    }

    document.getElementById('guardar').addEventListener('click', function () {
      guardar();
    });
  </script>
</body>

</html>