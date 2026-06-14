<?php

$notas = [];
$erros = [];
$media = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['notas']) && is_array($_POST['notas'])) {
        foreach ($_POST['notas'] as $index => $nota) {
            $valor_nota = str_replace(',', '.', trim($nota));

            if (!is_numeric($valor_nota)) {
                $erros[] = "A nota " . ($index + 1) . " deve conter um valor
                númerico válido";
            } else {
                $notas[$index] = htmlspecialchars(trim($nota));
            }
        }
    } else {
        $erros[] = "As notas são obrigatorias";
    }

    if (count($erros) == 0) {
        $soma = 0;

        foreach ($notas as $nota) {
            $soma += $nota;
        }
        $media = $soma / count($notas);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exer13</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="container">
        <h2>Média de Vários Valores</h2>
        <div class="exercicio">
            <?php
            if (count($erros) > 0) {
                echo "<div class='erro'><ul>";

                foreach ($erros as $erro) {
                    echo "<li>$erro</li>";
                }

                echo "</ul></div>";
            }
            if (isset($media)) {
                echo "<div class='resultado'>A média das notas é: $media</div>";
            }
            ?>

            <form method="post">
                <div>
                    <label for="nota1">Nota 1:</label>
                    <input type="text" name="notas[]" id="nota1" value="<?php echo
                                                                        isset($notas[0]) ? $notas[0] : ''; ?>">
                </div>
                <div>
                    <label for="nota2">Nota 2:</label>
                    <input type="text" name="notas[]" id="nota2" value="<?php echo
                                                                        isset($notas[1]) ? $notas[1] : ''; ?>">
                </div>
                <div>
                    <label for="nota3">Nota 3:</label>
                    <input type="text" name="notas[]" id="nota2" value="<?php echo
                                                                        isset($notas[2]) ? $notas[2] : ''; ?>">
                </div>
                <div>
                    <label for="nota4">Nota 4:</label>
                    <input type="text" name="notas[]" id="nota3" value="<?php echo
                                                                        isset($notas[3]) ? $notas[3] : ''; ?>">
                </div>
                <div>
                    <label for="nota5">Nota 5:</label>
                    <input type="text" name="notas[]" id="nota5" value="<?php echo
                                                                        isset($notas[4]) ? $notas[4] : ''; ?>">
                </div>
                <button type="submit">Calcular Média</button>
            </form>
        </div>
    </div>
</body>

</html>