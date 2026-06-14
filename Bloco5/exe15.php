<?php

$numeros = [];
$maior = null;
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['numeros'])) {
        $numeros_postados = $_POST['numeros'];
        $numeros = [];

        foreach ($numeros_postados as $valor) {
            $valor = trim($valor);

            if ($valor === "" || !is_numeric($valor)) {
                $erros[] = "Todos os campos devem conter números válidos";
            } else {
                $numeros[] = (float)$valor;
            }
        }

        if (count($erros) == 0 && count($numeros) > 0) {
            $maior = $numeros[0];

            foreach ($numeros as $num) {
                if ($num > $maior) {
                    $maior = $num;
                }
            }
        } else {
            $erros[] = "Você deve preencher os números";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Maior Número</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

<div class="container">

    <h1>Encontrar o Maior Número</h1>

    <div class="exercicio">

        <p>Digite 5 números:</p>

    <?php

    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }


    if ($maior !== null && count($erros) == 0) {
        echo "<div class='resultado'>";
        echo "O maior número digitado foi: <strong>$maior</strong>";
        echo "</div>";
    }
    ?>

    <form method="post">

        <div>
            <input type="text" name="numeros[]" placeholder="Número 1">
        </div>

        <div>
            <input type="text" name="numeros[]" placeholder="Número 2">
        </div>

        <div>
            <input type="text" name="numeros[]" placeholder="Número 3">
        </div>

        <div>
            <input type="text" name="numeros[]" placeholder="Número 4">
        </div>

        <div>
            <input type="text" name="numeros[]" placeholder="Número 5">
        </div>

        <input type="submit" value="Encontrar Maior">

    </form>

</body>

</html>