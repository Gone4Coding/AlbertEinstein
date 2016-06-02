<?php require_once("inc/viewUtils.php"); ?>
 
<div class="col-lg-6">



<form action="utilizadores.php" method="get" class="form-inline">

	<div class="form-group">
		<label for="idPesquisar">Pesquisar</label>
        <input type="text" id="idUsername" name="username" value="<?php echo $username; ?>" class="form-control"> 
	</div>				
	<input type="submit" id="idSubmit" value="Pesquisar" class="btn btn-primary">	
	<!--<a class="btn btn-info" href="utilizador_create.php" role="button">Criar Utilizador</a>-->
</form>
<br>




<table class="table table-striped">
	<thead>
	<tr>
		<th>id</th>
		<th>username</th>
		<th>tipo</th>
		<th>ativo</th>
		
		<th></th>
	</tr>
	</thead>
	<tbody>


	<?php


	if(isset($utilizadorAbre)){
		foreach ($utilizadorAbre as $linha) {
			echo "\n<tr>";
			echo "<td>".$linha['id']."</td>";
			echo "<td>".$linha['username']."</td>";
			echo "<td>".$linha['tipo']."</td>";
			echo "<td>".$linha['ativo']."</td>";

			echo '<td><a class="btn btn-info" href="utilizador_update.php?id='.$linha["id"].'" role="button">Ver</a></td>';

			?>
			</tr>
			<?php


		} }else {

		foreach ($utilizador as $linha) {
			echo "\n<tr>";
			echo "<td>".$linha['id']."</td>";
			echo "<td>".$linha['username']."</td>";
			echo "<td>".$linha['tipo']."</td>";
			echo "<td>".$linha['ativo']."</td>";

			echo '<td><a class="btn btn-info" href="utilizador_update.php?id='.$linha["id"].'" role="button">Ver</a></td>';

			?>
			</tr>
			<?php


		}}?>


</tbody>
</table>

</div>




<div class="col-lg-6">


	<!-------formulario------>

	<?php if (isset($msgGlobal)) : ?>

		<div class="<?php echoAlertClass($tipoMsgGlobal);?>">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong><?php echoTipoMensagem($tipoMsgGlobal); ?></strong> <?php echo $msgGlobal;?>
		</div>
	<?php endif; ?>



	<form action="utilizador_create.php" method="post" class="form-horizontal">





		<div class='row'>
			<div class="form-group">
				<div<?php echoClassformGroup('username',$msgErros,$dadosSubmetidos);?>>
					<label class="col-md-2 control-label"  for = "username">username: </label>
					<div class="col-lg-8">
						<input type = "text" id = "idnomePaciente" name = "username" class='form-control' <?php echoFieldValue("username", $data);?>>
						<?php echoMsgErro("username",$msgErros); ?>
					</div>
				</div>
			</div>
		</div>

		<div class='row'>
			<div class="form-group">
				<div<?php echoClassformGroup('password',$msgErros,$dadosSubmetidos);?>>
					<label class="col-md-2 control-label"  for = "password">password: </label>
					<div class="col-lg-8">
						<input type = "text" id = "idnomePaciente" name = "password" class='form-control' <?php echoFieldValue("password", $data);?>>
						<?php echoMsgErro("password",$msgErros); ?>
					</div>
				</div>
			</div>
		</div>



		<div class='row'>
			<div class="form-group">
				<div<?php echoClassformGroup('tipo',$msgErros,$dadosSubmetidos);?>>
					<label  class="col-md-2 control-label" for = "tipo">Tipo: </label>

					<div class="col-lg-8">
						<label class="radio-inline" for="tipo-0">
							<input type="radio" name="tipo" id="tipo-0" value="S" checked="checked">
							Admnistrativo
						</label>
						<label class="radio-inline" for="tipo-1">
							<input type="radio" name="tipo" id="tipo-1" value="M">
							Medico
						</label>
						<label class="radio-inline" for="tipo-2">
							<input type="radio" name="tipo" id="tipo-2" value="E">
							Enfermeiro
						</label>
						<label class="radio-inline" for="tipo-3">
							<input type="radio" name="tipo" id="tipo-3" value="A">
							Administrador
						</label>
					</div>
					<?php echoMsgErro("tipo",$msgErros); ?>
				</div>
			</div>
		</div>






		<div class="row">
			<div class='col-lg-12 text-center'>
				<input type="submit" id = "idSubmit" value = "Criar Utilizador" class='btn btn-primary'>


				<input type="reset" id="idReset" value="Cancelar" class="btn btn-primary">
			</div>
		</div>
	</form>











</div>
