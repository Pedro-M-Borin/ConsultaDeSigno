<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataNascimento = $_POST['dataNascimento'];

    // Converte a data de nascimento para o formato dia/mês
    $data = date("d/m", strtotime($dataNascimento));

    // Carrega o arquivo XML
    $signos = simplexml_load_file("signos.xml");

    if (!$signos) {
        echo "Erro ao carregar o arquivo XML.";
        exit;
    }

    $signoEncontrado = null; // Inicializa a variável

    // Itera pelos signos para encontrar o correspondente
    foreach ($signos->signo as $signo) {
        $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
        $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
        $dataNascimentoDate = DateTime::createFromFormat('d/m', $data);

        // Verifica se a data de nascimento está no intervalo
        if (($inicio <= $dataNascimentoDate && $dataNascimentoDate <= $fim) ||
            ($inicio > $fim && ($dataNascimentoDate >= $inicio || $dataNascimentoDate <= $fim))) {
            $signoEncontrado = (string)$signo->signoNome;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Signo</title>
    <!-- Inclusão do CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="/project/assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="square-wrapper">
            <div class="result-section">
                <h3>Resultado</h3>
                <?php
                if (isset($signoEncontrado)) { // Verifica se a variável foi definida
                    if ($signoEncontrado) {
                        echo "<p>Seu signo é: <strong>" . $signoEncontrado . "</strong></p>";
                    } else {
                        echo "<p>Signo não encontrado para a data informada.</p>";
                    }
                } else {
                    echo "<p>Por favor, preencha o formulário primeiro.</p>";
                }
                ?>
                <a href="index.php" class="btn-try-again">Tentar novamente</a>
            </div>
        </div>
    </div>
</body>
</html>
