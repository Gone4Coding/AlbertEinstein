<?php require_once("inc/viewUtils.php") ?>

<?php if (isset($msgGlobal)) : ?><!-- Aviso Paciente -->
    <div class="<?php echoAlertClass($tipoMsgGlobal); ?>">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echoTipoMensagem($tipoMsgGlobal); ?></strong> <?php echo $msgGlobal; ?>
    </div>
<?php endif; ?>

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

<form action="paciente_create.php" method="post" class="form" name="formNovoPaciente" enctype="multipart/form-data">
    <div class='row'><!-- Nome Paciente -->
        <div class="col-xs-12">
            <div<?php echoClassformGroup('nome', $msgErros, $dadosSubmetidos); ?>>
                <label for="nome">Nome: </label>
                <input type="text" id="idnome" name="nome" class='form-control'>
                <?php echoMsgErro("nome", $msgErros); ?>
            </div>
        </div>
    </div><!-- /Nome Paciente -->

    <div class='row'>
        <div class="col-xs-12"><!-- Morada -->
            <div<?php echoClassformGroup('morada', $msgErros, $dadosSubmetidos); ?>>
                <label for="morada">Morada: </label>
                <input type="text" id="idmorada" name="morada" class='form-control'>
                <?php echoMsgErro("morada", $msgErros); ?>
            </div>
        </div>
    </div><!-- /Morada -->

    <div class='row'>
        <div class="col-xs-4"><!-- Código-Postal -->
            <div<?php echoClassformGroup('codigo_postal', $msgErros, $dadosSubmetidos); ?>>
                <label for="codigo_postal">Código-Postal: </label>
                <input type="text" id="idcodigo_postal" name="codigo_postal" class='form-control'>
                <?php echoMsgErro("codigo_postal", $msgErros); ?>
            </div>
        </div><!-- /Código-Postal -->

        <div class="col-xs-4"><!-- Data de Nascimento -->
            <div<?php echoClassformGroup('data_nascimento', $msgErros, $dadosSubmetidos); ?>>
                <label for="data_nascimento">Data de Nascimento: </label>
                <input type="date" id="iddata_nascimento" name="data_nascimento" class='form-control'>
                <?php echoMsgErro("data_nascimento", $msgErros); ?>
            </div>
        </div><!-- /Data de Nascimento -->

        <div class="col-xs-4 form-group"><!-- Sexo -->
            <div<?php echoClassformGroup('genero', $msgErros, $dadosSubmetidos); ?>>
                <label class="col-xs-2 control-label" for="genero">Sexo: </label>

                <div class="col-xs-8">
                    <label class="radio-inline" for="sexo-0">
                        <input type="radio" name="genero" id="genero-0" value="M" checked="checked">
                        M
                    </label>
                    <label class="radio-inline" for="sexo-1">
                        <input type="radio" name="genero" id="genero-1" value="F">
                        F
                    </label>
                </div>
                <?php echoMsgErro("genero", $msgErros); ?>
            </div>
        </div><!-- /Sexo -->
    </div>

    <div class='row'>
        <div class="col-xs-6"><!-- Naturalidade -->
            <div<?php echoClassformGroup('naturalidade', $msgErros, $dadosSubmetidos); ?>>
                <label for="naturalidade">Naturalidade: </label>
                <input type="text" id="idnaturalidade" name="naturalidade" class='form-control'>
                <?php echoMsgErro("naturalidade", $msgErros); ?>
            </div>
        </div><!-- /Naturalidade -->

        <div class="col-xs-6"><!-- Nacionalidade -->
            <div<?php echoClassformGroup('nacionalidade', $msgErros, $dadosSubmetidos); ?>>
                <label for="nacionalidade">Nacionalidade: </label>
                <input type="text" id="idnacionalidade" name="nacionalidade" class='form-control'>
                <?php echoMsgErro("nacionalidade", $msgErros); ?>
            </div>
        </div><!-- /Nacionalidade -->
    </div>

    <div class='row'>
        <div class="col-xs-4"><!-- Nº Utente -->
            <div<?php echoClassformGroup('num_utente', $msgErros, $dadosSubmetidos); ?>>
                <label for="num_utente">Nº Utente: </label>
                <input type="number" id="idnum_utente" name="num_utente" class='form-control'>
                <?php echoMsgErro("num_utente", $msgErros); ?>
            </div>
        </div><!-- /Nº Utente -->

        <div class="col-xs-4"><!-- Nº CC/BI -->
            <div<?php echoClassformGroup('num_cc', $msgErros, $dadosSubmetidos); ?>>
                <label for="num_cc">Nº CC/BI: </label>
                <input type="number" id="idnum_cc" name="num_cc" class='form-control'>
                <?php echoMsgErro("num_cc", $msgErros); ?>
            </div>
        </div><!-- /Nº CC/BI -->

        <div class="col-xs-4"><!-- Nº Segurança Socia -->
            <div<?php echoClassformGroup('num_seg_social', $msgErros, $dadosSubmetidos); ?>>
                <label for="num_seg_social">Nº Segurança Social: </label>
                <input type="number" id="idnum_seg_social" name="num_seg_social" class='form-control'>
                <?php echoMsgErro("num_seg_social", $msgErros); ?>
            </div>
        </div><!-- /Nº Segurança Socia -->
    </div>

    <div class='row'>
        <div class='col-xs-4'><!-- NIF -->
            <div<?php echoClassformGroup('nif', $msgErros, $dadosSubmetidos); ?>>
                <label for="nif">NIF: </label>
                <input type="number" id="idnif" name="nif" class='form-control'>
                <?php echoMsgErro("nif", $msgErros); ?>
            </div>
        </div><!-- /NIF -->

        <div class="col-xs-4"><!-- Tipo de Sangue -->
            <div<?php echoClassformGroup('tipo_sangue', $msgErros, $dadosSubmetidos); ?>>
                <label for="tipo_sangue" style="padding-top: 30px; padding-left: 60px">Tipo de Sangue:</label>
                <select id="idtipo_sangue" name="tipo_sangue" class="form-group-sm">
                    <option value="A Rh+">A Rh+</option>
                    <option value="A Rh-">A Rh-</option>
                    <option value="A Rh-">B Rh+</option>
                    <option value="B Rh-">B Rh-</option>
                    <option value="AB Rh+">AB Rh+</option>
                    <option value="AB Rh-">AB Rh-</option>
                    <option value="0 Rh+">0 Rh+</option>
                    <option value="0 Rh-">>0 Rh-</option>
                </select>
                <?php echoMsgErro("tipo_sangue", $msgErros); ?>
            </div>
        </div><!-- /Tipo de Sangue -->

        <div class='col-xs-4'><!-- Tele Emergencia -->
            <div<?php echoClassformGroup('contato_emergencia', $msgErros, $dadosSubmetidos); ?>>
                <label for="contato_emergencia">Telemóvel de Emegência: </label>
                <input type="number" id="idcontato_emergencia" name="contato_emergencia" class='form-control'>
                <?php echoMsgErro("contato_emergencia", $msgErros); ?>
            </div>
        </div><!-- /Tele Emergencia -->
    </div>

    <div class="row"><!-- Alergia -->
        <div class="col-xs-12">
            <div<?php echoClassformGroup('alergia', $msgErros, $dadosSubmetidos); ?>>
                <label for="alergia">Alergias: </label>
                <input type="text" id="idalergia" name="alergia" class="form-control">
                <?php echoMsgErro("alergia", $msgErros); ?>
            </div>
        </div>
    </div><!-- /Alergia -->

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
                <input type="checkbox" id="idcheckboxMedicacaoAtual" name="checkMedicacaoAtual" class="form-group"
                       onclick="CheckboxCheckedMedAtual(this.checked,'checkboxMedAtual')">
            </div><!-- /CheckBox Med antual -->

            <div class="col-xs-4 text-center"><!-- CheckBox Med antiga -->
                <label for="medicacaoAntiga">Medicação Antiga:</label>
                <input type="checkbox" id="idcheckboxMedicacaoAntiga" name="checkMedicacaoAntiga" class="form-group"
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
                    <select id="idSelecTipoExame" name="especialidade" class="form-group-sm">
                        <?php
                        foreach ($todosExmes as $linha){
                            echo '<option value="' . $linha["id_especialidade"] . '">' . $linha["especialidade"] . '</option>';
                        }
                        ?>
                    </select>
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
                        foreach($todosMedicamentos as $linha){
                            echo'<option value="'.$linha["id"].'">'.$linha["nome"].'</option>';
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
                        foreach($todosMedicamentos as $nome){
                            echo'<option value="'.$nome["nome"].'">'.$nome["nome"].'</option>';
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

    <div class="row"><!-- Submit/Reset -->
        <div class='col-xs-12 text-center'>
            <input type="submit" id="idSubmit" value="Criar Novo Paciente" class='btn btn-primary'>
            <input type="reset" id="idReset" value="Cancelar" class="btn btn-primary">
        </div>
    </div><!-- /Submit/Reset -->
</form>
<script type="text/javascript">
    CheckboxCheckedExame(document.formNovoPaciente.checkExame.checked, 'checkboxExame');
    CheckboxCheckedMedAtual(document.formNovoPaciente.checkMedicacaoAtual.checked, 'checkboxMedAtual');
    CheckboxCheckedMedAntiga(document.formNovoPaciente.checkMedicacaoAntiga.checked, 'checkboxMedAntiga');
</script>


