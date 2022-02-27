<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

?>
<?php if(!isset($_SESSION)) { session_start(); } ?>
        </section>
		<?php

		while (! file_exists("functions") ) {
		    chdir("..");
		}

		include_once("config/vars.php");

		global $session_mensaje;

		if(isset($_SESSION[$session_mensaje])) {
		    $mensaje = $_SESSION[$session_mensaje];
		    unset($_SESSION[$session_mensaje]);
		    echo "<script>alert(\"". htmlentities($mensaje) ."\")</script>";
		}

		?>
    </body>
</html>