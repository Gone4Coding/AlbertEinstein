<?php
require("view/top.template.php");
require("view/bottom.template.php");
//chupamos tu
?>
<!DOCTYPE HTML>
<html>
<body>
<img src="img/person.png" alt="Person" style="width:180px;height:180px;position: absolute; top: 150px; left: 50px;">
<link rel="stylesheet" type="text/css" href="form.css">

<form action="#" method="get">
    <br><br>
Nome: <input type="text" name="name" size="45"><br><br>
Nº SNS: <input type="text" name="sns"><br><br>
    <br>
    <input type="submit" value="Pesquisar">
    <input type="reset" value="Limpar">
</form>


</body>
</html>