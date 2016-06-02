 <?php
require_once("inc/db.php");
require_once("inc/dbUtils.php");
   
function filterUtilizadoresNome($username){

	$username = "%$username%";
	$query= "SELECT * FROM `utilizador` WHERE (username like ?) ";
	$stmt = db()->prepare($query);
	$username = trim($username).'%';
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result->fetch_all(MYSQL_ASSOC);
}


 function getAllUsers(){


	 $query = "SELECT id,username,tipo, ativo ".
		 "FROM utilizador";

	 $stmt = db()->prepare($query);
	 $stmt->execute();
	 $result = $stmt->get_result();

	 return $result->fetch_all(MYSQL_ASSOC);

 }

function apagarUtilizador($id)
{
	try { 
		$query = "DELETE from utilizador WHERE id=?";
		$stmt= db()->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		// Nota: Se o delete correu bem, a propriedade affected_rows deve ter o seguinte valor:
		// 1 - foi apagado um registo
		if (db()->affected_rows !=1)
			throw new Exception("Erro - algo se passou");
	} catch(Exception $e) {
		return false;
	}
	return true;
} 

function alterarUtilizador( $username, $tipo)
{

	try {
		$query = "UPDATE utilizador ".
			" SET username=? , tipo=? ".
			" WHERE id=? ";
		$stmt= db()->prepare($query);
		$stmt->bind_param("ssi", $username, $tipo, $id);
		$stmt->execute();
		// Nota: Se o update correu bem, a propriedade affected_rows deve ter os seguintes valores:
		// 1 - foi alterado um registo
		// 0 - a operação correu bem, mas não foi alterado nada (não afetou nenhum registo)
		if (db()->affected_rows != 1)
			throw new Exception("Erro - algo se passou");
	} catch(Exception $e) {
		return false;
	}
	return true;
}

function validarUtilizador($username, $tipo){
	$arrayMensagens = array();

	if (trim($username)=="")
		$arrayMensagens["username"] = "Username é obrigatorio";

		/*if (trim($password)=="")
		$arrayMensagens["password"] = "Password é obrigatoria";*/

	if ($tipo=="")
		$arrayMensagens["utilizador"] = "O Tipo Utilizador é obrigatorio";

	

	return $arrayMensagens;	
} 

function inserirUtilizador($username, $password,$tipo)
{
	try {
		$query = "INSERT INTO utilizador (username, password, tipo) VALUES (?, ?, ?)";
		$stmt= db()->prepare($query);
		//$hash = password_hash($senha, PASSWORD_DEFAULT);
		$stmt->bind_param("sss", $username, $password, $tipo);
		$stmt->execute();
		// Nota: Se o insert correu bem, a propriedade affected_rows deve ter o seguinte valor:
		// 1 - foi inserido um registo
		if (db()->affected_rows !=1)
			throw new Exception("Erro - algo se passou");
	} catch(Exception $e) {
		return -1;
	}
	return db()->insert_id;
}

function obtemUtilizador($id)
{
	$query = "SELECT * FROM utilizador WHERE id=? ";
	$stmt= db()->prepare($query);
	$stmt->bind_param("i",$id);
	$stmt->execute();
	$result = $stmt->get_result();
	$arrayFromDB= $result->fetch_all(MYSQL_ASSOC);
	if (count($arrayFromDB) != 1)
		return NULL;
	else
		return $arrayFromDB[0];
}

function ativarUser($id)
{
	try {
		$query = "UPDATE users SET ativo=1 WHERE id=?";
		$stmt= db()->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		// Nota: Se o update correu bem, a propriedade affected_rows deve ter os seguintes valores:
		// 1 - foi alterado um registo
		// 0 - a operação correu bem, mas não foi alterado nada (não afetou nenhum registo)
		if ((db()->affected_rows >1) || (db()->affected_rows <0))
			throw new Exception("Erro - algo se passou");
	} catch(Exception $e) {
		return 0;
	}
	return 1;
}

function desativaUser($id)
{
	try {
		$query = "UPDATE users SET ativo=0 WHERE id=?";
		$stmt= db()->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		// Nota: Se o update correu bem, a propriedade affected_rows deve ter os seguintes valores:
		// 1 - foi alterado um registo
		// 0 - a operação correu bem, mas não foi alterado nada (não afetou nenhum registo)
		if ((db()->affected_rows >1) || (db()->affected_rows <0))
			throw new Exception("Erro - algo se passou");
	} catch(Exception $e) {
		return 0;
	}
	return 1;
}



function saveFotoFile($ID, $originalName, $tmp_FileName){
	try {
		$extensao = strtolower(trim(extractExtension($originalName)));
		$newName = "img-fotos/$ID." . $extensao;
		deleteFotoFile($ID);
		move_uploaded_file($tmp_FileName, $newName);
		if (file_exists ($newName))
			return true;
		else
			return false;
	}
	catch (Exception $e) {
		return false;
	}
} 

function deleteFotoFile($ID){
	try {
		if (file_exists ("img-fotos/$ID.png"))
			unlink ("img-fotos/$ID.png");
		if (file_exists ("img-fotos/$ID.jpg"))
			unlink ("img-fotos/$ID.jpg");
		if (file_exists ("img-fotos/$ID.jpeg"))
			unlink ("img-fotos/$ID.jpeg");
		return true;
	}
	catch (Exception $e) {
		return false;
	}
}

function checkFileFoto($array_FILE){
	if ($array_FILE["size"]<=0)
		return false;
	if ($array_FILE["size"]>16777216)
		return false;
	$extensao = strtolower(trim(extractExtension($array_FILE["name"])));
	if (($extensao != "jpg") && ($extensao != "png") && ($extensao != "jpeg"))
		return false;
	if (($array_FILE["type"] != "image/jpeg") && ($array_FILE["type"] != "image/png"))
		return false;
	return true;
} 

