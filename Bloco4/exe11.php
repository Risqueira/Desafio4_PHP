<?php

$n1 = "";
$erros = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['nu1'])) {
        $valor_nu1 = str_replace(',', '.', trim($_POST['nu1']));

        if (!is_numeric($valor_nu1) || (int)$valor_nu1 < 0) {
            $erros[] = "O campo Número deve conter um valor inteiro não negativo.";
            $nu1 = htmlspecialchars(trim($_POST['nu1']));
        } else {
            $nu1 = (int)$valor_nu1;
        }
    } else {
        $erros[] = "O campo Número é obrigatório.";
    }
    if (count($erros) == 0) {
        $soma = 0;

        for ($i = 1; $i <= $nu1; $i++) {
           $soma += $i;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exer11</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <h1>Somatório de 1 a N</h1>
    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }
    if (isset($soma)) {
        echo "<div class='resultado'>A soma dos números de 1 a $nu1 é $soma</div>";
    }
    ?>
    <form method="post">
        <div>
            <label for="nu1">Número Inteiro Positivo (N):</label><br>
            <input type="number" id="nu1" name="nu1" min="1" value="<?php echo htmlspecialchars($nu1); ?>">
        </div>
        <button type="submit">Calcular Somatório</button>
    </form>
    
</body>
</html>