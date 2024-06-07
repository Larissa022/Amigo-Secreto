<?php

$servidor = "localhost";
$DB = "SAAS";
$nome = "root";
$senha = "R00tL4b";
$con = mysqli_connect($servidor,$nome,$senha,$DB);

$velhoId=$_POST['velhoId'];
$novoId=$_POST['novoId'];
$novoId=$_POST['novoId'];
$velhoNome=$_POST['velhoNome'];
$novoNome=$_POST['novoNome'];
$velhoCodinome=$_POST['velhoCodinome'];
$novoCodinome=$_POST['novoCodinome'];

$id = $_POST['ID_Participante'];
$nome = $_POST['Nome'];
$codinome = $_POST['Codinome'];


    $query = "UPDATE Participante SET ID_Participante=$novoId WHERE ID_Participante=$velhoId";
    $query = "UPDATE Participante SET Nome=$novoNome WHERE Nome=$velhoNome";
    $query = "UPDATE Participante SET Codinome=$novoCodinome WHERE Codinome=$velhoCodinome";
    echo $query;

    $result = mysqli_query($con,$query);

    if (mysqli_query($con, $query)) {
        echo "Dados atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar os dados: " . mysqli_error($con);
    }
    mysqli_close($con);

header("Location: cadastro.php");

?>