<?php

$num = "";
$res = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['num'])) {
        $num = str_replace(',', '.', trim($_POST['num']));

        if (!is_numeric($num)) {
            $erros[] = "O campo Número deve ser preenchido com numericos";
        }
    } else {
        $erros[] = "O campo Número é obrigatorio";
    }

    if (count($erros) == 0) {

        if ($num % 2 == 0) {
            $res = "O número $num é PAR";
        } else {
            $res = "O número $num é ÍMPAR";
        }
    }

    if (isset($_POST['num'])) {
        $num = htmlspecialchars(trim($_POST['num']));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 5 - Par ou Ímpar</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <div class="container">

        <h2>Par ou Ímpar</h2>

        <div class="exercicio">


            <?php
            if (count($erros) > 0) {
                echo "<div class='erro'><ul>";

                foreach ($erros as $erro) {
                    echo "<li>$erro</li>";
                }

                echo "</ul></div>";
            }

            if (!empty($res)) {
                echo "<div class='resultado'>$res</div>";
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div>
                    <label for="num">Número:</label>
                    <input type="text" id="num" name="num"
                        value="<?php echo $num; ?>">
                </div>

                <input type="submit" value="Verificar">

            </form>

        </div>
    </div>
    
</body>

</html>