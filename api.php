<?php




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["salvar"])) {


        session_start();
        $planoTipo = $_POST["planoTipo"];
        if ($_POST["plano"] == "") {
            header("location:index.php");
            die();
        }
        $dados = $_POST["plano"];
        $jsonPrice = file_get_contents("prices.json");
        $price = json_decode($jsonPrice);

        $pessoas = count($dados);
        $precoTotal = [];
        $beneficiarios = [];

        foreach ($dados as $key => $value) {
            $pessoa = new stdClass();
            $pessoa->nome = $value["nome"];
            $pessoa->plan = $planoTipo;
            $pessoa->idade = $value["idade"];
            $pessoa->numero = $pessoas;

            foreach ($price as $key => $value) {

                if ($value->codigo == $planoTipo && $value->minimo_vidas <= $pessoas) {
                    if ($pessoa->idade < 18) {
                        $preco =  $value->faixa1;
                        $pessoa->valor = $preco;
                    } elseif ($pessoa->idade >= 18 && $pessoa->idade <= 40) {
                        $preco = $value->faixa2;
                        $pessoa->valor = $preco;
                    } else {
                        $preco = $value->faixa3;
                        $pessoa->valor = $preco;
                    }
                    array_push($precoTotal, $preco);
                }
            }
            $beneficiarios[] =  $pessoa;
            $valorTotal = array_sum($precoTotal);
        }

        $arquivo = 'beneficiario.json';
        if (file_exists($arquivo)) {
            $json = json_decode(file_get_contents($arquivo), true);
        } else {
            $json = [];
        }
        $json[] = $beneficiarios;
        file_put_contents($arquivo, json_encode($json));

        $jsonBeneficiario = file_get_contents("beneficiario.json");
        $beneficiario = json_decode($jsonBeneficiario);
        $jsonPlano = file_get_contents("plans.json");
        $plano = json_decode($jsonPlano);
        foreach ($plano as $key => $value) {
            if ($value->codigo == $planoTipo) {
                $planoNome = $value->nome;
            }
        }
        $ultimo = end($beneficiario);
        $_SESSION["ultimo"] = $ultimo;
        $_SESSION["total"] = $valorTotal;
        $_SESSION["plano"] = $planoNome;
        header("location:index.php");
        die();
    }
}
