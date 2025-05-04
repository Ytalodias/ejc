<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Rifa Solidária - EJC</title>
  <style>
    body { font-family: Arial; text-align: center; }
    .numeros { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-top: 20px; }
    .numero { width: 40px; height: 40px; line-height: 40px; border: 1px solid #333; border-radius: 5px; cursor: pointer; }
    .ocupado { background-color: #ffcccc; cursor: not-allowed; }
    form { margin-top: 20px; }
  </style>
</head>
<body>

<h2>Escolha um número da sorte!</h2>
<div class="numeros">
<?php
$sql = "SELECT numero FROM rifa";
$res = $conn->query($sql);
$ocupados = [];
while ($row = $res->fetch_assoc()) {
    $ocupados[] = $row['numero'];
}
for ($i = 1; $i <= 100; $i++) {
    $classe = in_array($i, $ocupados) ? 'numero ocupado' : 'numero';
    echo "<div class='$classe' onclick='selecionarNumero($i)' id='num$i'>$i</div>";
}
?>
</div>

<form action="confirmar_rifa.php" method="POST">
  <input type="hidden" name="numero" id="numeroEscolhido" required>
  <p><strong>Número selecionado:</strong> <span id="exibirNumero"></span></p>
  <input type="text" name="nome" placeholder="Seu nome" required>
  <input type="text" name="telefone" placeholder="WhatsApp" required>
  <button type="submit">Confirmar Participação</button>
</form>

<script>
function selecionarNumero(num) {
  if (document.getElementById('num' + num).classList.contains('ocupado')) return;
  document.getElementById('numeroEscolhido').value = num;
  document.getElementById('exibirNumero').innerText = num;
}
</script>

</body>
</html>
