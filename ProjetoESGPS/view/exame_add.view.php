<?php require_once("inc/viewUtils.php") ?>

<?php if (isset($msgGlobal)) : ?>

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
    <h3></h3>
    <form action="exame_add.php".<?php $_SESSION["num_utente_para_alterar"] = $paciente[0]["num_utente"];?> method="post" class="form" enctype="multipart/form-data">
        <div class="row ">
            <div class="col-xs-12">
                <label for="tipo_exame">Tipo de Exame </label>
                <select id="idtipo_exame" name="tipo_exame" class="form-group">
                    <?php
                    foreach ($todosExmes as $linha) {
                        echo '<option value="' . $linha["id_especialidade"] . '">' . $linha["especialidade"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-xs-12">
                <div<?php echoClassformGroup('data_exame', $msgErros, $dadosSubmetidos); ?>>
                    <label for="data_exame">Data de Realização</label>
                    <input type="date" id="iddata_exame" name="data_exame" class="form-group" style="height:25px">
                    <?php echoMsgErro("data_exame", $msgErros); ?>
                </div>
            </div>

            <div class="col-xs-12">
                <div<?php echoClassformGroup('exame_fisico', $msgErros, $dadosSubmetidos); ?>>
                    <input type="file" id="idexame_fisico" name="exame_fisico" value="Caminho" class="form-group">
                    <?php echoMsgErro("exame_fisico", $msgErros); ?>
                </div>
            </div>

            <div class="col-xs-12">
                <input type="submit" id="idSubmit" name="submitExame" value="Adicionar" class="form-group">

            </div>
        </div>
    </form>
</div><!-- /Formulario -->

<div class="col-lg-5 ScrollStyle" style="height: 400px"><!-- Scroll Exames -->
    <table class="table table-striped" >
        <thead>
        <tr>
            <th>    </th>
            <th>Exame Nº</th>
            <th>Data de Exame</th>
            <th>Especialidade</th>
        </tr>
        </thead>

        <tbody>
        <?php
        if (isset($examesPaciente)) {
            $num_exame = 1;
            foreach ($examesPaciente as $linha) {
                echo "\n<tr>";
                echo '<td><a class="btn btn-info" href="exame_alterar.php?num_utente=' .$linha["num_utente"] . '&idExame='. $linha["idExame"].'" role="button">Ver</a></td>';
                echo "<td>" . $num_exame . "</td>";
                echo "<td>" . $linha["data_exame"] . "</td>";
                echo "<td>" . $linha["especialidade"] . "</td>";
                $num_exame++;
            }
        }
        ?>
        </tr>
        </tbody>
    </table>
</div><!-- /Scroll Exames -->
