<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edição de Emprestimo</title>
    <link rel="shortcut icon" href="../imgs/favicon/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="../css/style_main.css">
    <script src="../lib/jquery/jquery.js" defer></script>
    <script src="../lib/mask/script_mask.js" defer></script>

    <style>
        :root {

            --height-input: 45px;
            --width-corpo: 600px;
            --altura-container: 1000px;

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
            height: calc(var(--altura-container) + 20px);
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
            height: var(--altura-container);
            justify-content: space-around;
            left: 50%;
            overflow: visible;
            position: absolute;
            text-align: center;
            transform: translate(-50%, -42%);
            top: 390px;
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
            text-indent: 5px;
            transition: outline 0.1s ease-out;

        }

        input[name="instituicao"] {
            width: 400px;
            overflow: scroll;
        }

        .descricao {

            height: 200px;
            resize: none;
            text-align: start;
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
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            height: 70px;
            position: relative;
            width: 200px;

        }

        .submit-cad-inst:focus {

            box-shadow: inset 0px 0px 5px rgb(121, 121, 121);

        }

        .submit-cad-inst::before{
            border: #44b0e6 solid 2px;
            border-radius: 20px;
            bottom: 0;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .submit-cad-inst:hover::before{
            animation: anim-botao 1.75s cubic-bezier(0.33,1,0.68,1) infinite; 
        }

    

        .submit-cad-inst::before:active{
            transform: translateY(2px); 
        }
        
        @keyframes anim-botao {
            to{
                opacity: 0;
                transform: scale(1.15, 1.5);
            }
        }

        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;

        }

        input[type=number] {

            -moz-appearance: textfield;
            appearance: textfield;

        }

        .box-alert {
            width: 30%;
            padding: 5px 0;
            text-align: center;
            position: relative;
            border-radius: 5%;
            top: -520px;
            right: 40px;
            z-index: 1000;
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
    $id_emprestimo = (!empty($_GET['id_emprestimo']) ? $_GET['id_emprestimo'] : '');

    require_once('../config/conexao.php');
    require_once('../config/painel.php');

    if (isset($_POST['atualizar'])) {
        //$maleta = $_POST['maleta'];
        //$numero_processo = $_POST['numero_processo'];
        //$instituicao = $_POST['instituicao'];
        //$dataIni = $_POST['dataIni'];
        $dataFim = $_POST['dataFim'];
        $num_prorrogacao = $_POST['num_prorrogacao'];
        $descricao = $_POST['descricao'];


       
        $updateEmprestimo = Conexao::conectar()->prepare("UPDATE maleta.emprestimo SET data_fim = ?, prorrogacao = ?, descricao = ? WHERE id_emprestimo=$id_emprestimo ");
        $updateEmprestimo->execute(array($dataFim, $num_prorrogacao, $descricao));

        Comandos::alert('sucesso', ' Emprestimo Atualizado com sucesso!');
    }

    ?>

    <div class="container-emprestimo">

        <img src="../imgs/logo-maior.png" style="position: absolute; top: 0.7%; right: 3%; transform: scale(0.7,0.7);" alt="logo-sipam">
        <h1 class="titulo">Atualização de Empréstimos</h1>

        <form class="form-emprestimo" method="post">

            <?php
            require_once('../config/conexao.php');
            require_once('../config/painel.php');
            $id_emprestimo = (!empty($_GET['id_emprestimo']) ? $_GET['id_emprestimo'] : '');


            $editandoEmprestimo = Conexao::conectar()->prepare("SELECT id_emprestimo,data_inicio, data_fim, processo,prorrogacao, descricao, nome, codigo_maleta
                                            FROM maleta.emprestimo
                                            INNER JOIN maleta.cadastro_instituicao ON cadastro_instituicao.id = fk_id_instituicao
                                            INNER JOIN maleta.cadastro_maleta ON id_maleta = fk_id_maleta WHERE id_emprestimo=$id_emprestimo;");
            $editandoEmprestimo->execute();
            $edicao = $editandoEmprestimo->fetchAll();



            ?>

            <?php foreach ($edicao as $editando) { ?>

                <div class="flex-box">
                    <div class="box-input">

                        <label class="nome-campo">Nº Maleta</label>
                        <input type="text" class="form-control" id="maleta" name="maleta" disabled placeholder="" value="<?php echo $editando['codigo_maleta']; ?>">

                    </div>


                    <div class="box-input">

                        <label for="nome-inst" class="nome-campo">N° Processo</label>
                        <input type="text" name="num_processo" id="num_processo" disabled value="<?php echo $editando['processo']; ?>">

                    </div>

                    <div class="box-input">

                        <label class="nome-campo">Instituição</label>
                        <input type="text" name="instituicao" id="instituicao" disabled value="<?php echo $editando['nome']; ?>">

                    </div>


                    <div class="grid-box">

                        <div class="box-input">

                            <label class="nome-campo">Data de início</label>
                            <input class="data" type="date" name="dataIni" oninput="dataMin(this.value)" id="dataIni" disabled value="<?php echo $editando['data_inicio']; ?>">
                        </div>

                        <div class="box-input">

                            <label class="nome-campo">Data de Fim <span style="color: red;">*</span></label>
                            <input class="data" type="date" name="dataFim" min="" required>

                        </div>

                    </div>

                    <div class="box-input">

                        <label for="nome-inst" class="nome-campo">Ofício de Prorrogação <span style="color: red;">*</span></label>
                        <input type="text" name="num_prorrogacao" id="num_prorrogacao" value="<?php echo $editando['prorrogacao']; ?>">

                    </div>

                </div>



                <div class="box-input">
                    <label class="nome-campo">Descrição:</label>
                    <textarea class="descricao" name="descricao" id="descricao"> <?php echo $editando['descricao']; ?></textarea>
                </div>

            <?php } ?>
            <button type="submit" class="submit-cad-inst" name="atualizar">Atualizar</button>

        </form>


    </div>

    <!-- SCRIPTS -->
    <script src="../JS/script_formulario.js"></script>
    <script>

        dataMin(document.getElementsByName('dataIni')[0].value)

    </script> 
</body>

</html>