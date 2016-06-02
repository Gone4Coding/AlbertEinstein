<?php 

	require_once("inc/controllerInit.php");
	

	http_response_code(404);
	$tituloPagina = "Recurso não encontrado";

	require("view/top.template.php");
	require("view/bottom.template.php");

