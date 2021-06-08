<?php

class Conexion {

	static public function conectar() {
		//servidev.tk
		//servidev_
		//servidev_dev-grifos -> grifos2020@
		$link = new PDO("mysql:host=servidev.tk;dbname=servidev_grifos", "servidev_dev-grifos", "grifos2020@");
		$link->exec("set names utf8");
		return $link;
	}

}