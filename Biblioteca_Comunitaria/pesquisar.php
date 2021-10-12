
 <html>
     <head>
         <title> Resultado da busca.</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
         <link rel="shortcut icon" href="img/logo.png">
         <link rel="stylesheet" type="text/css" href="style.css">
     </head>
     <body>
     <nav id="nav-bar" class="navbar navbar-expand-md navbar-light fixed-top">
        <h5>Biblioteca Comunitária.</h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <div class="ml-auto">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="home.html">Home-page</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="livros_cadastro.php">Voltar</a>
              </li>
            </ul>
          </div><!-- /ml-auto -->

        </div><!-- /collapse -->

      </div><!-- /container -->
    </nav>
    <br>
    <br>
    <br>
      <?=$ident = $_POST['select'];?>
      <?php 
         if($ident == Titulo)
           $ident = 'Autor';
      ?>
     <table class="table table-striped table-bordered table-condensed table-hover" width="450px" border="3" cellspacing="1">
	  <tr>
        <td><strong>Num. identificação</strong></td>
	    <td><strong>Titulo</strong></td>
	    <td><strong><?=$ident?></strong></td>
      </tr> 
    

<?php
    $servidor = "localhost:3307";
    $usuario = "root";
    $senha = "Gravidade";
    $dbname = "tutocrudphp";
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    $pesquisar = $_POST['pesquisar'];
    $result_cursos = "SELECT Id,titulo,autor FROM livros WHERE titulo LIKE '%$pesquisar%' ";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    $i =1;
    $t = $_POST['select'];
          
    echo '<b><font color=\"#FF6666\"> -(Resultado(s) para: '.$t.')</font></b> <br>';
    if($t == Titulo){
       while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
           echo '<tr>';
        echo '<td>' .$rows_cursos['Id'].'</td>';
        echo '<td>' .$rows_cursos['titulo'].'</td>';
        echo '<td>' .$rows_cursos['autor'].'</td>';
        echo '</tr>';
       $i +=1;
      } 
    }
         if( $t == Autor){
            $result_cursos = "SELECT Id,titulo, autor FROM livros WHERE autor LIKE '%$pesquisar%' ";
            $resultado_cursos = mysqli_query($conn, $result_cursos);
            
            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                echo '<tr>';
                echo '<td>' .$rows_cursos['Id'].'</td>';
                echo ' <td>' .$rows_cursos['titulo']. ' </td>';
                echo '<td>' .$rows_cursos['autor'].'</td>';
                echo '</tr>';
               $i +=1;
          }
        }
              if($t == Categoria){
                $ident= 'Categoria';
                $result_cursos = "SELECT Id, titulo,categoria FROM livros WHERE categoria LIKE '%$pesquisar%' ";
                $resultado_cursos = mysqli_query($conn, $result_cursos);

                while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                    echo '<tr>';
                    echo '<td>' .$rows_cursos['Id'].'</td>';
                    echo '<td>' .$rows_cursos['titulo'].'</td>';
                    echo '<td>' .$rows_cursos['categoria'].'</td>';
                    echo '</tr>';
                   $i +=1;
              }
            }

            if($t == ISBN){
                $result_cursos = "SELECT Id, titulo,ISBN FROM livros WHERE ISBN LIKE '%$pesquisar%' ";
                $resultado_cursos = mysqli_query($conn, $result_cursos);

                while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                    echo '<tr>';
                    echo '<td>' .$rows_cursos['Id'].'</td>';
                    echo '<td>' .$rows_cursos['titulo'].'</td>';
                    echo '<td>' .$rows_cursos['ISBN'].'</td>';
                    echo '</tr>';
                   $i +=1;
              }
            }
    
?>
     </table>
    </body>
 </html>