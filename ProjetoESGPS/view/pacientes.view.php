<?php require_once ("inc/viewUtils.php") ?>

<script type="text/javascript" language="JavaScript">
  function HidePart(d) {
    document.getElementById(d).style.display = "none";
  }

  function ShowPart(d) {
    document.getElementById(d).style.display = "block";
  }

  function CheckboxCheckedExame(b, d) {
    if (b) {
      ShowPart(d);
    }
    else {
      HidePart(d);
    }
  }

  function CheckboxCheckedMedAntiga(b, d) {
    if (b) {
      ShowPart(d);
    }
    else {
      HidePart(d);
    }
  }

  function CheckboxCheckedMedAtual(b, d) {
    if (b) {
      ShowPart(d);
    }
    else {
      HidePart(d);
    }
  }

 


  function confirmComplete() {
   
    var answer=confirm("Tem a certeza que pretende criar Paciente?");
    if (answer==true)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

</script>

  <div class="col-lg-4 ScrollStyle" id="listaPacientes">
    <!-------parte tablea e pesquisa------>
    <form action="pacientes.php" method="get" class="form-inline" >
      <div class="form-group">

        



        <select id="select" name = "opc" class="form-control" >
          <option value="">...</option>
          <option value="nome"<?php if ($opc=="nome")?>>Nome</option>
          <option value="num_utente"<?php if ($opc=="num_utente")?>>Nr Utente</option>
          <option value="nif"<?php if ($opc=="nif")?>>Nif</option>
          <option value="num_cc" <?php if ($opc=="num_cc")?>>CC</option>
          <option value="num_seg_social" <?php if ($opc=="num_seg_social")?>>Nr Seg. Social</option>
          <option value="naturalidade" <?php if ($opc=="naturalidade")?>>Naturalidade</option>
          <option value="nacionalidade" <?php if ($opc=="nacionalidade")?>>Nacionalidade</option>

        </select>

        <input type="text" id="nome" class="form-control"  name="var" value="<?php  echo $var;?>" >

        <input class="btn btn-default" value="Pesquisar" type="submit">

        </input>

      </div>
    </form>
    
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Nome</th>
        <th>Numero Utente</th>


        <th></th>
      </tr>
      </thead>
      <tbody>


      <?php

      if(isset($pacientesAbre)){
      foreach ($pacientesAbre as $linha) {
        echo "\n<tr>";
        echo "<td>".$linha['nome']."</td>";
        echo "<td>".$linha['num_utente']."</td>";

        echo '<td><a class="btn btn-info" href="pacientes_detalhe.php?num_utente='.$linha["num_utente"].'" role="button">Ver</a></td>';


        ?>
        </tr>
        <?php


      } }else {

      foreach ($pacientes as $linha) {
        echo "\n<tr>";
        echo "<td>".$linha['nome']."</td>";
        echo "<td>".$linha['num_utente']."</td>";

        echo '<td><a class="btn btn-info" href="pacientes_detalhe.php?num_utente='.$linha["num_utente"].'" role="button">Ver</a></td>';
        

        ?>
        </tr>
        <?php


      }}?>






      </tbody>
    </table>




  </div>


<div class="col-lg-2">



</div>





  <div class="col-lg-6">

    <!-------formulario------>

    <?php if (isset($msgGlobal)) : ?>

      <div class="<?php echoAlertClass($tipoMsgGlobal);?>">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echoTipoMensagem($tipoMsgGlobal); ?></strong> <?php echo $msgGlobal;?>
      </div>
    <?php endif; ?>



    <form action="pacientes.php" method="post" class="form-horizontal">
    




        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('nome',$msgErros,$dadosSubmetidos);?>>
              <label class="col-md-2 control-label"  for = "nome">Nome: </label>
              <div class="col-lg-8">
              <input type = "text" id = "idnomePaciente" name = "nome" class='form-control' <?php echoFieldValue("nome", $data);?>>
              <?php echoMsgErro("nome",$msgErros); ?>
                </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('morada',$msgErros,$dadosSubmetidos);?>>
              <label class="col-md-2 control-label"  for = "morada">Morada: </label>
              <div class="col-lg-8">
              <input type = "text" id = "idmorada" name = "morada" class='form-control' <?php echoFieldValue("morada", $data);?>>
              <?php echoMsgErro("morada",$msgErros); ?>

              </div>
              </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('codigo_postal',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label"  for = "codigoPostal">Código-Postal: </label>
              <div class="col-lg-8">
              <input type = "text" id = "idcodigo_postal" name = "codigo_postal" class='form-control'  <?php echoFieldValue("codigo_postal", $data);?>>
              <?php echoMsgErro("codigo_postal",$msgErros); ?>

              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('data_nascimento',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label"  for = "data_nascimento">Data de Nascimento: </label>
              <div class="col-lg-8">
              <input type = "date" id = "iddata_nascimento" name = "data_nascimento" class='form-control' <?php echoFieldValue("data_nascimento", $data);?>>
              <?php echoMsgErro("data_nascimento",$msgErros); ?>
              </div>

            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('nacionalidade',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label"  for = "nacionalidade">Nacionalidade: </label>
              <div class="col-lg-8">
              <input type = "text" id = "nacionalidade" name = "nacionalidade" class='form-control'  <?php echoFieldValue("nacionalidade", $data);?>>
              <?php echoMsgErro("nacionalidade",$msgErros); ?>

              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('naturalidade',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label"  for = "naturalidade">Naturalidade: </label>
              <div class="col-lg-8">
              <input type = "text" id = "idnaturalidade" name = "naturalidade" class='form-control' <?php echoFieldValue("naturalidade", $data);?>>
              <?php echoMsgErro("naturalidade",$msgErros); ?>

              </div>

            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('genero',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label" for = "sexo">Sexo: </label>

              <div class="col-lg-8">
                <label class="radio-inline" for="genero-0">
                  <input type="radio" name="genero" id="genero-0" value="M" checked="checked">
                  M
                </label>
                <label class="radio-inline" for="genero-1">
                  <input type="radio" name="genero" id="genero-1" value="F">
                  F
                </label>
              </div>
              <?php echoMsgErro("sexo",$msgErros); ?>
            </div>
          </div>
        </div>


        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('num_cc',$msgErros,$dadosSubmetidos);?>>


                <label class="col-md-2 control-label"  for = "num_cc">Nº CC/BI: </label>
              <div class="col-lg-8">
                <input type = "number" id = "idnumeroCC" name = "num_cc" class='form-control' <?php echoFieldValue("num_cc", $data);?>>
                <?php echoMsgErro("num_cc",$msgErros); ?>
              </div>


            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('num_seg_social',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label"  for = "num_seg_social">Nº Segurança Social: </label>
              <div class="col-lg-8">
              <input type = "number" id = "idnumeroSegSocial" name = "num_seg_social" class='form-control'  <?php echoFieldValue("num_seg_social", $data);?>>
              <?php echoMsgErro("num_seg_social",$msgErros); ?>

              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('num_utente',$msgErros,$dadosSubmetidos);?>>
              <label  class="col-md-2 control-label" for = "num_utente">Nº Utente: </label>
              <div class="col-lg-8">
              <input type = "number" id = "idnumeroUtente" name = "num_utente" class='form-control'  <?php echoFieldValue("num_utente", $data);?>>
              <?php echoMsgErro("num_utente",$msgErros); ?>
              </div>

            </div>
          </div>
        </div>

        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('nif',$msgErros,$dadosSubmetidos);?>>
              <label class="col-md-2 control-label" for = "nif">NIF: </label>
              <div class="col-lg-8">
              <input type = "number" id = "idnif" name = "nif" class='form-control'  <?php echoFieldValue("nif", $data);?>>
              <?php echoMsgErro("nif",$msgErros); ?>
              </div>

            </div>
          </div>
        </div>


        <div class='row'>
          <div class="form-group">
            <div<?php echoClassformGroup('contato_emergencia',$msgErros,$dadosSubmetidos);?>>
              <label class="col-md-2 control-label" for = "contato_emergencia">Contato de Emergencia: </label>
              <div class="col-lg-8">
                <input type = "number" id = "idContato_emergencia" name = "contato_emergencia" class='form-control' placeholder="Opcional" min="0" max="999999999" <?php echoFieldValue("contato_emergencia", $data);?>>
                <?php echoMsgErro("contato_emergencia",$msgErros); ?>
              </div>

            </div>
          </div>
        </div>

        <?php if(isUserAdministrativo()){?>
        <div class="row">
          <div class="form-group">
            <div<?php echoClassformGroup('tipo_sangue',$msgErros,$dadosSubmetidos);?>>
              <label class="col-md-2 control-label" for="tipoSangue">Tipo de Sangue:</label>
              <div  class="col-lg-8">
              <select id="idTipoSangue" name="tipo_sangue" class="form-control">
                <option value="A Rh+"<?php if ($tipoSangue=="A Rh+")?>>A Rh+</option>
                <option value="A Rh-"<?php if ($tipoSangue=="A Rh-")?>>A Rh-</option>
                <option value="A Rh-"<?php if ($tipoSangue=="B Rh+")?>>B Rh+</option>
                <option value="B Rh-"<?php if ($tipoSangue=="B Rh-")?>>B Rh-</option>
                <option value="AB Rh+"<?php if ($tipoSangue=="AB Rh+")?>>AB Rh+</option>
                <option value="AB Rh-"<?php if ($tipoSangue=="AB Rh-")?>>AB Rh-</option>
                <option value="0 Rh+"<?php if ($tipoSangue=="0 Rh+")?>>0 Rh+</option>
                <option value="0 Rh-"<?php if ($tipoSangue=="0 Rh-")?>>0 Rh-</option>
              </select>
              <?php echoMsgErro("tipo_sangue",$msgErros);?>
              </div>
            </div>
          </div>
        </div>

          <div class="row">
            <div class="panel-body">
              <div<?php echoClassformGroup('alergia',$msgErros,$dadosSubmetidos);?>>
                <label class="col-md-2 control-label" for="alergia">Alergias: </label>
                <div class="col-lg-8">
                  <textarea type="text" id="idalergia" name="alergia" class="form-control" rows="5"  value""></textarea>
                  <?php echoMsgErro("alergia",$msgErros);?>
                </div>
              </div>
            </div>
          </div>



      <?php }; ?>

        <div class="row">
          <div class='col-lg-12 text-center'>
            <input type="submit" id = "idSubmit"  value = "Criar Paciente" class='btn btn-primary'>


            <input type="reset" id="idReset" value="Limpar Campos" class="btn btn-primary">
          </div>
        </div>
    </form>





  </div>

<script type="text/javascript">
  CheckboxCheckedExame(document.formNovoPaciente.checkExame.checked, 'checkboxExame');
  CheckboxCheckedMedAtual(document.formNovoPaciente.checkMedicacaoAtual.checked, 'checkboxMedAtual');
  CheckboxCheckedMedAntiga(document.formNovoPaciente.checkMedicacaoAntiga.checked, 'checkboxMedAntiga');
</script>