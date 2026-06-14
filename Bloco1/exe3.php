<?php
$distancia = "";
$combustivel = "";
$consumo = null;
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $distancia_post = $_POST['distancia'] ?? '';
    $combustivel_post = $_POST['combustivel'] ?? '';

    if (isset($distancia_post) && !empty(trim($distancia_post))) {
        $valor_distancia = filter_var(str_replace(',', '.', trim($distancia_post)), FILTER_VALIDATE_FLOAT);
        if ($valor_distancia === false || $valor_distancia <= 0) {
            $erros[] = "Valor da distância é inválido.";
            $distancia = htmlspecialchars(trim($distancia_post));
        } else {
            $distancia = $valor_distancia;
        }
    } else {
        $erros[] = "O campo distância é obrigatório.";
    }

    if (isset($combustivel_post) && !empty(trim($combustivel_post))) {
        $valor_combustivel = filter_var(str_replace(',', '.', trim($combustivel_post)), FILTER_VALIDATE_FLOAT);
        if ($valor_combustivel === false || $valor_combustivel <= 0) {
            $erros[] = "Valor do combustível é inválido.";
            $combustivel = htmlspecialchars(trim($combustivel_post));
        } else {
            $combustivel = $valor_combustivel;
        }
    } else {
        $erros[] = "O campo combustível é obrigatório.";
    }

    if (count($erros) == 0) {
        $consumo = $distancia / $combustivel;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Consumo de Combustível</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <h2>Consumo de Combustível</h2>

    <?php

    if (count($erros) > 0) {
        echo "<div class='erro'>";
        foreach ($erros as $erro) {
            echo "<p>$erro</p>";
        }
    }
    if ($consumo !== null) {
        $consumo_formatado = number_format($consumo, 2, ',', '.');
        echo "<div class='resultado'>
            Consumo médio = $consumo_formatado Km/L
          </div>";
    }
    ?>

    <form method="post">
        <div>
            Distância (Km): <br>
            <input type="text" name="distancia" value="<?= htmlspecialchars($distancia) ?>">
        </div>

        <div>
            Combustível (Litros): <br>
            <input type="text" name="combustivel" value="<?= htmlspecialchars($combustivel) ?>">
        </div>

        <div>
            <input type="submit" value="Calcular">
        </div>
    </form>

</body>

</html>