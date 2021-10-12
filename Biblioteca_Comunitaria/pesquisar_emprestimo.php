
 <html>
     <head>
         <title> Resultado da busca.</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
         <link rel="shortcut icon" href="img/logo.png">
         <link rel="stylesheet" type="text/css" href="style.css">
     </head>
     <body>
     <nav id="nav-bar" class="navbar navbar-expand-md navbar-light fixed-top">
     
      <h1>Biblioteca Comunitária.</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="ml-auto">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="home.html">Home-page </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="emprestimo.php">Voltar</a>
              </li>
            </ul>
          </div><!-- /ml-auto -->

        </div><!-- /collapse -->

      </div><!-- /container -->
    </nav>
    <br>
    <br>
    <br>
    <br>
      <?=$ident = $_POST['select'];?>
      <?php
        if($ident == Nome)
        $ident = 'Livro';
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
    $i =1;
    $t = $_POST['select'];
          
    echo '<b><font color=\"#FF6666\"> -(Resultado(s) para: '.$t.')</font></b> <br>';

    if($t == Nome){
        $result_cursos = "SELECT emprestimo.Id, cliente.Nome,livros.titulo FROM emprestimo 
        INNER JOIN cliente ON(emprestimo.cliente_id = cliente.Id)
        INNER JOIN livros ON(emprestimo.livro_id = livros.Id) WHERE cliente.Nome LIKE '%$pesquisar%'";
        $resultado_cursos = mysqli_query($conn, $result_cursos);

       while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
           echo '<tr>';
        echo '<td>' .$i.'</td>';
        echo '<td>' .$rows_cursos['Nome'].'</td>';
        echo '<td>' .$rows_cursos['titulo'].'</td>';
        echo '</tr>';
       $i +=1;
      } 
    }else
         if($t == Titulo){
            $result_cursos = "SELECT emprestimo.Id, cliente.Nome, livros.titulo FROM emprestimo 
            INNER JOIN cliente ON(emprestimo.cliente_id = cliente.Id)
            INNER JOIN livros ON(emprestimo.livro_id = livros.Id) WHERE livros.titulo LIKE '%$pesquisar%'";
             $resultado_cursos = mysqli_query($conn, $result_cursos);

            while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                echo '<tr>';
                echo '<td>' .$i.'</td>';
                echo ' <td>' .$rows_cursos['Nome']. ' </td>';
                echo '<td>' .$rows_cursos['titulo'].'</td>';
                echo '</tr>';
               $i +=1;
          }
        }
              if($t == 'Data'){
               $result_cursos = "SELECT emprestimo.Id, livros.titulo, emprestimo.devolucao FROM emprestimo 
            INNER JOIN cliente ON(emprestimo.cliente_id = cliente.Id)
            INNER JOIN livros ON(emprestimo.livro_id = livros.Id) WHERE emprestimo.devolucao LIKE '%$pesquisar%'";
             $resultado_cursos = mysqli_query($conn, $result_cursos);
                while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
                    echo '<tr>';
                    echo '<td>' .$i.'</td>';
                    echo '<td>' .$rows_cursos['Nome'].'</td>';
                    echo '<td>' .$rows_cursos['devolucao'].'</td>';
                    echo '</tr>';
                   $i +=1;
              }
            
            }
    
?>
     </table>
    </body>
 </html>