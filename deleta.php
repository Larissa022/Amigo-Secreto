<?php

$servidor = "localhost";
$DB = "SAAS";
$nome = "root";
$senha = "R00tL4b";
$con = mysqli_connect($servidor,$nome,$senha,$DB);

if(!$con) {
    die("MORREU". mysqli_connect_error());
}
echo "SUCESSO";

$idParaExcluir = $_POST["ID_Participante"];

$query = "DELETE FROM Participante WHERE ID_Participante=$idParaExcluir";

echo "<br>".$query;
if (mysqli_query($con, $query)) {
  echo "Record deleted successfully";
  } else {
  echo "Error deleting record: " . mysqli_error($con);
  }
  
    $con->close();

$nome=$_POST["Nome"];
$id=$_POST["ID_Participante"];
$codinome=$_POST["Codinome"];

header("Location: cadastro.php");

?>