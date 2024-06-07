<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link rel="icon" href="assets/images/gift.png">

    <link rel="stylesheet" href="assets/styles/cadastro.css">
    <title>Sistema de Apoio a Amigo Secreto</title>
</head>
<body>
    <nav>
        <a href="index.html"><img src="assets/images/gift.png" alt="presente" class="gift"></a>
      <a class="logo" href="index.html">Amigo Secreto</a>
      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
      <ul class="nav-list">
        <li><a href="index.html">início</a></li>
        <li><a href="sorteio.php">sorteio</a></li>
        <li><a href="cadastro.php">cadastro</a></li>
      </ul>
    </nav>

   <header>
    <div class="div1">
        <h1>Cadastro</h1>
    </div>
   </header>

   
   <form action="cadastro.php" method="post" class="formu">
    Id:<input type="text" id="ID_Participante" name="ID_Participante">
    Nome:<input type="text" id="Nome" name="Nome">
    Codinome:<input type="text" id="Codinome" name="Codinome">
    <button id="enviarDados" class="butao_enviar">Enviar</button>

   </form>

   <hr><br><br>

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


  $query = "SELECT * FROM Participante";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result) > 0)
  echo "<table border='1'>";
      echo "<tr>";
          echo "<th>id</th>";
          echo "<th>nome</th>";
          echo "<th>codinome</th>";
          echo "<th>deletar</th>";
          echo "<th>editar</th>";
      echo "</tr>";
  while($row = mysqli_fetch_array($result)){
      echo "<tr>";
          echo "<td>" . $row['ID_Participante'] . "</td>";
          echo "<td>" . $row['Nome'] . "</td>";
          echo "<td>" . $row['Codinome'] . "</td>";
          echo "<td>

          <form action='deleta.php' method='post'>
              <center><button type='submit' name='ID_Participante' value=".$row['ID_Participante'].">X</button></center>
          </form>
          </td>";
          echo "<td>
          <form action='altera.php' method='post'>
              <center><button type='submit' name='ID_Participante' class='butao' value=".$row['ID_Participante'].">?</button></center>
          </form>
          </td>";
          echo "</tr>";
  }
  echo "</table>";


$id=$_POST["ID_Participante"];
$nome=$_POST["Nome"];
$codinome=$_POST["Codinome"];

$sql = "INSERT INTO Participante VALUES ('$id', '$nome', '$codinome')";

echo $sql;
if (mysqli_query($con, $sql)) {
      echo "Funcionou";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

?>

    <br><br>
    <footer>
        <div class="container">
            <div class="footer-info">
              <h2>Contate-nos</h2>
              <p>Endereço: Rua Amigo Secreto, nº 123</p>
              <p>Telefone: (00) 1234-5678</p>
              <p>Email: contato@amigosecreto.com</p>
            </div>
            <div class="map">
              
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.4968547872177!2d-38.58503432549802!3d-3.701148343033124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c74a0906b18879%3A0x82dd43379c4affb6!2sEscola%20Estadual%20de%20Educa%C3%A7%C3%A3o%20Profissional%20Paulo%20Petrola!5e0!3m2!1spt-BR!2sbr!4v1713487501641!5m2!1spt-BR!2sbr" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
               </div>
          </div>
    </footer>
    
</body>
</html>