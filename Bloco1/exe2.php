<?php
$base = "";
$altura = "";
$perimetro  = null;
$area = "";
$erro = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $base_post = $_POST['base'] ?? '';
    $altura_post = $_POST['altura'] ?? '';

    if (isset($base_post) && !empty(trim($base_post))) {
        $valor_base = filter_var(str_replace(',', '.', trim($base_post)), FILTER_VALIDATE_FLOAT);
        if ($valor_base === false || $valor_base <= 0) {
            $erro[] = "Valor da base é invalido";
            $base = htmlspecialchars(trim($base_post));
        } else {
            $base = $valor_base;
        }
    } else {
        $erro[] = "O campo base é obrigatório.";
    }

    if (isset($altura_post) && !empty(trim($altura_post))) {
        $valor_altura = filter_var(str_replace(',', '.', trim($altura_post)), FILTER_VALIDATE_FLOAT);
        if ($valor_altura === false || $valor_altura <= 0) {
            $erro[] = "Valor da altura é invalido";
            $altura = htmlspecialchars(trim($altura_post));
        } else {
            $altura = $valor_altura;
        }
    } else {
        $erro[] = "O campo altura é obrigatório.";
    }

    if (count($erro) == 0) {
        $perimetro = 2 * ($base + $altura);
        $area = $base * $altura;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <h2>Calculadora de Retângulo</h2>

    <?php
    if (count($erro) > 0) {
        echo "<div class = 'erro'>";
        foreach ($erro as $erro) {
            echo "<p style='color:red;'>$erro</p>";
        }
        echo "</div>";
    }

    if ($area !== null && $perimetro !== null) {
        $area_formatada = number_format($area, 2, ',', '.');
        $perimetro_formatado = number_format($perimetro, 2, ',', '.');

        echo "<div class='resultado'>
            Área = $area_formatada m² <br>
            Perímetro = $perimetro_formatado m
          </div>";
    }
    ?>

    <form method="post">
        <div>
            Base (m): <br>
            <input type="text" name="base" value="<?= htmlspecialchars($base) ?>">
        </div>

        <div>
            Altura (m): <br>
            <input type="text" name="altura" value="<?= htmlspecialchars($altura) ?>">
        </div>

        <div>
            <input type="submit" value="Calcular">
        </div>
    </form>


</body>

</html>