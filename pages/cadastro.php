<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Instituicao</title>
    <link rel="shortcut icon" href="../imgs/favicon/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="../fonts/nunito/Nunito-Regular.ttf">
    <script src="../JS/script_formulario.js" defer></script>
    <script src="../lib/jquery/jquery.js" defer></script>
    <script src="../lib/mask/script_mask.js" defer></script>
    <style>
        :root {

            --height-input: 45px;

        }

        * {
           font-family: Nunito !important;
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

        .container-cadastro {

            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0px 3px 10px 1px #000000;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            height: 600px;
            justify-content: space-around;
            left: 50%;
            overflow: visible;
            position: absolute;
            text-align: center;
            transform: translate(-50%, -60%);
            top: 50%;
            width: 500px;
            z-index: 1;

        }

        .form-cadastro {

            position: relative;
            height: 70%;
            width: 100%;
            z-index: 1;

        }

        .titulo-cadastro {

            font-size: 40px;

        }

        .box-input {

            display: flex;
            flex-direction: column;
            margin: 25px 48px;
            width: fit-content;

        }

        .nome-campo {

            font-size: 23px;
            margin: 5px 0;
            text-align: left;

        }

        input {

            background-color: white;
            border: solid 1px gray;
            border-radius: 7px;
            font-size: 20px;
            outline: none;

        }

        #nome-inst {

            height: var(--height-input);
            text-indent: 10px;
            width: 400px;

        }

        #sigla-inst {

            height: var(--height-input);
            text-align: center;
            text-transform: uppercase;
            width: 100px;

        }

        #nome-inst,
        #sigla-inst {

            outline: solid 0px rgba(68, 176, 230, 0.7);
            transition: outline 0.1s ease-out;

        }

        #nome-inst:focus,
        #sigla-inst:focus,
        #nome-inst:hover,
        #sigla-inst:hover {

            outline: solid 4px rgba(68, 176, 230, 0.7);

        }

        .submit-cad-inst {

            background-color: #44b0e6;
            border: none;
            border-radius: 20px;
            box-shadow: 0px 0px 8px rgb(175, 175, 175);
            color: white;
            font-size: 20px;
            font-weight: bold;
            height: 60px;
            position: absolute;
            right: 50%;
            top: 80%;
            transform: translateX(50%);
            width: 200px;

        }

        .submit-cad-inst:focus {

            box-shadow: inset 0px 0px 5px rgb(121, 121, 121);

        }

        .box-alert {
            width: 30%;
            padding: 5px 0;
            text-align: center;
            top: -390px;
            position: relative;
            border-radius: 5%;
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


    if (isset($_POST['acao'])) {
        $nome_inst = $_POST['nome_inst'];
        $sigla_inst = $_POST['sigla_inst'];



        $cadastro_instituicao = Conexao::conectar()->prepare("INSERT INTO maleta.cadastro_instituicao(nome, sigla)
	VALUES ('$nome_inst', '$sigla_inst')");
        $cadastro_instituicao->execute();
       Comandos::alert('sucesso', ' cadastro realizado com sucesso!');

    }
    ?>

    <div class=" container-cadastro">

        <h1 class="titulo-cadastro">Cadastro de Instituição</h1>

        <form method="POST" class=" form-cadastro">

            <div class="box-input">

                <label for="nome-inst" class="nome-campo">Nome da instituição</label>
                <input type="text" id="nome-inst" name="nome_inst" required>

            </div>

            <div class="box-input">

                <label for="sigla-inst" class="nome-campo">Sigla</label>
                <input type="text" id="sigla-inst" name="sigla_inst" required>

            </div>

            <button type="submit" class="submit-cad-inst" name="acao">CONFIRMAR</button>

        </form>

    </div>



</body>


</html>