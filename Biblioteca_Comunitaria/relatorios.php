
<?php
   require_once("dompdf/dompdf_config.inc.php");
    $servidor = "localhost:3307";
    $usuario = "root";
    $senha = "Gravidade";
    $dbname = "tutocrudphp";
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    $pesquisar = $_POST['pesquisar'];
    $result_cursos = "SELECT Id FROM livros ";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    $i =0;
    $j =0; 
    $k =0;   
    $l =0;  
    
       while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
        
       // echo 'id: ' .$rows_cursos['Id'].'<br>';
       $i +=1;
      } 
    
         
            $result_cursos = "SELECT Id FROM doador";
            $resultado_cursos = mysqli_query($conn, $result_cursos);
            
            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){

               // echo 'Id doador: ' .$rows_cursos['Id'].'br';
                
               $j +=1;
          }

          $result_cursos = "SELECT Id FROM cliente";
            $resultado_cursos = mysqli_query($conn, $result_cursos);
            
            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){

               // echo 'Id doador: ' .$rows_cursos['Id'].'br';
                
               $k +=1;
          }
          $result_cursos = "SELECT Id FROM servidor";
          $resultado_cursos = mysqli_query($conn, $result_cursos);
          
          while($rows_cursos = mysqli_fetch_array($resultado_cursos)){

             // echo 'Id doador: ' .$rows_cursos['Id'].'br';
              
             $l +=1;
        }
 ?>    
 <?php  
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');       
/* Cria a instância */
$dompdf = new DOMPDF();

/* Carrega seu HTML */
$dompdf->load_html("
<meta charset='utf-8'>
<h1>RELATÓRIO DE CADASTROS REALIZADOS</h1>
<p>Neste mês foi realizado a contalibilização de cadastros que constatou um total de:<br> - $i livros doados. <br>E um total de:<br>  - $j doadores.<br><br> Constatando a boa execução do sistema, pois a quantidade de doadores tem que ser menor ou igual a quantidade de livros doados</p>
<br><h4>Cadastro de Usuários do sistema:</h4>
<p> Temos em nosso Banco da Dados Um Total de:($k) Usuários cadastrados.</p>
<br> <h4>Cadastro de Servidores:</h4>
<p> Temos em nosso Banco de dados um total de:($l) Servidores cadastrados.<br><h2>Biblioteca Comunitária.</h4> </p>");

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream(
    "Relatorio_cadastro.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
?>


