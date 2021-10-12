
 <html>
     <head>
         <title> Resultado da busca.</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
         <link rel="shortcut icon" href="img/logo.png">
         <link rel="stylesheet" type="text/css" href="style.css">
     </head>
     <body>
     <nav id="nav-bar" class="navbar navbar-expand-md navbar-light fixed-top">
       <h4>Biblioteca Comunitária</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <div class="ml-auto">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="home.html">Home-Page</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro.php">Voltar</a>
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
        if($ident == Nome)
        $ident = 'UF';
      ?>
     <table class="table table-striped table-bordered table-condensed table-hover" width="450px" border="3" cellspacing="1">
	  <tr>
        <td><strong>Numero</strong></td>
	    <td><strong>Nome</strong></td>
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
    $result_cursos = "SELECT Nome,uf FROM cliente WHERE Nome LIKE '%$pesquisar%' ";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    $i =1;
    $t = $_POST['select'];
          
    echo '<b><font color=\"#FF6666\"> -(Resultado(s) para: '.$t.')</font></b> <br>';

    if($t == Nome){
       while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
           echo '<tr>';
        echo '<td>' .$i.'</td>';
        echo '<td>' .$rows_cursos['Nome'].'</td>';
        echo '<td>' .$rows_cursos['uf'].'</td>';
        echo '</tr>';
       $i +=1;
      } 
    }
         if( $t == Email){
            $result_cursos = "SELECT Nome,Email FROM cliente WHERE Email LIKE '%$pesquisar%' ";
            $resultado_cursos = mysqli_query($conn, $result_cursos);
            
            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                echo '<tr>';
                echo '<td>' .$i.'</td>';
                echo ' <td>' .$rows_cursos['Nome']. ' </td>';
                echo '<td>' .$rows_cursos['Email'].'</td>';
                echo '</tr>';
               $i +=1;
          }
        }
              if($t == Cidade){
                $result_cursos = "SELECT Nome,cidade FROM cliente WHERE cidade LIKE '%$pesquisar%' ";
                $resultado_cursos = mysqli_query($conn, $result_cursos);

                while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                    echo '<tr>';
                    echo '<td>' .$i.'</td>';
                    echo '<td>' .$rows_cursos['Nome'].'</td>';
                    echo '<td>' .$rows_cursos['cidade'].'</td>';
                    echo '</tr>';
                   $i +=1;
              }
            
            }
    
?>
     </table>
    </body>
 </html>