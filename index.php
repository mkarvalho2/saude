<?php


session_start();

if (isset($_SESSION['ultimo'])) {
    $dados = $_SESSION['ultimo'];
}
if (isset($_SESSION['total'])) {
    $total = $_SESSION['total'];
    $total = number_format($total, 2, '.', '');
}
if (isset($_SESSION['plano'])) {
    $plano = $_SESSION['plano'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>planos de saude</title>
</head>
<style>
    .configdiv {
        border: 1px solid #DDDDDD;
        margin-right: 28px;
        margin-bottom: 25px;
        padding: 10px;
    }

    .lixeiraWell {

        /* Green */
        border: none;
        text-align: center;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>

<body>

    <div class="container">
        <div class=" container clearfix">
            <div class="col-md-6 configdiv"> Planos de Saude</div>

            <div class="col-md-12 configdiv">

                <form action="api.php" name="form-add" method="POST">
                    <input type="hidden" value="salvar" id="salvar" name="salvar">
                    <div>

                        <select name="planoTipo" id="planoTipo">
                            <option value="1">Bitix Customer Plano 1</option>
                            <option value="2">Bitix Customer Plano 2</option>
                            <option value="3">Bitix Customer Plano 3</option>
                            <option value="4">Bitix Customer Plano 4</option>
                            <option value="5">Bitix Customer Plano 5</option>
                            <option value="6">Bitix Customer Plano 6</option>
                        </select>
                    </div>
                    </br>
                    <button id="add" type="button" class="btn btn-success">adicionar</button>
                    <br>
                    <div id="row1">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">salvar</button>

                </form>
                <br>
                <br>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">idade</th>
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($dados)) {
                                foreach ($dados as $key => $value) {
                                    echo "<tr>";
                                    echo "<td> " . $value->nome . "</td>";
                                    echo "<td> " . $value->idade . "</td>";
                                    echo "<td> " . $value->valor . "</td>";
                                    echo "</tr>";
                                }
                            }



                            ?>
                        </tbody>
                    </table>

                </div>
                <div>
                    <?php
                    if (isset($total)) {
                        echo "<h6> Valor total : " . $total . "R$ no plano " . $plano . "</h6>";
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>




</body>
<script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>
    $("#add").on("click", function() {

        var beneficiarios = $(".row").length + 1;
        var id = beneficiarios
        $("#row1").append(
            `  <div class="row" >
                   
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="plano[${id}][nome]">nome</label>
                        <input type="text" name="plano[${id}][nome]">

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label for="plano[${id}][idade]">idade</label>
                        <input type="int" name="plano[${id}][idade]">
                    </div>
                        <button type="button" class="lixeiraWell btn btn-danger aria-hidden="true">deletar</i></button>
                    </br>    
                </div>`
        )

    })

    $("#row1").on('click', ".lixeiraWell", function() {
        $(this).parent().remove();
        isDirty = true;
    })
</script>
<?php
session_destroy();
?>

</html>