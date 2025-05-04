<?php
include 'config.php';

$numero = $_POST['numero'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];

$stmt = $conn->prepare("INSERT INTO rifa (numero, nome, telefone) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $numero, $nome, $telefone);

if ($stmt->execute()) {
    echo "Participação confirmada! Agora envie o valor da rifa via Pix: <br><br>";
    echo "<strong>Chave Pix:</strong> seuemail@dominio.com <br><br>";
    echo "<a href='rifa.php'>Voltar</a>";
} else {
    echo "Erro: número já escolhido. <a href='rifa.php'>Tente outro</a>";
}
?>
