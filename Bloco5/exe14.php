<?php
$itens_selecionados = [];
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['itens'])) {

        $itens_selecionados = $_POST['itens'];

        foreach ($itens_selecionados as $key => $item) {
            $itens_selecionados[$key] = htmlspecialchars(trim($item));
        }
    } else {
        $erros[] = "Voce deve selecionar pelo menos um item da lista";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <h2>Lista de Compras</h2>
    <p>Selecione os itens desejados:</p>

    <?php

    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul></div>";
    }


    if (count($itens_selecionados) > 0) {
        echo "<div class='resultado'>";
        echo "Itens selecionados:<br>";

        foreach ($itens_selecionados as $item) {
            echo "- $item <br>";
        }

        echo "</div>";
    }
    ?>

    <form method="post">

        <div>
            <input type="checkbox" name="itens[]" value="Arroz" id="arroz">
            <label for="arroz">Arroz</label>
        </div>

        <div>
            <input type="checkbox" name="itens[]" value="Feijão" id="feijao">
            <label for="feijao">Feijão</label>
        </div>

        <div>
            <input type="checkbox" name="itens[]" value="Leite" id="leite">
            <label for="leite">Leite</label>
        </div>

        <div>
            <input type="checkbox" name="itens[]" value="Ovos" id="ovos">
            <label for="ovos">Ovos</label>
        </div>

        <div>
            <input type="submit" value="Adicionar à Lista">
        </div>

    </form>

</body>

</html>