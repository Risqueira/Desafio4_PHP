<?php
$dia = "";
$res = "";
$erro = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['dia'])) {
        $valor_dia = str_replace(',', '.', trim($_POST['dia']));

        if (!is_numeric($valor_dia) || $valor_dia <= 0 || $valor_dia > 7) {
            $erros[] = "Dia invalido. Insira um numero de 1 a 7";
            $dia = htmlspecialchars(trim($_POST['dia']));
        } else {
            $dia = (int)$valor_dia;
        }
    } else {
        $erro[] = "O campo dia é obrigatorio";
    }

    if (count($erro) == 0) {
        switch ($dia) {
            case 1:
                $situacao = "Domingo";
                break;
            case 2:
                $situacao = "Segunda-feira";
                break;
            case 3:
                $situacao = "Terça-feira";
                break;
            case 4:
                $situacao = "Quarta-feira";
                break;
            case 5:
                $situacao = "Quinta-feira";
                break;
            case 6:
                $situacao = "Sexta-feira";
                break;
            case 7:
                $situacao = "Sábado";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exer7</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <h2>Dia da Semana</h2>

    <?php

    if (count($erro) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erro as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }
    if (!empty($situacao)) {
        echo "<div class='resultado'>O dia correspondente é: $situacao</div>";
    }
    ?>
    
    <form method="post">
        <div>
            Dia (1 a 7): <br>
            <input type="number" name="dia" value="<?= htmlspecialchars($dia) ?>" min="1" max="7">
        </div>
        <div>
            <button type="submit">Verificar Dia</button>
        </div>
    </form>

</body>

</html>