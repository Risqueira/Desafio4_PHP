<?php
$n1 = "";
$n2 = "";
$media = null;
$situacao = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['n1'])) {
        $n1 = str_replace(',', '.', trim($_POST['n1']));

        if (!is_numeric($n1) || $n1 < 0 || $n1 > 10) {
            $erros[] = "A nota 1 deve estar entre 0 a 10";
        }
    } else {
        $erros[] = "O campo nota 1 é obrigatorio";
    }

    if (!empty($_POST['n2'])) {
        $n2 = str_replace(',', '.', trim($_POST['n2']));

        if (!is_numeric($n2) || $n2 < 0 || $n2 > 10) {
            $erros[] = "A nota 2 deve estar entre 0 a 10";
        }
    } else {
        $erros[] = "O campo nota 2 é obrigatorio";
    }

    if (count($erros) == 0) {
        $media = ($n1 + $n2) / 2;

        if ($media >= 7) {
            $situacao = "APROVADO";
        } else if ($media >= 5) {
            $situacao = "RECUPERAÇÃO";
        } else {
            $situacao = "REPROVADO";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Situação do Aluno</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="container">

        <h2>Situação do Aluno</h2>

        <div class="exercicio">

            <?php
            if (count($erros) > 0) {
                echo "<div class='erro'>";
                foreach ($erros as $erro) {
                    echo "$erro <br>";
                }
                echo "</div>";
            }

            if ($media !== null) {
                echo "<div class='resultado'>";
                echo "Média: " . number_format($media, 2, ',', '.') . "<br>";
                echo "Situação: " . $situacao;
                echo "</div>";
            }
            ?>

            <form method="post">

                <div>
                    <label>Nota 1:</label>
                    <input type="text" name="n1" value="<?= htmlspecialchars($n1) ?>">
                </div>

                <div>
                    <label>Nota 2:</label>
                    <input type="text" name="n2" value="<?= htmlspecialchars($n2) ?>">
                </div>

                <div>
                    <input type="submit" value="Calcular Média">
                </div>

            </form>

        </div>
    </div>

</body>

</html>