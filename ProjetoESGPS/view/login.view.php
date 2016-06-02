 <?php  require_once("inc/viewUtils.php") ?> 

 <?php if (isset($msgGlobal)) : ?>
  <div class="<?php echoAlertClass($tipoMsgGlobal);?>">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <strong><?php echoTipoMensagem($tipoMsgGlobal);?></strong> <?php echo $msgGlobal;?>
  </div>
<?php endif; ?>  
<form action="login.php" method="post" class="form">
   <input type="hidden" name="redirectTo"<?php echoFieldValue("redirectTo", $data);?>>
    <div class='row'>
        <div class='col-xs-12 text-center'>   
            <h2>Login</h2>
        </div>
        <div class='col-xs-8 col-xs-offset-2'>    
            <div<?php echoClassformGroup('username',$msgErros,$dadosSubmetidos);?>>
                <label for="idUsername">Username</label>
                <input type="text" id="idUsername" name="username"<?php echoFieldValue("username", $data);?>class="form-control">
                <?php echoMsgErro("username",$msgErros); ?>
            </div>    
        </div>
        <div class='col-xs-8 col-xs-offset-2'>    
            <div<?php echoClassformGroup('password',$msgErros,$dadosSubmetidos);?>>
                <label for="idSenha">Senha</label>
                <input type="password" id="idSenha" name="password"<?php echoFieldValue("password", $data);?>class="form-control">
                <?php echoMsgErro("password",$msgErros); ?>
            </div>    
        </div>
        <div class='col-xs-12 text-center'> 
            <input type="reset" id="idReset" value="Limpar" class="btn btn-warning">  
            <input type="submit" id="idSubmit" value="Entrar" class="btn btn-primary"> 
        </div>
    </div>  
</form>    
