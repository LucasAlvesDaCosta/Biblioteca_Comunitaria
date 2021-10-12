<?php
    $servidor = "localhost:3307";
    $usuario = "root";
    $senha = "Gravidade";
    $dbname = "tutocrudphp";
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    $pesquisar = $_POST['pesquisar'];
    $result_cursos = "SELECT Id FROM cliente";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    $i =0;
    $j =0;
    $k =0;
       while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
        
       // echo 'id: ' .$rows_cursos['Id'].'<br>';
       $i +=1;
      } 
    
         
            $result_cursos = "SELECT Id FROM servidor";
            $resultado_cursos = mysqli_query($conn, $result_cursos);
            
            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){

               // echo 'Id doador: ' .$rows_cursos['Id'].'br';
                
               $j +=1;
          }
          $result_cursos = "SELECT Id FROM doador";
            $resultado_cursos = mysqli_query($conn, $result_cursos);
            
            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){

               // echo 'Id doador: ' .$rows_cursos['Id'].'br';
                
               $k +=1;
          }

 ?>    
<html>
<head>
       <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
<nav id="nav-bar" class="navbar navbar-expand-md navbar-light fixed-top">
     <h4>Biblioteca Comunitária</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!--<ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Clubes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Regulamento</a>
            </li>
          </ul>-->
          

          <div class="ml-auto">
            <ul class="navbar-nav">
              
              <li class="nav-item">
                <a class="nav-link" href="home.html">Voltar</a>
              </li>
          
            </ul>
            
          </div><!-- /ml-auto -->

        </div><!-- /collapse -->

      </div><!-- /container -->
    </nav>
<meta charset="utf-8">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
//carregando modulo visualization
google.load("visualization", "1", {packages:["corechart"]});

//função de monta e desenha o gráfico
function drawChart() {
//variavel com armazenamos os dados, um array de array's
//no qual a primeira posição são os nomes das colunas
var data = google.visualization.arrayToDataTable([
['Cadastros realizados durante um dia', 'Quando gosto dela'],
['Usuário', <?=$i?>],
['Servidor', <?=$j?>],
['Doador', <?=$k?>]

]);
//opções para exibição do gráfico
var options = {
title: 'Cadastros realizados',//titulo do gráfico
is3D: true // false para 2d e true para 3d o padrão é false
};
//cria novo objeto PeiChart que recebe
//como parâmetro uma div onde o gráfico será desenhado
var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
//desenha passando os dados e as opções
chart.draw(data, options);
}
//metodo chamado após o carregamento
google.setOnLoadCallback(drawChart);
</script>
</head>
<body>
      
<div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>