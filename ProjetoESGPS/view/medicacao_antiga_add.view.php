<?php require_once("inc/viewUtils.php") ?>

<?php if (isset($msgGlobal)) : ?><!-- Aviso Paciente -->

    <div class="<?php echoAlertClass($tipoMsgGlobal); ?>">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echoTipoMensagem($tipoMsgGlobal); ?></strong> <?php echo $msgGlobal; ?>
    </div>
<?php endif; ?>

<div class="col-lg-3"><!-- Detalhes Paciente -->
    <h3>Utente</h3>
    <div class="row">
        <div class="col-xs-12">
            <label for="idnum_utente">Número de Utente</label>
            <p id="idnum_utente" class="form-control-static"><?php echoValue('num_utente', $paciente[0]) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label for="idnome">Nome</label>
            <p id="idnome" class="form-control-static"><?php echoValue('nome', $paciente[0]) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label for="iddata_nascimento">Data de Nascimento</label>
            <p id="iddata_nascimento"
               class="form-control-static"><?php echoValue('data_nascimento', $paciente[0]) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label for="idtipo_sangue">Tipo de Sangue</label>
            <p id="idtipo_sangue" class="form-control-static"><?php echoValue('tipo_sangue', $paciente[0]) ?></p>
        </div>
    </div>
</div><!-- /Detalhes Paciente -->

<div class="col-lg-4"><!-- Formulario -->
    <form action="medicacao_antiga_add.php".<?php $_SESSION["num_utente_para_alterar"] = $paciente[0]["num_utente"] ?>
          method="post" class="form-group">
        <div class="row ">
            <div class="col-xs-12">
                <label for="idmedicamento">Medicamento </label>
                <select id="ididmedicamento" name="idmedicamento" class="form-group" style="width: 400px">
                    <?php
                    foreach ($medicamentos as $linha) {
                        echo '<option value="' . $linha["nome"] . '">' . $linha["nome"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-xs-12">
                <div<?php echoClassformGroup('data_comeco', $msgErros, $dadosSubmetidos); ?>>
                    <label for="data_comeco">Data de Início de Toma</label>
                    <input type="date" id="iddata_comeco" name="data_comeco" class="form-group" style="height:25px">
                    <?php echoMsgErro("data_comeco", $msgErros); ?>
                </div>
            </div>

            <div class="col-xs-12">
                <div<?php echoClassformGroup('data_fim', $msgErros, $dadosSubmetidos); ?>>
                    <label for="data_fim">Data de Fim de Toma</label>
                    <input type="date" id="iddata_fim" name="data_fim" class="form-group" style="height:25px">
                    <?php echoMsgErro("data_fim", $msgErros); ?>
                </div>
            </div>

            <div class="col-xs-12">
                <div<?php echoClassformGroup('motivo', $msgErros, $dadosSubmetidos); ?>>
                    <label for="idmotivo">Motivo</label>
                    <input type="text" id="idmotivo" name="motivo" class="form-group">
                    <?php echoMsgErro("motivo", $msgErros); ?>
                </div>
            </div>

            <div class="col-xs-12">
                <input type="submit" id="idSubmit" name="submitMed" value="Adicionar" class="form-group">
            </div>
        </div>
    </form><!-- Formulario -->
</div>


<div class="col-lg-5 ScrollStyle"><!-- Scroll MedsAntigas -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Data de Início</th>
            <th>Data de Fim</th>
            <th>Nome</th>
            <th>Motivo</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (isset($medicamentosPaciente)) {
            foreach ($medicamentosPaciente as $linha) {
                echo "\n<tr>";
                echo '<td><a class="btn btn-info" href="medicacao_antiga_alterar.php?num_utente=' . $linha["num_utente"] .'&idMedAntiga='.$linha["idMedAntiga"]. '" role="button">Ver</a></td>';
                echo "<td>" . $linha["data_comeco"] . "</td>";
                echo "<td>" . $linha["data_fim"] . "</td>";
                echo "<td>" . $linha["nome"] . "</td>";
                echo "<td>" . $linha["motivo"] . "</td>";
            }
        }
        ?>
        </tr>
        </tbody>
    </table>
</div>
