<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <script src="../lib/bootstrap/js/bootstrap.js" defer></script>
    <script src="../lib/jquery/jquery.js" defer></script>
    <script src="../lib/mask/script_mask.js" defer></script>

    <style>
        :root {

            --height-input: 45px;
            --width-corpo: 600px;

        }
        
        * {

            font-family: Nunito;
            margin: 0;
            padding: 0;

        }

        body {

            align-items: center;
            background-image: linear-gradient(to right, #288f21, #64C25D, #44b0e6, #4537A3);
            display: flex;
            height: 100vh;
            justify-content: center;

        }

        p,
        label,
        h1 {

            font-weight: bold;

        }

        .container-emprestimo {

            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0px 3px 10px 1px #000000;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            height: 900px;
            justify-content: space-around;
            left: 50%;
            overflow: visible;
            position: absolute;
            text-align: center;
            transform: translate(-50%, -50%);
            top: 50%;
            width: 900px;

        }

        .form-emprestimo {

            align-items: center;
            display: flex;
            flex-direction: column;
            height: 80%;
            justify-content: space-between;
            width: 100%;
            z-index: 1;

        }

        .titulo {

            font-size: 40px;
            margin: 0;

        }

        .grid-box {

            display: grid;
            grid-template: 100% / 50% 50%;
            width: 100%;

        }

        .flex-box {

            align-items: flex-start;
            display: flex;
            flex-direction: column;
            width: var(--width-corpo);

        }

        .box-input {

            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            width: fit-content;

        }



        .nome-campo {

            font-size: 20px;
            margin: 5px 0;
            text-align: left;

        }

        select,
        input,
        .descricao {

            background-color: white;
            border: solid 1px gray;
            border-radius: 7px;
            font-size: 20px;
            height: 40px;
            outline: solid 0px rgba(68, 176, 230, 0.7);
            transition: outline 0.1s ease-out;

        }


        input[name="num-processo"] {

            text-indent: 10px;

        }

        select[name="instituicao"] {

            width: 400px;

        }

        .descricao {

            height: 200px;
            resize: none;
            text-align: start;
            text-indent: 8px;
            width: var(--width-corpo);

        }

        select:hover,
        select:focus,
        input:hover,
        input:focus {

            outline: solid 4px rgba(68, 176, 230, 0.7);

        }

        .exemplo {

            color: rgba(0, 0, 0, 0.7);
            font-style: italic;
            text-align: start;

        }

        .submit-cad-inst {

            background-color: #44b0e6;
            border: none;
            border-radius: 20px;
            box-shadow: 0px 0px 8px rgb(175, 175, 175);
            color: white;
            font-size: 20px;
            font-weight: bold;
            height: 70px;
            width: 200px;

        }

        .submit-cad-inst:focus {

            box-shadow: inset 0px 0px 5px rgb(121, 121, 121);

        }

        .box-alert {
            width: 30%;
            padding: 5px 0;
            text-align: center;
            top: -430px;
            position: relative;
            border-radius: 5%;
            z-index: 1000;
            right: 10px;

        }

        .sucesso {
            background: #a5d6a7;
            color: white;
        }

        .erro {
            background: #F75353;
            color: white;
        }

        @font-face {
            font-family: Nunito;
            src: url("../lib/fonts/nunito/Nunito-Regular.ttf");
        }
    </style>
</head>

<body>

    <?php
    require_once('../config/conexao.php');
    require_once('../config/painel.php');

    if (isset($_POST['enviar'])) {

        $num_maleta = $_POST['num_maleta'];
        $num_processo = $_POST['num_processo'];
        $instituicao = $_POST['instituicao'];
        $dataIni = $_POST['dataIni'];
        $dataFim = $_POST['dataFim'];
        $descricao = $_POST['descricao'];


        $cadastroEmprestimo = Conexao::conectar()->prepare("INSERT INTO maleta.emprestimo (data_inicio, data_fim, processo, descricao, fk_id_instituicao, fk_id_maleta)
            VALUES ('$dataIni','$dataFim', '$num_processo','$descricao','$instituicao','$num_maleta')");
        $cadastroEmprestimo->execute();

        Comandos::alert('sucesso', ' cadastro realizado com sucesso!');
       
    }

    ?>

    <div class="container-emprestimo">

        <img src=".././imgs/logo-maior.png" style="position: absolute; top: 0.7%; right: 3%; transform: scale(0.7,0.7);" alt="logo-sipam">
        <h1 class="titulo">Solicitação de Empréstimo</h1>

        <form method="POST" class="form-emprestimo">

            <div class="flex-box">
                <div class="box-input">

                    <label class="nome-campo">Selecione o nº da Maleta</label>
                    <select name="num_maleta">

                        <option seleted disable value=""></option>
                        <?php
                        $consultaMaleta = Conexao::conectar()->prepare("SELECT id_maleta, codigo_maleta FROM maleta.cadastro_maleta;");
                        $consultaMaleta->execute();

                        $consultaMaleta = $consultaMaleta->fetchAll();
                        foreach ($consultaMaleta as $consultaMaleta) {
                        ?>
                            <option value="<?php echo $consultaMaleta['id_maleta']; ?>">
                                <?php echo $consultaMaleta['codigo_maleta']; ?>
                            </option>
                        <?php } ?>
                        ?>

                    </select>

                </div>


                <div class="box-input">

                    <label for="nome-inst" class="nome-campo">Digite nº Processo</label>
                    <input type="text" name="num_processo" id="num_processo" required onkeypress="$(this).mask('00000.000000/0000-00')">
                    <label class="exemplo">Ex: 12345.123456/2021-12</label>

                </div>


                <div class="box-input">

                    <label class="nome-campo">Selecione a Instituição</label>
                    <select name="instituicao">

                        <<option seleted disable value="">
                            </option>
                            <?php
                            $consultaInstituicao = Conexao::conectar()->prepare("SELECT id, nome FROM maleta.cadastro_instituicao;");
                            $consultaInstituicao->execute();

                            $consultaInstituicao = $consultaInstituicao->fetchAll();
                            foreach ($consultaInstituicao as $consultaInstituicao) {
                            ?>
                                <option value="<?php echo $consultaInstituicao['id']; ?>">

                                    <?php echo $consultaInstituicao['nome']; ?>
                                </option>
                            <?php } ?>
                            ?>

                    </select>

                </div>


                <div class="grid-box">
                    <div class="box-input">

                        <label class="nome-campo">Data de início</label>
 <input oninput="dataMin(this.value)" type="date" name="dataIni" min="" required>
                    </div>

                    <div class="box-input">

                        <label class="nome-campo">Data de Fim</label>
                        <input type="date" name="dataFim" min="" required>

                    </div>

                </div>

            </div>

            <div class="box-input">
                <label class="nome-campo">Descrição:</label>
                <textarea class="descricao" name="descricao" placeholder="Ex: 'O aparelho vai ser operado em Imperatriz-MA'"></textarea>
            </div>
            <button type="submit" class="submit-cad-inst" name="enviar">CONFIRMAR</button>

        </form>


    </div>



</body>
    <script src="../JS/script_formulario.js"></script>

</html>