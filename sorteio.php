<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <link rel="icon" href="assets/images/gift.png">

    <link rel="stylesheet" href="assets/styles/styles.css">
    <title>Sistema de Apoio a Amigo Secreto</title>
</head>
<body>
    <nav>
        <a href="index.html"><img src="assets/images/gift.png" class="gift"></a>
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
        <h1>Sorteio</h1>
        <p>Esse é um site que permite o sorteio de amigo secreto na teoria pq na pratica é outra história...</p>
    </div>
   </header>
   <hr>



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

  $queryParticipantes = "SELECT ID_Participante, Nome FROM Participante";
  $resultadoParticipantes = $con->query($queryParticipantes);

  if ($resultadoParticipantes->num_rows > 0) {
      $participantes = [];
      while ($linha = $resultadoParticipantes->fetch_assoc()) {
          $participantes[] = $linha;
      }
  } else {
      die("Nenhum participante encontrado.");
  }
  
  // Embaralhar os participantes
  $participantesEmbaralhados = $participantes;
  shuffle($participantesEmbaralhados);
  
  // Garantir que um participante não tire a si mesmo
  $sorteio = [];
  $valido = false;
  
  while (!$valido) {
      $valido = true;
      for ($i = 0; $i < count($participantes); $i++) {
          if ($participantes[$i]['ID_Participante'] === $participantesEmbaralhados[$i]['ID_Participante']) {
              $valido = false;
              shuffle($participantesEmbaralhados);
              break;
          }
      }
  }
  
  for ($i = 0; $i < count($participantes); $i++) {
      $sorteio[] = [
          'doador' => $participantes[$i]['ID_Participante'],
          'receptor' => $participantesEmbaralhados[$i]['ID_Participante']
      ];
  }
  

  $con->query("TRUNCATE TABLE Sorteio");
  
  // Inserir os resultados do sorteio no banco de dados
  $stmt = $con->prepare("INSERT INTO Sorteio (doador_id, receptor_id) VALUES (?, ?)");
  
  foreach ($sorteio as $par) {
      $stmt->bind_param("ii", $par['doador'], $par['receptor']);
      $stmt->execute();
  }
  
  // Fechar a declaração
  $stmt->close();
  
  // Exibir os resultados do sorteio na tela
  echo "<h1>Resultado do Sorteio</h1>";
  echo "<table border='1'>
          <tr>
              <th>Doador</th>
              <th>Receptor</th>
          </tr>";
  
  foreach ($sorteio as $par) {
      // Obter nomes dos doadores e receptores
      $doadorNome = '';
      $receptorNome = '';
  
      foreach ($participantes as $participante) {
          if ($participante['ID_Participante'] == $par['doador']) {
              $doadorNome = $participante['nome'];
          }
          if ($participante['ID_Participante'] == $par['receptor']) {
              $receptorNome = $participante['nome'];
          }
      }
  
      echo "<tr>
              <td>$doadorNome</td>
              <td>$receptorNome</td>
            </tr>";
  }
  
  echo "</table>";
  

  $con->close();

  ?>

    <footer >
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