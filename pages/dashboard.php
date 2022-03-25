<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../imgs/favicon/favicon.ico" type="image/x-icon">

    <script src="../JS/script_formatarData.js" defer></script>
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../lib/icons/css/icons.css">

</head>
<style>

    *{
        font-family: Nunito !important;
    }

    body{
        background-image: linear-gradient(to right, #288f21, #64C25D, #44b0e6, #4537A3);
    }

    .container-table{
        background-color: white;
        border: solid rgba(0, 0, 0, 0.2) 1.5px;
        border-radius: 18px;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.3) ;
        display: flex;
        flex-direction: column;
        padding: 15px;
        width: 90vw;
        margin: 30px auto;
    }

    .container-gant{
        background-color: white;
        border: solid rgba(0, 0, 0, 0.2) 1.5px;
        border-radius: 18px;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.3) ;
        display: flex;
        flex-direction: column;
        padding: 15px;
        width: 1800px;
        margin: 30px auto;
    }

    button{
        align-self: flex-end;
        height: 50px;
        width: 150px;
    }

    td{
        text-align: center;
        vertical-align:middle;
    }
    .marcado{  
        background-color: #ABF8FF !important;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.25);
    }
    #google-visualization-errors-all-1 span{
      display: none;
    }

    @keyframes anima {
        to {
            color: white;
        }
    }

    .datafim {
        color: orange;
        /**animation: anima 800ms ease-in infinite;     EFEITO DE ANIMAÇÃO NA DATA FOI RETIRADO**/
    }
    
@keyframes pulse {
	0% {
		transform: scale(0.95);
		box-shadow: 0 0 0 0 rgba(251, 158, 18, 1);
	}

	100% {
		transform: scale(1);
		box-shadow: 0 0 0 10px rgba(251, 158, 18, 0);
	}
}
    .gg-danger {
        color: #FB9E12;
        animation: pulse 1.5s ease normal infinite;
        margin: auto;
    }

    @font-face {
            font-family: Nunito;
            src: url("../lib/fonts/nunito/Nunito-Regular.ttf");
    }
    svg>text{
        background-color: green !important;
        word-wrap: break-word !important;
    }
</style>

<?php
require_once('../config/conexao.php');
$consultaAtivo = Conexao::conectar()->prepare("SELECT  id_emprestimo, codigo_maleta, data_inicio, data_fim,   data_fim - data_inicio   as total_dias,
     nome,sigla,processo,prorrogacao,data_devolucao
	FROM maleta.emprestimo
	INNER JOIN maleta.cadastro_instituicao ON cadastro_instituicao.id = fk_id_instituicao
    INNER JOIN maleta.cadastro_maleta ON id_maleta = fk_id_maleta Where em_campo = 'true' ORDER BY id_emprestimo ASC ");
$consultaAtivo->execute();
$consultaAtivo = $consultaAtivo->fetchAll();

?>

<body>
    <div class="container-table">
        <h2>Representação Gráfica</h2>
        
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Cod. Empréstimo</th>
                    <th scope="col">Cod. Maleta</th>
                    <th scope="col">Início</th>
                    <th scope="col">Término</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Instituição</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Processo Sei</th>
                    <th scope="col">Prorrogação</th>
                    <th scope="col" style="width: 100px;"></th>

                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($consultaAtivo as $consultaAtivo) {
                    $date = date('Y/m/d');



                ?>
                    <tr>
                        <td scope="col" class="id"><?php echo $consultaAtivo['id_emprestimo']; ?></td>
                        <td scope="col" class=""><?php echo $consultaAtivo['codigo_maleta']; ?></td>
                        <td scope="col" class="data"><?php echo $consultaAtivo['data_inicio']; ?></td>
                        <?php if (strtotime($consultaAtivo['data_fim']) < strtotime($date)) {
                            echo '<td class="datafim data">' . $consultaAtivo['data_fim'] . '</td>';
                        } else {
                            echo '<td class="data">' . $consultaAtivo['data_fim'] . '</td>';
                        }
                        ?>
                        <td scope="col" class=""><?php echo $consultaAtivo['total_dias']; ?></td>
                        <td scope="col" class=""><?php echo $consultaAtivo['nome']; ?></td>
                        <td scope="col" class=""><?php echo $consultaAtivo['sigla']; ?></td>
                        <td scope="col" class=""><?php echo $consultaAtivo['processo']; ?></td>
                        <td scope="col" class=""><?php echo $consultaAtivo['prorrogacao']; ?></td>
                        <?php if (strtotime($consultaAtivo['data_fim']) < strtotime($date)) {
                            echo '<td class=""><i class="gg-danger"></i>'
                                . $consultaAtivo['data_devolucao'] . '</td>';
                        } else {
                            echo '<td class="">'
                                . $consultaAtivo['data_devolucao'] . '</td>';
                        }
                        ?>





                    </tr>
                <?php }

                ?>
            </tbody>

        </table>

        <button class="btn btn-primary" id="btn">Limpar Marcação</button>

    </div>
    
    <div class="container-gant">
        <div id="chart_div"></div>
    </div>

</body>

<script type="text/javascript" src="../JS/gant.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['gantt']
    });
    google.charts.setOnLoadCallback(drawChart);


    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Task ID');
        data.addColumn('string', 'Task Name');
        data.addColumn('string', 'Resource');
        data.addColumn('date', 'Start Date');
        data.addColumn('date', 'End Date');
        data.addColumn('number', 'Duration');
        data.addColumn('number', 'Percent Complete');
        data.addColumn('string', 'Dependencies');

        data.addRows([
            <?php

           $cadastro_instituicao = Conexao::conectar()->prepare("SELECT date_part('year', data_inicio)as ano_inicio,
            date_part('month', data_inicio)as mes_inicio,
            date_part('day', data_inicio) as dia_inicio,
           date_part('year', data_fim)as ano_fim,
            date_part('month', data_fim)as mes_fim,
            date_part('day', data_fim) as dia_fim,				                                                
           data_fim - data_inicio as total_dias,
           (CURRENT_DATE - data_inicio)* 100 / (data_fim - data_inicio) as tempo_restante,
           id_emprestimo, data_inicio, data_fim, em_campo, nome,sigla,codigo_maleta, fk_id_instituicao, fk_id_maleta
           FROM maleta.emprestimo
           INNER JOIN maleta.cadastro_instituicao ON cadastro_instituicao.id = fk_id_instituicao
           INNER JOIN maleta.cadastro_maleta ON id_maleta = fk_id_maleta Where em_campo = 'true'");
            $cadastro_instituicao->execute();
            $result = $cadastro_instituicao->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $datarows) {
                if ($datarows['mes_inicio'] && $datarows['mes_fim'] >= 1) {
                    $datarows['mes_inicio']  =  $datarows['mes_inicio'] - 1;
                    $datarows['mes_fim']  =  $datarows['mes_fim'] - 1;
                }
                echo "['" . $datarows['id_emprestimo'] . " ','" . $datarows['nome'] . " ',' " . $datarows['nome'] . "', new Date(" . $datarows['ano_inicio'] . "," . $datarows['mes_inicio'] . "," . $datarows['dia_inicio'] . "),
                                        new Date(" . $datarows['ano_fim'] . "," . $datarows['mes_fim'] . "," . $datarows['dia_fim'] . "), " . $datarows['total_dias'] .  " ," . $datarows['tempo_restante'] . ",  " . 'null'  .  "],";
            }
            ?>
        ]);

        var options = {
            height: 400,
            gantt: {
                trackHeight: 30,
                criticalPathEnabled: false,
            }
        };

        var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

        chart.draw(data, options);

        var selectId = google.visualization.events.addListener(chart, 'select', function() {

            var row = chart.getSelection()[0].row;
            var idMaleta = parseInt(data.getValue(row, 0));
            console.log("id maleta: ", idMaleta)
            var ids = document.getElementsByClassName("id");

            for(id of ids){
                
                if(id.innerText == idMaleta){

                    id.parentNode.classList.add("marcado")

                }  else {

                    id.parentNode.classList.remove("marcado")

                }

            }   

            var btn = document.getElementById("btn");
            btn.addEventListener("click", function() {
            location.reload()

        }, );
        });
    }

        

    
</script>
</html>