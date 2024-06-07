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

$idParaAlterar = $_POST["ID_Participante"];

$query = "SELECT * FROM Participante WHERE ID_Participante=$idParaAlterar";

echo $query;

$result = mysqli_query($con,$query);

if(mysqli_num_rows($result) > 0)
    echo "<form action=\"alteracao.php\" method=\"post\">";

    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
            echo "<td>  id atual:<input type='text' name=\"velhoId\" value='" . $row['ID_Participante'] . "'><br>";
            echo "<td>  id novo:<input type='text' name=\"novoId\" value='" . $row['ID_Participante'] . "'><br>";
            echo "<td>  nome atual:<input type='text' name=\"velhoNome\" value='" . $row['Nome'] . "'><br>";
            echo "<td>  nome novo:<input type='text' name=\"novoNome\" value='" . $row['Nome'] . "'><br>";
            echo "<td>  codinome atual:<input type='text' name=\"velhoCodinome\" value='" . $row['Codinome'] . "'><br>";
            echo "<td>  codinome novo:<input type='text' name=\"novoCodinome\" value='" . $row['Codinome'] . "'><br>";
            
            echo "<input type=\"submit\">";
            echo "</tr>";
    }
    echo "</form>";
?>