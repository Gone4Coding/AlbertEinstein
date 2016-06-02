<?php require_once("inc/viewUtils.php"); ?>

<?php if (isset($msgGlobal)) : ?>

    <div class="<?php echoAlertClass($tipoMsgGlobal); ?>">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echoTipoMensagem($tipoMsgGlobal); ?></strong> <?php echo $msgGlobal; ?>
    </div>

<?php endif; ?>

<div class="col-lg-8">
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="idNome">Nome: </label>
                <p id="idNome" class="form-control-static"><?php echoValue("nome", $data[0]) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="idmorada">Morada: </label>
                <p id="idmorada" class="form-control-static"><?php echoValue("morada", $data[0]) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="form-group">
                <label for="idcodigoPostal">Código Postal: </label>
                <p id="idcodigoPostal" class="form-control-static"><?php echoValue("codigo_postal", $data[0]) ?></p>
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                <label for="iddataNascimento">Data de Nascimento: </label>
                <p id="iddataNascimento" class="form-control-static"><?php echoValue("data_nascimento", $data[0]) ?></p>
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                <label for="idsexo">Sexo </label>
                <p id="idsexo" class="form-control-static"><?php echoValue("genero", $data[0]) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="idnaturalidade">Naturalidade: </label>
                <p id="idnaturalidade" class="form-control-static"><?php echoValue("naturalidade", $data[0]) ?></p>
            </div>
        </div>

        <div class="col-xs-4">
            <div class="form-group">
                <label for="idnacionalidade">Nacionalidade: </label>
                <p id="idnacionalidade" class="form-control-static"><?php echoValue("nacionalidade", $data[0]) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="idnumeroUtente">Nº Utente: </label>
                <p id="idnumeroUtente" class="form-control-static"><?php echoValue("num_utente", $data[0]) ?></p>
            </div>
        </div>

        <div class="col-xs-4">
            <div class="form-group">
                <label for="idnumeroCC">Nº CC/BI: </label>
                <p id="idnumeroCC" class="form-control-static"><?php echoValue("num_cc", $data[0]) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="idnumeroSegSocial">Nº Segurança Social: </label>
                <p id="idnumeroSegSocial" class="form-control-static"><?php echoValue("num_seg_social", $data[0]) ?></p>
            </div>
        </div>

        <div class="col-xs-4">
            <div class="form-group">
                <label for="idnif">NIF: </label>
                <p id="idnif" class="form-control-static"><?php echoValue("nif", $data[0]) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label for="idtipoSangue">Tipo de Sangue: </label>
                <p id="idtipoSangue" class="form-control-static"><?php echoValue("tipo_sangue", $data[0]) ?></p>
            </div>
        </div>

        <div class="col-xs-4">
            <div class="form-group">
                <label for="idtelemovelEmegencia">Telemóvel de Emergência: </label>
                <p id="idtelemovelEmegencia"
                   class="form-control-static"><?php echoValue("contato_emergencia", $data[0]) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="row">
        <!-- historico -->
        <?php if (isset($msgGlobalHistorico)) : ?>
            <div class="<?php echoAlertClass($tipoMsgGlobalHistorico); ?>">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echoTipoMensagem($tipoMsgGlobalHistorico); ?></strong> <?php echo $msgGlobalHistorico; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <!-- alergia -->
        <?php if (isset($msgGlobalAlergia)) : ?>
            <div class="<?php echoAlertClass($tipoMsgGlobalAlergia); ?>">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echoTipoMensagem($tipoMsgGlobalAlergia); ?></strong> <?php echo $msgGlobalAlergia; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <!-- exame -->
        <?php if (isset($msgGlobalExame)) : ?>
            <div class="<?php echoAlertClass($tipoMsgGlobalExame); ?>">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echoTipoMensagem($tipoMsgGlobalExame); ?></strong> <?php echo $msgGlobalExame; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <!-- medAtual -->
        <?php if (isset($msgGlobalMedAtual)) : ?>
            <div class="<?php echoAlertClass($tipoMsgGlobalMedAual); ?>">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echoTipoMensagem($tipoMsgGlobalMedAual); ?></strong> <?php echo $msgGlobalMedAtual; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <!-- medAntiga -->
        <?php if (isset($msgGlobalMedAntiga)) : ?>
            <div class="<?php echoAlertClass($tipoMsgGlobalMedAntiga); ?>">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echoTipoMensagem($tipoMsgGlobalMedAntiga); ?></strong> <?php echo $msgGlobalMedAntiga; ?>
            </div>
        <?php endif; ?>
    </div>
</div>