<?php

$mes = "";
$res = "";
$erros = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['mes'])) {
        $valor_mes = str_replace(',', '.', trim($_POST['mes']));

        if (!is_numeric($valor_mes) || $valor_mes <= 0 || $valor_mes > 12) {
            $erros[] = "Mês invalido. Insira um numero de 1 a 12";
            $mes = htmlspecialchars(trim($_POST['mes']));
        } else {
            $mes = (int)$valor_mes;
        }
    } else {
        $erros[] = "O campo mês é obrigatorio";
    }

    if (count($erros) == 0) {
        switch ($mes) {
            case 1:
                $res = "Janeiro";
                break;
            case 2:
                $res = "Fevereiro";
                break;
            case 3:
                $res = "Março";
                break;
            case 4:
                $res = "Abril";
                break;
            case 5:
                $res = "Maio";
                break;
            case 6:
                $res = "Junho";
                break;
            case 7:
                $res = "Julho";
                break;
            case 8:
                $res = "Agosto";
                break;
            case 9:
                $res = "Setembro";
                break;
            case 10:
                $res = "Outubro";
                break;
            case 11:
                $res = "Novembro";
                break;
            case 12:
                $res = "Dezembro";
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
    
    <h2>Mês do ano</h2>

    <?php

    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erros) {
            echo "<li>$erros</li>";
        }
        echo "</ul></div>";
    }
    if (!empty($res)) {
        echo "<div class='resultado'>O mês correspondente é: $res</div>";
    }
    ?>
    
    <form method="post">
        <div>
            Mes (1 a 12): <br>
            <input type="number" name="mes" value="<?= htmlspecialchars($mes) ?>" min="1" max="12">
        </div>
        <div>
            <button type="submit">Verificar Mês</button>
        </div>
    </form>

</body>

</html>
