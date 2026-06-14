<?php

$anoNascimento = "";
$situacao = null;
$idade = null;
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anoNascimento_post = $_POST['anoNascimento'] ?? null;

    if (isset($anoNascimento_post) && !empty(trim($anoNascimento_post))) {
        $valor_anoNascimento = filter_var(trim($anoNascimento_post), FILTER_VALIDATE_INT);

        if ($valor_anoNascimento === false || $valor_anoNascimento < 1900 || $valor_anoNascimento > date("Y")) {
            $erros[] = "O ano de nascimento invalido";
            $anoNascimento = htmlspecialchars(trim($anoNascimento_post));
        } else {
            $anoNascimento = $valor_anoNascimento;
        }
    } else {
        $erros[] = "O ano de nascimento invalido";
    }

    if (count($erros) == 0) {
        $idade = date("Y") - $anoNascimento;

        if ($idade >= 18 && $idade < 70) {
            $situacao = "Voto Obrigatório";
        } else if (($idade >= 16 && $idade < 18) || $idade >= 70) {
            $situacao = "Voto Facultativo";
        } else {
            $situacao = "Não pode votar";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exer4</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <h2>Verificar Situação Eleitoral</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }

    if ($situacao) {
        echo "<div class='resultado'>Idade: $idade anos - $situacao</div>";
    }
    ?>

    <form method="post">
        <div>
            Ano de Nascimento:<br>
            <input type="text" name="anoNascimento" value="<?= htmlspecialchars($anoNascimento) ?>">
        </div>

        <div>
            <button type="submit">Verificar Situação Eleitoral</button>
        </div>
    </form>

</body>

</html>