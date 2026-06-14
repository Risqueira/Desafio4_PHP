<?php

$n1 = "";
$n2 = "";
$operacoes = "";
$res = null;
$erros = [];

$operacoes = [
    'somar' => 'Somar',
    'subtrair' => 'Subtrair',
    'multiplicar' => 'Multiplicar',
    'dividir' => 'Dividir'
];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_POST['n1'])) {
        $n1 = str_replace(',', '.', trim($_POST['n1']));

        if (!is_numeric($n1)) {
            $erros[] = "O campo Número deve ser preenchido com numericos";
        }
    } else {
        $erros[] = "O campo Número é obrigatorio";
    }

    if (!empty($_POST['n2'])) {
        $n2 = str_replace(',', '.', trim($_POST['n2']));

        if (!is_numeric($n2)) {
            $erros[] = "O campo Número deve ser preenchido com numericos";
        }
    } else {
        $erros[] = "O campo Número é obrigatorio";
    }

    if (!empty($_POST['operacao'])) {
        $operacao = trim($_POST['operacao']);

        if (!array_key_exists($operacao, $operacoes)) {
            $erros[] = "Operação inválida.";
        }
    } else {
        $erros[] = "A operação é obrigatória.";
    }

    if (count($erros) == 0) {

        switch ($operacao) {
            case 'somar':
                $res = "$n1 + $n2 = " . ($n1 + $n2);
                break;
            case 'subtrair':
                $res = "$n1 - $n2 = " . ($n1 - $n2);
                break;
            case 'multiplicar':
                $res = "$n1 x $n2 = " . ($n1 * $n2);
                break;
            case 'dividir':
                $res = "$n1 / $n2 = " . ($n1 / $n2);
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Simples</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="container">

        <h2>Calculadora Simples</h2>

        <div class="exercicio">

            <?php
            if (count($erros) > 0) {
                echo "<div class='erro'><ul>";
                foreach ($erros as $erro) {
                    echo "<li>$erro</li>";
                }
                echo "</ul></div>";
            }

            if ($res !== null) {
                echo "<div class='resultado'>$res</div>";
            }
            ?>

            <form method="post">

                <div>
                    Número 1:<br>
                    <input type="text" name="n1" value="<?= htmlspecialchars($n1) ?>">
                </div>

                <div>
                    Número 2:<br>
                    <input type="text" name="n2" value="<?= htmlspecialchars($n2) ?>">
                </div>

                <div>
                    Operação:<br>
                    <select name="operacao">
                        <option value="">Selecione</option>

                        <?php foreach ($operacoes as $valor => $texto): ?>
                            <option value="<?= $valor ?>" <?= (isset($operacao) && $operacao == $valor) ? 'selected' : '' ?>>
                                <?= $texto ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div>
                    <button type="submit">Calcular</button>
                </div>

            </form>

        </div>
    </div>

</body>

</html>