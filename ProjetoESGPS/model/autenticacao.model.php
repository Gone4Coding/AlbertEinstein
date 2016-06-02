<?php
require_once("inc/db.php");
require_once("inc/dbUtils.php");

// Verifica as credenciais (username e senha) de um determinado utilizador.
// Devolve o userID se for válido
// ou -1 se as credenciasi não forem válidas
function verificarCredenciais($username, $password){
    try {    



        $query= "SELECT id, password from utilizador where (username= ?) and (ativo='S')";

        $stmt = db()->prepare($query);

        $stmt->bind_param("s",$username);

        $stmt->execute();

        $stmt->bind_result($userID, $PasswordBD);

        //Se consulta não devolver linhas (user ID não existe):
        if (!$stmt->fetch())
            throw new Exception("Não existe o username ou está desativado");
        //Se senha incorreta:

        // Nota: para testar utilizamos uma comparação simples de strings
        // Na versão final teremos de utilizar a hash
        //if (!password_verify($password, $PasswordBD))
          //  return -1;

        if (strcmp($password, $PasswordBD))
            return -1;
    } catch (Exception $e) {
        return -1;
    } 
    

    return $userID;
}

// Verifica se a senha de um determinado utilizador é válida
// Devolve true se senha está correta
// caso contrário, devolve false 
function verificarSenha($user, $password){
    try {    
        $query= "SELECT password from utilizador where id= ?";
        $stmt = db()->prepare($query);
        $stmt->bind_param("i",$user);
        $stmt->execute();
        $stmt->bind_result($PasswordBD);
        //Se consulta não devolver linhas (user ID não existe):
        if (!$stmt->fetch())
            throw new Exception("Não existe o UserID");
        //Se senha incorreta:
        if (!password_verify($password, $PasswordBD))
            return false;
    } catch (Exception $e) {
        return false;
    } 
    return true;
}

// Altera a senha de um determinado utilizador
// Devolve true se alterou corretamente
// Devolve false se não alterou
function alterarSenha($user, $NovaSenha){
    try {    
        $query= "UPDATE utilizador set password=? where id=?";
        $stmt = db()->prepare($query);
        $hash = password_hash($NovaSenha, PASSWORD_DEFAULT);
        $stmt->bind_param("si", $hash, $user);
        $stmt->execute();
        return $stmt->affected_rows == 1;
    } catch (Exception $e) {
        return false;
    } 
} 

function getURLFotoUser($id){
    if (is_null($id))
        return "img-fotos/desconhecido.png";
    if (trim($id) == "")
        return "img-fotos/desconhecido.png";
    if (file_exists ("img-fotos/$id.png"))
        return "img-fotos/$id.png";
    if (file_exists ("img-fotos/$id.jpg"))
        return "img-fotos/$id.jpg";
    if (file_exists ("img-fotos/$id.jpeg"))
        return "img-fotos/$id.jpeg";
    return "img-fotos/desconhecido.png";
}

// Verifica se as credenciais username/senha são válidas.
// Devolve NULL se as credenciais forem inválidas
// Se as credenciais forem válidas, devolve um array com 
// informação sobre o utilizador (e aluno se for caso disso)
function getUserInfoFromCredenciais($username, $password){
    try {


       
        $userID = verificarCredenciais($username, $password);

     

        if ($userID<0)
            throw new Exception("Credenciais inválidas");

        $query= "SELECT username, password, tipo FROM utilizador WHERE id=?";
        $stmt = db()->prepare($query);
        $stmt->bind_param("i",$userID);
        $stmt->execute();;
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    } catch (Exception $e) {
        return array();        
    }        
}





// Função de validação dos campos do formulário de login
function validarLogin($username, $password){
    $arrayMensagens = array();

    if (trim($username)=="")
        $arrayMensagens["username"] = "Username é obrigatório";

    if (trim($password)=="")
        $arrayMensagens["password"] = "Password é obrigatória";

    return $arrayMensagens; 
}


function isUserLogged(){
    return isset($_SESSION['UserInfo']);
}

function isUserAnonimo(){
    return !isUserLogged();
}

function isUserAdministrativo(){
    if (isset($_SESSION['UserInfo']))
        return $_SESSION['UserInfo']['tipo']=='S';
    return false;
}
function isUserEnfermeiro(){
    if (isset($_SESSION['UserInfo']))
        return $_SESSION['UserInfo']['tipo']=='E';
    return false;
}
function isUserMedico(){
    if (isset($_SESSION['UserInfo']))
        return $_SESSION['UserInfo']['tipo']=='M';
    return false;
}
function isUserAdministrador(){
    if (isset($_SESSION['UserInfo']))
        return $_SESSION['UserInfo']['tipo']=='A';
    return false;
}

function getUserInfo(){
    if (isset($_SESSION['UserInfo']))
        return $_SESSION['UserInfo'];
    return array();
}
