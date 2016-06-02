<form action="paciente_lista.php" method="get" class="form-inline">
        <div class="form-group">
            <label for="idNumUtente">Número de Utente</label>
            <input type="text" id="idNumUtente" name="numUtente" value="<?php echo $numUtente; ?>" class="form-control">
        </div>
        <input type="submit" id="idSubmit" value="Procurar" class="btn btn-primary">
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>Número de Utente</th>
            <th>Nome</th>
            <th>Tipo de Sangue</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        
       
        
        foreach ($pacientes as $linha) {
            echo "\n<tr>";
            echo "<td>" . $linha['num_utente'] . "</td>";
            echo "<td>" . $linha['nome'] . "</td>";
            echo "<td>" . $linha['tipo_sangue'] . "</td>";
            echo '<td><a class="btn btn-info glyphicon glyphicon-eye-open" href="paciente_show.php?num_utente='.$linha["num_utente"].'" role="button"></a></td>';
            echo '<td><a class="btn btn-info glyphicon glyphicon-plus" href="exame_add.php?num_utente='.$linha["num_utente"].'" role="button" >  Exames</a></td>';
            echo '<td><a class="btn btn-info glyphicon glyphicon-plus" href="medicacao_atual_add.php?num_utente='.$linha["num_utente"].'" role="button"> Med. Atual</a></td>';
            echo '<td><a class="btn btn-info glyphicon glyphicon-plus" href="medicacao_antiga_add.php?num_utente='.$linha["num_utente"].'" role="button"> Med. Antiga</a></td>';
            ?>
            </tr>
        <?php } ?>

        </tbody>


    </table>