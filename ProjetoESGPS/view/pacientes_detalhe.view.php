<?php require_once("inc/viewUtils.php") ?>


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


</script>


<div class="col-lg-4 ScrollStyle">
    <!-------parte tablea e pesquisa------>
    <form action="pacientes.php" method="get" class="form-inline">
        <div class="form-group">
            <input type="text" id="nome" class="form-control" placeholder="Nome" name="nome"
                   value="<?php echo $nome; ?>">

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

        if (isset($pacientesAbre)) {
            foreach ($pacientesAbre as $linha) {
                echo "\n<tr>";
                echo "<td>" . $linha['nome'] . "</td>";
                echo "<td>" . $linha['num_utente'] . "</td>";

                echo '<td><a class="btn btn-info" href="pacientes_detalhe.php?num_utente=' . $linha["num_utente"] . '" role="button">Ver</a></td>';

                ?>
                </tr>
                <?php
}
        } else {
            foreach ($pacientes as $linha) {
                echo "\n<tr>";
                echo "<td>" . $linha['nome'] . "</td>";
                echo "<td>" . $linha['num_utente'] . "</td>";

                echo '<td><a class="btn btn-info" href="pacientes_detalhe.php?num_utente=' . $linha["num_utente"] . '" role="button">Ver</a></td>';

                ?>
                </tr>
                <?php
            }
        } ?>
        </tbody>
    </table>
</div>

<div class="col-lg-2">
</div>

<div class="col-lg-6">

    <!-------formulario------>

    <?php if (isset($msgGlobal)) : ?>

        <div class="<?php echoAlertClass($tipoMsgGlobal); ?>">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong><?php echoTipoMensagem($tipoMsgGlobal); ?></strong> <?php echo $msgGlobal; ?>
        </div>
    <?php endif; ?>

    <form action="pacientes_detalhe.php" method="post" class="form-horizontal">
        <fieldset>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('nome', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="nome">Nome: </label>
                        <div class="col-lg-8">
                            <input type="text" id="idnomePaciente" name="nome" class='form-control'
                                   value="<?php if (isset($paciente[0])) {
                                       echo getFieldValue('nome', $paciente[0]);
                                   } ?>">
                            <?php echoMsgErro("nome", $msgErros); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('morada', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="morada">Morada: </label>
                        <div class="col-lg-8">
                            <input type="text" id="idmorada" name="morada" class='form-control'
                                   value="<?php echo getFieldValue('morada', $paciente[0]) ?>">
                            <?php echoMsgErro("morada", $msgErros); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('codigo_postal', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="codigo_postal">Código-Postal: </label>
                        <div class="col-lg-8">
                            <input type="text" id="idcodigoPostal" name="codigo_postal" class='form-control'
                                   value="<?php echo getFieldValue('codigo_postal', $paciente[0]) ?>">
                            <?php echoMsgErro("codigo_postal", $msgErros); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('data_nascimento', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="data_nascimento">Data de Nascimento: </label>
                        <div class="col-lg-8">
                            <input type="text" id="iddataNascimento" name="data_nascimento" class='form-control'
                                   placeholder="yyyy-mm-dd"
                                   value="<?php echo getFieldValue('data_nascimento', $paciente[0]) ?>">
                            <?php echoMsgErro("data_nascimento", $msgErros); ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('nacionalidade', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="dataNascimento">Nacionalidade: </label>
                        <div class="col-lg-8">
                            <input type="text" id="nacionalidade" name="nacionalidade" class='form-control'
                                   value="<?php echo getFieldValue('nacionalidade', $paciente[0]) ?>">
                            <?php echoMsgErro("nacionalidade", $msgErros); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('naturalidade', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="naturalidade">Naturalidade: </label>
                        <div class="col-lg-8">
                            <input type="text" id="idnaturalidade" name="naturalidade" class='form-control'
                                   value="<?php echo getFieldValue('naturalidade', $paciente[0]) ?>">
                            <?php echoMsgErro("naturalidade", $msgErros); ?>

                        </div>

                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('genero', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="genero">Sexo: </label>

                        <div class="col-lg-8">
                            <label class="radio-inline" for="sexo-0">
                                <input type="radio" name="genero" id="genero-0"
                                       value="M" <?php if (getFieldValue('genero', $paciente[0]) == 'M') {
                                    echo "checked='.$s.'";
                                } ?>>
                                M
                            </label>
                            <label class="radio-inline" for="sexo-1">
                                <input type="radio" name="genero" id="genero-1"
                                       value="F" <?php if (getFieldValue('genero', $paciente[0]) == 'F') {
                                    echo "checked='.$s.'";
                                } ?>>
                                F

                        </div>
                        <?php echoMsgErro("genero", $msgErros); ?>
                    </div>
                </div>
            </div>


            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('num_cc', $msgErros, $dadosSubmetidos); ?>>


                        <label class="col-md-2 control-label" for="num_cc">Nº CC/BI: </label>
                        <div class="col-lg-8">
                            <input type="number" id="idnumeroCC" name="num_cc" class='form-control' maxlength="9"
                                   value="<?php echo getFieldValue('num_cc', $paciente[0]) ?>">
                            <?php echoMsgErro("num_cc", $msgErros); ?>
                        </div>


                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('num_seg_social', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="num_seg_social">Nº Segurança Social: </label>
                        <div class="col-lg-8">
                            <input type="number" id="idnumeroSegSocial" name="num_seg_social" class='form-control'
                                   maxlength="9" value="<?php echo getFieldValue('num_seg_social', $paciente[0]) ?>">
                            <?php echoMsgErro("num_seg_social", $msgErros); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('num_utente', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="num_utente">Nº Utente: </label>
                        <div class="col-lg-8">
                            <input type="number" id="idnumeroUtente" name="num_utente" class='form-control'
                                   maxlength="9" value="<?php echo getFieldValue('num_utente', $paciente[0]) ?>">
                            <?php echoMsgErro("num_utente", $msgErros); ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('nif', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="nif">NIF: </label>
                        <div class="col-lg-8">
                            <input type="number" id="idnif" name="nif" class='form-control' maxlength="9"
                                   value="<?php echo getFieldValue('nif', $paciente[0]) ?>">
                            <?php echoMsgErro("nif", $msgErros); ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class='row'>
                <div class="form-group">
                    <div<?php echoClassformGroup('contato_emergencia', $msgErros, $dadosSubmetidos); ?>>
                        <label class="col-md-2 control-label" for="contato_emergencia">Contato de Emergencia: </label>
                        <div class="col-lg-8">
                            <input type="number" id="idnif" name="contato_emergencia" class='form-control' maxlength="9"
                                   value="<?php echo getFieldValue('contato_emergencia', $paciente[0]) ?>">
                            <?php echoMsgErro("contato_emergencia", $msgErros); ?>
                        </div>

                    </div>
                </div>
            </div>

            <?php if (isUserAdministrativo()) { ?>
                <div class="row">
                    <div class="form-group">
                        <div<?php echoClassformGroup('tipo_sangue', $msgErros, $dadosSubmetidos); ?>>
                            <label class="col-md-2 control-label" for="tipoSangue">Tipo de Sangue:</label>
                            <div class="col-lg-8">
                                <select id="idTipoSangue" name="tipo_sangue" class="form-group">
                                    <option value="A Rh+"<?php if ($tipoSangue == "A Rh+") ?>>A Rh+</option>
                                    <option value="A Rh-"<?php if ($tipoSangue == "A Rh-") ?>>A Rh-</option>
                                    <option value="A Rh-"<?php if ($tipoSangue == "B Rh+") ?>>B Rh+</option>
                                    <option value="B Rh-"<?php if ($tipoSangue == "B Rh-") ?>>B Rh-</option>
                                    <option value="AB Rh+"<?php if ($tipoSangue == "AB Rh+") ?>>AB Rh+</option>
                                    <option value="AB Rh-"<?php if ($tipoSangue == "AB Rh-") ?>>AB Rh-</option>
                                    <option value="0 Rh+"<?php if ($tipoSangue == "0 Rh+") ?>>0 Rh+</option>
                                    <option value="0 Rh-"<?php if ($tipoSangue == "0 Rh-") ?>>0 Rh-</option>
                                </select>
                                <?php echoMsgErro("tipo_sangue", $msgErros); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel-body">
                        <div<?php echoClassformGroup('alergia', $msgErros, $dadosSubmetidos); ?>>
                            <label for="alergia">Alergias: </label>
                            <input type="text" id="idalergia" name="alergia" class="form-group" style="height: 100px">
                            <?php echoMsgErro("alergia", $msgErros); ?>
                        </div>
                    </div>
                </div>

                <div class="row"><!-- Historico -->
                    <div class='col-xs-12'>
                        <div<?php echoClassformGroup('historicoClinico', $msgErros, $dadosSubmetidos); ?>>
                            <label for="historicoClinico">Histórico Clínico (CD): </label>
                            <input type="file" id="idHistoricoClinico" name="historicoClinico" class="form-group-sm">
                            <?php echoMsgErro("historicoClinico", $msgErros); ?>
                        </div>
                    </div>
                </div><!-- /Historico -->

                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-4 text-center"><!-- CheckBox Exame -->
                            <label for="checkExame">Exames: </label>
                            <input type="checkbox" id="idcheckboxExame" name="checkExame" class="form-group"
                                   onclick="CheckboxCheckedExame(this.checked,'checkboxExame')">
                        </div><!-- /CheckBox Exame -->

                        <div class="col-xs-4 text-center"><!-- CheckBox Med antual -->
                            <label for="medicacaoAtual">Medicação Atual:</label>
                            <input type="checkbox" id="idcheckboxMedicacaoAtual" name="checkMedicacaoAtual"
                                   class="form-group"
                                   onclick="CheckboxCheckedMedAtual(this.checked,'checkboxMedAtual')">
                        </div><!-- /CheckBox Med antual -->

                        <div class="col-xs-4 text-center"><!-- CheckBox Med antiga -->
                            <label for="medicacaoAntiga">Medicação Antiga:</label>
                            <input type="checkbox" id="idcheckboxMedicacaoAntiga" name="checkMedicacaoAntiga"
                                   class="form-group"
                                   onclick="CheckboxCheckedMedAntiga(this.checked,'checkboxMedAntiga')">
                        </div><!-- /CheckBox Med antiga -->
                    </div>
                </div>

                <div class="row" id="checkboxExame" style="display: none;"><!-- Form Exame -->
                    <h4>Exames</h4>
                    <div class="col-xs-12">
                        <div class="col-xs-4"><!-- Tipo Exame -->
                            <div<?php echoClassformGroup('tipoExame', $msgErros, $dadosSubmetidos); ?>>
                                <label for="tipoExame">Tipo de Exame: </label>
                                <select id="idSelecTipoExame" name="tipoExame" class="form-group-sm">
                                    <!-- lista exames -->
                                </select>
                                <?php echoMsgErro("nif", $msgErros); ?>
                            </div>
                        </div><!-- /Tipo Exame -->

                        <div class="col-xs-4"><!-- Data Exame -->
                            <div<?php echoClassformGroup('dataExame', $msgErros, $dadosSubmetidos); ?>>
                                <label for="dataExame">Data de Exame: </label>
                                <input type="date" id="iddataExame" name="dataExame" class='form-control'>
                                <?php echoMsgErro("dataExame", $msgErros); ?>
                            </div>
                        </div><!-- Data Exame -->

                        <div class="col-xs-4"><!-- Caminho Exame -->
                            <div<?php echoClassformGroup('caminhoExame', $msgErros, $dadosSubmetidos) ?>>
                                <label for="caminhoExame">Caminho: </label>
                                <input type="file" id="idcaminhoExame" name="caminhoExame" class="form-group-sm">
                                <?php echoMsgErro("caminhoExame", $msgErros) ?>
                            </div>
                        </div><!-- /Caminho Exame -->
                    </div>
                </div><!-- /Form Exame -->

                      <!-- Form MedAtual -->
                <div class="row" id="checkboxMedAtual" style="display: none;">
                    <h4>Medicação Atual</h4>
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <div<?php echoClassformGroup('medicamentoAtual', $msgErros, $dadosSubmetidos); ?>>
                                <!-- Medicamento -->
                                <label for="medicamentoAtual">Medicamento: </label>
                                <select id="idSelecMedAtual" name="medicamentoAtual" class="form-group-sm">
                                    <?php
                                    foreach ($todosMedicamentos as $nome) {
                                        echo '<option value="' . $nome["nome"] . '">' . $nome["nome"] . '</option>';
                                    }
                                    ?>
                                </select>
                                <?php echoMsgErro("medicamentoAtual", $msgErros); ?>
                            </div><!-- /Medicamento -->
                        </div>
                        <div class="col-xs-4"><!-- Data Comeco Toma -->
                            <div<?php echoClassformGroup('dataToma', $msgErros, $dadosSubmetidos); ?>>
                                <label for="dataToma">Data da Toma - Desde: </label>
                                <input type="date" id="iddataToma" name="dataToma" class='form-control'>
                                <?php echoMsgErro("dataToma", $msgErros); ?>
                            </div>
                        </div><!-- /Data Comeco Toma -->

                        <div class="col-xs-4"><!-- Motivo Med Atual -->
                            <div<?php echoClassformGroup('motivoMedAtual', $msgErros, $dadosSubmetidos); ?>>
                                <label for="motivoMedAtual">Motivo: </label>
                                <input type="text" id="idmotivoMedAtual" name="motivoMedAtual" class='form-control'>
                                <?php echoMsgErro("motivoMedAtual", $msgErros); ?>
                            </div>
                        </div><!-- /Motivo Med Atual -->
                    </div>
                    <div class="col-xs-12 text-center">
                        <!--<input type="submit" id="idSubmitMedAtual" value="Adiconar Medicação" class='btn btn-primary'>-->
                    </div>
                </div>
                <!-- /Form MedAtual -->

                <div class="row" id="checkboxMedAntiga" style="display: none;"><!-- Form MedAntiga -->
                    <h4>Medicação Antiga</h4>
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <div<?php //echoClassformGroup('medicamentoAntigo', $msgErros, $dadosSubmetidos); ?>>
                                <!-- Medicamento -->
                                <label for="medicamentoAntigo">Medicamento: </label>
                                <select id="idSelecMedAntigo" name="medicamentoAntigo" class="form-group-sm">
                                    <?php
                                    foreach ($todosMedicamentos as $nome) {
                                        echo '<option value="' . $nome["nome"] . '">' . $nome["nome"] . '</option>';
                                    }
                                    ?>
                                </select>
                                <?php //echoMsgErro("medicamentoAntigo", $msgErros); ?>
                            </div><!-- /Medicamento -->
                        </div>
                        <div class="col-xs-4"><!-- Data Comeco Toma -->
                            <div<?php //echoClassformGroup('dataTomaAntigo', $msgErros, $dadosSubmetidos); ?>>
                                <label for="dataTomaAntigo">Data da Toma - Desde: </label>
                                <input type="date" id="iddataTomaAntigo" name="dataTomaAntigo" class='form-control'>
                                <?php //echoMsgErro("dataTomaAntigo", $msgErros); ?>
                            </div>
                        </div><!-- /Data Comeco Toma -->
                        <div class="col-xs-4"><!-- Data Fim Toma -->
                            <div<?php //echoClassformGroup('dataFimTomaAntiga', $msgErros, $dadosSubmetidos); ?>>
                                <label for="dataFimTomaAntiga">Até: </label>
                                <input type="date" id="iddataFimTomaAntiga" name="dataFimTomaAntiga"
                                       class='form-control'>
                                <?php //echoMsgErro("dataFimTomaAntiga", $msgErros); ?>
                            </div>
                        </div><!-- /Data Fim Toma -->
                        <div class="col-xs-4"><!-- Motivo Med Atual -->
                            <div<?php //echoClassformGroup('motivoMedAntigo', $msgErros, $dadosSubmetidos); ?>>
                                <label for="motivoMedAntigo">Motivo: </label>
                                <input type="text" id="idmotivoMedAntigo" name="motivoMedAntigo" class='form-control'>
                                <?php //echoMsgErro("motivoMedAntigo", $msgErros); ?>
                            </div>
                        </div><!-- /Motivo Med Antiga -->
                    </div>
                </div><!-- /Form MedAntiga -->

            <?php }; ?>

            <div class="row">
                <div class='col-lg-12 text-center'>
                    <input type="submit" id="idSubmit" value="Editar" class='btn btn-primary'>
                    <a class="btn btn-primary" href="pacientes.php" role="button">Cancelar</a>
                </div>
            </div>
    </form>
</div>

<script type="text/javascript">
    CheckboxCheckedExame(document.formNovoPaciente.checkExame.checked, 'checkboxExame');
    CheckboxCheckedMedAtual(document.formNovoPaciente.checkMedicacaoAtual.checked, 'checkboxMedAtual');
    CheckboxCheckedMedAntiga(document.formNovoPaciente.checkMedicacaoAntiga.checked, 'checkboxMedAntiga');
</script>