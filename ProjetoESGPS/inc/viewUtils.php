<?php

function getFieldValue($key, $data){
	if (array_key_exists($key, $data))
		return $data[$key];
	else
		return "";
} 

function echoFieldValue($key, $data){
	echo " value='" . getFieldValue($key, $data) . "' ";
} 

function echoValue($key, $data){
	if (array_key_exists($key, $data))
		echo $data[$key];
} 

function echoMsgErro($key, $arrayMensagens){
	if (array_key_exists($key, $arrayMensagens))
		echo "<span class='help-block'>" . $arrayMensagens[$key] . "</span>";
} 

function echoAlertClass($tipoMensagem){
	switch ($tipoMensagem){
		case 'A': echo "alert alert-warning";
				  break;	
		case 'E': echo "alert alert-danger alert-error";
				  break;	
		case 'S': echo "alert alert-success";
				  break;	
		case 'I': echo "alert alert-info";
				  break;	
		default:  echo "alert";
				  break;			  
	}
}

function echoTipoMensagem($tipoMensagem){
	switch ($tipoMensagem){
		case 'A': echo "Aviso!";
				  break;	
		case 'E': echo "Erro!";
				  break;	
		case 'S': echo "OK!";
				  break;	
		case 'I': echo "Informação:";
				  break;	
		default:  echo "Mensagem:";
				  break;			  
	}
}

function echoClassformGroup($key, $arrayMensagens, $submeteuDados){
	if ($submeteuDados){
		if (array_key_exists($key, $arrayMensagens))
			echo " class='form-group has-error'";
		else 
			echo " class='form-group has-success'";
	}
	else {  // Não submeteu dados
		echo " class='form-group'";
	}
}

function selectListOfValues($arrayValues, $selectedValue, $extraValue="", $extraShowValue=""){
	$str = "";
	if ($extraValue != ""){
		if ($extraValue == $selectedValue)
			$str.= "\n<option value='$extraValue' selected>$extraShowValue</option>";
		else
			$str.= "\n<option value='$extraValue'>$extraShowValue</option>";
	}

	foreach($arrayValues as $key => $valueToShow){
		if ($key == $selectedValue)
			$str.= "\n<option value='$key' selected>$valueToShow</option>";
		else
			$str.= "\n<option value='$key'>$valueToShow</option>";
	}
	return $str;
}

