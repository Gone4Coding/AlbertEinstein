<?php

require_once("inc/db.php");
require_once("inc/dbUtils.php");
?>

<?php if(isset ($msgerro)){?>
    <div class="col-xs-6">
        <?php echo $msgerro?>
    </div>
<?php }?>

<?php if(isset ($msg)){?>
    <div class="col-xs-6">
        <?php echo $msg?>
    </div>
<?php }?>


<form action="RegistoConsulta.php" method="get">
    <div class="row">
        <div class="col-xs-12">
            <h4>Nº SNS: <?php //echo $snsparam ?></h4>
        </div>
        <div class="col-xs-12">
            <h4>Nome: <?php //echo $nomeparam ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label for="sintomas">Sintomas:</label>
            <textarea rows="4" cols="40" id="idsintomas" name="sintomas" class="form-group"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <label for="diagnostico">Diagnóstico:</label>
            <textarea rows="4" cols="40" id="iddiagnostico" name="diagnostico" class="form-group"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <label for="medicamento">Medicamento:</label>
            <select id="idMedicamento" name="medicamento" class="form-group">
                <option value="1">1 </option>
                <option  value="2">2 </option>
                <option  value="3">3 </option>
            </select>
        </div>
    </div>
    <input type="submit" value="Enviar">
    <!--<input type="submit" value="Consultas Anteriores">-->
    <input type="reset" value="Limpar">
</form>