<?php

/**
 * Getters
 */

include("virtualfs.php");

try{

	$result = null;

	$method = strtolower($_GET["method"]);

	switch ($method) {
		case 'main':
    		$flow = $_GET["flow"];
    		$result = VirtualFS::getRoot($flow);
    		break;
		case 'collection':
		case 'element':
			$id = $_GET["id"];
			$result = VirtualFS::getData($method, $id);
			break;
		case 'components';
			$components = $_GET["components"];
			$result = VirtualFS::getComponents($components);
			break;
	}

	header('Content-Type: application/json');
    echo $result;

} catch(Exception $e) {
	echo "Parámetros de entrada inválidos.";
}