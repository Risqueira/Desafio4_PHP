<?php

$n1 = "";
$n2 = "";
$res = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['n1']) && $_POST['n1'] !== "") {
        $valor_n1 = str_replace(',', '.', trim($_POST['n1']));

        if (!is_numeric($valor_n1)) {
            $erros[] = "O campo numero inicial deve conter um valor numerico";
        } else {
            $n1 = (int)$valor_n1;
        }
    } else {
        $erros[] = "o campo numero inicial e obrigatorio";
    }

    if (isset($_POST['n2']) && $_POST['n2'] !== "") {
        $valor_n2 = str_replace(',', '.', trim($_POST['n2']));

        if (!is_numeric($valor_n2)) {
            $erros[] = "O campo numero inicial deve conter um valor numerico";
        } else {
            $n2 = (int)$valor_n2;
        }
    } else {
        $erros[] = "o campo numero inicial e obrigatorio";
    }

    if(count($erros) == 0){

        $inicio = min($n1, $n2);
        $fim = max($n1, $n2);

        $pares = [];

        for($i = $inicio; $i <= $fim; $i++){
            if($i % 2 == 0){
                $pares[] = $i;
            }
        }

        if(count($pares) > 0){
            $res = "pares entre $inicio e $fim: " . implode(",", $pares);
        }else{
            $res = "não ha numeros pares entre $inicio e $fim.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sequência de Pares</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>

<h1>Sequência de Pares (Intervalo)</h1>

<?php
if (count($erros) > 0) {
    echo "<div class='erro'><ul>";
    foreach ($erros as $erro) {
        echo "<li>$erro</li>";
    }
    echo "</ul></div>";
}

if ($res !== "") {
    echo "<div class='resultado'>$res</div>";
}
?>

<form method="post">
    <div>
        <label>Número Inicial:</label>
        <input type="number" name="n1" value="<?= htmlspecialchars($_POST['n1'] ?? '') ?>">
    </div>

    <div>
        <label>Número Final:</label>
        <input type="number" name="n2" value="<?= htmlspecialchars($_POST['n2'] ?? '') ?>">
    </div>

    <input type="submit" value="Calcular Pares">
</form>

</body>
</html>