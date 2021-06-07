<?php

	$salir = UsuarioController::logout();

	echo '<script>
		window.location = "ingreso";
	</script>';