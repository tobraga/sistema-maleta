<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Histórico de Empréstimo</title>
  <link rel="shortcut icon" href="../imgs/favicon/favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
  <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../JS/script_formatarData.js" defer></script>

<link rel="stylesheet" href="../lib/icons/css/icons.css">


  <style>
    body {

      align-items: center;
      background-image: linear-gradient(to right, #288f21, #64C25D, #44b0e6, #4537A3);
      display: flex;
      font-family: Nunito;
      height: 100vh;
      justify-content: center;
      
    }

    /*td{
      display: flex;
      justify-content: center;

    }*/

    .container-ativos {

      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0px 3px 10px 1px #000000;
      box-sizing: border-box;
      flex-direction: column;
      height: 800px;
      justify-content: space-around;
      left: 50%;
      overflow: auto;
      position: absolute;
      text-align: center;
      transform: translate(-50%, -50%);
      top: 50%;
      width: 1200px;

    }

    .titulo {

      font-size: 40px;
      font-weight: bold;
      margin: 20px 0;

    }

    .box-alert {
      width: 30%;
      padding: 5px 0;
      text-align: center;
      top: -390px;
      position: relative;
      border-radius: 5%;
    }

    .box-label{ 
      border: solid gray 0.3px;
      border-radius: 8px;
      box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
      margin: 15px;
      padding: 8px;
      position: absolute;
      font-weight: 800;
      top: 0;
    }

    .box-label div{
      text-align: start;
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

    @keyframes anim-botao {
      to{
        opacity: 0;
        transform: scale(1.15, 1.5);
      }
    }

    #botao-finalizar{
      position: relative;
    }

    #botao-finalizar::before{
      border: #dc3545 solid 2px;
      border-radius: 8px;
      bottom: 0;
      content: "";
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
    }

    #botao-finalizar:hover::before{
      animation: anim-botao 1.75s cubic-bezier(0.33,1,0.68,1) infinite; 
    }

   

    #botao-finalizar::before:active{
      transform: translateY(2px); 
    }


  </style>
</head>

<body>

  <?php
  require_once('../config/conexao.php');
  require_once('../config/painel.php');
  $consultaAtivo = Conexao::conectar()->prepare("SELECT id_emprestimo,data_inicio, data_fim, processo, nome, codigo_maleta, data_devolucao
                                                  FROM maleta.emprestimo
                                                  INNER JOIN maleta.cadastro_instituicao ON cadastro_instituicao.id = fk_id_instituicao
                                                  INNER JOIN maleta.cadastro_maleta ON id_maleta = fk_id_maleta
                                                  ORDER BY data_inicio;");
  $consultaAtivo->execute();
  $consultaAtivo = $consultaAtivo->fetchAll();
  

  $qtdAtivo = Conexao::conectar()->prepare("SELECT  em_campo, count(em_campo) AS teste
                                    FROM maleta.emprestimo
                                    WHERE emprestimo.em_campo = true
                                    GROUP BY em_campo;");  

  $qtdAtivo->execute();
  $qtdAtivo = $qtdAtivo->fetchAll();

  $qtdCrbe = Conexao::conectar()->prepare("SELECT  em_campo, count(em_campo) AS teste2
                                    FROM maleta.emprestimo
                                    WHERE emprestimo.em_campo = false
                                    GROUP BY em_campo;");  

  $qtdCrbe->execute();
  $qtdCrbe = $qtdCrbe->fetchAll();



  ?>

  <div class="container-ativos">

    <h1 class="titulo">Histórico de Empréstimos</h1>

   

    <table class="table table-hover">
      <thead>
        <tr>
        <th> ID</th>
          <th> Data Inicio</th>
          <th> Data Fim</th>
          <th> Data Devolução</th>
          <th> Processo</th>
          <th> Instituicao</th>
          <th> Nº Maleta</th>
          </tfoot>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        foreach ($consultaAtivo as $consultaAtivo) {
          $id_emprestimo = $consultaAtivo['id_emprestimo'];
          $data_devolucao = NULL;
          
        ?>
          <tr>
          <td class=""><?php echo $consultaAtivo['id_emprestimo']; ?></td>
            <td class=""><?php echo date('d/m/Y',strtotime($consultaAtivo['data_inicio'])); ?></td>
            <td class=""><?php echo date('d/m/Y',strtotime($consultaAtivo['data_fim'])); ?></td>
            <td class=""><?php if (strtotime($consultaAtivo['data_devolucao']) == '') {
                            echo '-'
                                . $consultaAtivo['data_devolucao'] . '';
                        } else {
                            echo $consultaAtivo['data_devolucao'] . '';
                        } ?></td>
            <td class=""><?php echo $consultaAtivo['processo']; ?></td>
            <td class=""><?php echo $consultaAtivo['nome']; ?></td>
            <td class=""><?php echo $consultaAtivo['codigo_maleta']; ?></td>
            


          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>

</html>