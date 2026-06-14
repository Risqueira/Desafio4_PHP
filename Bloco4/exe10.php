<?php
$nu1 = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        $fatorial = 1;

        for ($i = 1; $i <= $nu1; $i++) {
            $fatorial = $fatorial * $i;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exer10</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="container">
        <h2>Fatorial de um Número</h2>
        <div class="exercicio">
            <?php
            if (count($erros) > 0) {
                echo '<div class="erro"><ul>';
                foreach ($erros as $erro) {
                    echo "<li>$erro</li>";
                }
                echo '</ul></div>';
            }
            if (isset($fatorial)) {
                echo "<div class='resultado'>O fatorial de $nu1 é $fatorial</div>";
            }
            ?>
            <form method="post">
                <div>
                    <label for="nu1">Número Inteiro:</label><br>
                    <input type="number" name="nu1" id="nu1" value="<?php echo htmlspecialchars($nu1); ?>" min="0">
                </div>
                <button type="submit">Calcular Fatorial</button>
            </form>
        </div>
    </div>

</body>

</html>