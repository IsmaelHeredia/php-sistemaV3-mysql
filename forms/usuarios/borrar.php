<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/usuarioDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

$usuarioDatos = new UsuarioDatos();

$id = 0;

if(isset($_GET["id_usuario"])) {
  $id = $_GET["id_usuario"];
}

$usuario = $usuarioDatos->Cargar($id);
$nombre_usuario = $usuario->getNombre();

?>

<div class="jumbotron">
  <form method="POST" action="forms/usuarios/datos.php">
    <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo htmlentities($id); ?>" />
    <fieldset>
        <div class="text-center">
            <h1>Eliminacíon</h1>
            <p class="lead">¿Estás seguro que deseas eliminar al usuario <?php echo htmlentities($nombre_usuario); ?> ?</p>
            <p class="lead">
                <button type="submit" id="borrarUsuario" name="borrarUsuario" class="btn btn-danger boton-largo">Borrar</button>
                <a class="btn btn-primary boton-largo" href="administracion.php?tipo=listarUsuarios" role="button">Volver</a>
            </div>
        </div>
    </fieldset>
  </form>
</div>