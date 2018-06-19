<?php
$servidor = 'localhost:3307';
$banco = 'tutocrudphp';
$usuario = 'root';
$senha = 'Gravidade';
$obj_mysqli = new mysqli($servidor,$usuario,$senha,$banco);
 
if ($obj_mysqli->connect_errno)
{
	echo "Ocorreu um erro na conexão com o banco de dados.";
	exit;
}
 
mysqli_set_charset($obj_mysqli, 'utf8');
$id     = -1;
$titulo   = "";
$autor  = "";
$editora = "";
$isbn     = "";
$categoria = "";

 
if(isset($_POST["titulo"]) && isset($_POST["autor"]) && isset($_POST["editora"]) && isset($_POST["isbn"]) && isset($_POST["categoria"]))
{
	if(empty($_POST["titulo"]))
		$erro = "Campo nome obrigatório";
	else
	if(empty($_POST["autor"]))
		$erro = "Campo e-mail obrigatório";
	else
	{
		$id     = $_POST["id"];		
		$titulo   = $_POST["titulo"];
		$autor  = $_POST["autor"];
		$editora = $_POST["editora"];
        $isbn     = $_POST["isbn"];
        $categoria = $_POST["categoria"];
			
		if($id == -1)
		{
			$stmt = $obj_mysqli->prepare("INSERT INTO `livros` (`titulo`,`autor`,`editora`,`isbn`,`categoria`) VALUES (?,?,?,?,?)");
			$stmt->bind_param('ssiss', $titulo, $autor, $editora, $isbn, $categoria);	
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				header("Location:livros_cadastro.php");
				exit;
			}
		}
		else
		if(is_numeric($id) && $id >= 1)
		{
			$stmt = $obj_mysqli->prepare("UPDATE `livros` SET `titulo`=?, `autor`=?, `editora`=?, `isbn`=?, `categoria`=? WHERE id = ? ");
			$stmt->bind_param('ssissi', $titulo, $autor, $editora, $isbn,$categoria, $id);
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				header("Location:livros_cadastro.php");
				exit;
			}
		}
		else
		{
			$erro = "Número inválido";
		}
	}
}
else
if(isset($_GET["id"]) && is_numeric($_GET["id"]))
{
	$id = (int)$_GET["id"];
	
	if(isset($_GET["del"]))
	{
		$stmt = $obj_mysqli->prepare("DELETE FROM `livros` WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		
		header("Location:livros_cadastro.php");
		exit;
	}
	else
	{
		$stmt = $obj_mysqli->prepare("SELECT * FROM `livros` WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		
		$result = $stmt->get_result();
		$aux_query = $result->fetch_assoc();
		
		$titulo = $aux_query["Titulo"];
		$autor = $aux_query["Autor"];
		$editora = $aux_query["Editora"];
        $isbn = $aux_query["Isbn"];
        $categoria = $aux_query["Categoria"];
		
		$stmt->close();		
	}
}
 ?>
<!DOCTYPE html>
<html>
  <head>
	<title>Livros e doações</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <nav id="nav-bar" class="navbar navbar-expand-md navbar-light fixed-top">
      <div class="container">

        <a class="navbar-brand" href="index.html">
          <img class="logo" src="img/logo.png">
        </a>

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
          <form class="form-inline">
            <input class="form-control" type="text" placeholder="Buscar">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Pesquisar</button>
          </form>

          <div class="ml-auto">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="login.html">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastro.html">Cadastrar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="atendimento.html">Atendimento</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Perfil
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Meus Pedidos</a>
                  <a class="dropdown-item" href="#">Carrinho de Compras</a>
                  <a class="dropdown-item" href="#">Sair</a>
                </div>
              </li>
            </ul>
          </div><!-- /ml-auto -->

        </div><!-- /collapse -->

      </div><!-- /container -->
    </nav>
    <?php
	if(isset($erro))
		echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
	else
	if(isset($sucesso))
		echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
	
	?>

			<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
				<div class="form-group row col-sm-6 d-flex" >
					
					
					
					<label for="example-text-input" class="col-xs-2 col-form-label">Titulo</label>
					<input class="form-control" name="titulo" type="text" placeholder="title" value="<?=$titulo?>" >

					<label for="example-text-input" class="col-xs-2 col-form-label">Autor</label>
					<input class="form-control" name="autor" type="text" placeholder="Nome do autor" value="<?=$autor?>" >

					<label for="example-email-input" class="col-xs-2 col-form-label">Cod. identificação Doador</label>
					<input class="form-control" name="editora" type="text" placeholder="Código de identificação do doador" value="<?=$editora?>" >

					<label for="example-url-input" class="col-xs-2 col-form-label">ISBN</label>
					<input class="form-control" name="isbn" type="text"placeholder="código ISBN" value="<?=$isbn?>" >

                    <label for="example-url-input" class="col-xs-2 col-form-label">Categoria</label>
					<input class="form-control" name="categoria" type="text"placeholder="Terror, Drama" value="<?=$categoria?>" >
					<br>
					<br>
					<input type="hidden" value="<?=$id?>" name="id">
				<!--Alteramos aqui também, para poder mostrar o texto Cadastrar, ou Salvar, de acordo com o momento. :)-->
					<button class="btn btn-success my-2 my-sm-0" type="submit"><?=($id==-1)?"Cadastrar":"Salvar"?></button>
					
				</div>
			</form>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>

                    <div class="page-header">
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Livros.<br><br> <small>Lista de todos os livros da biblioteca.</small> </h1>
                    </div>

					<table class="table table-striped table-bordered table-condensed table-hover" width="450px" border="3" cellspacing="1">
					<tr>
						<td><strong>id</strong></td>
						<td><strong>Titulo:</strong></td>
						<td><strong>Autor(a):</strong></td>
						<td><strong>Doador:</strong></td>
						<td><strong>Isbn:</strong></td>
                        <td><strong>Categoria:</strong></td>
						<td><strong>Editar</strong></td>
						<td><strong>Excluir</strong></td>
					</tr>
					<?php
					$result = $obj_mysqli->query("SELECT * FROM `livros`");
					while ($aux_query = $result->fetch_assoc()) 
					{
					echo '<tr>';
					echo '  <td>'.$aux_query["Id"].'</td>';
					echo '  <td>'.$aux_query["Titulo"].'</td>';
					echo '  <td>'.$aux_query["Autor"].'</td>';
					echo '  <td>'.$aux_query["Editora"].'</td>';
                    echo '  <td>'.$aux_query["Isbn"].'</td>';
                    echo '  <td>'.$aux_query["Categoria"].'</td>';
					echo '  <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'">Editar</a></td>';
					echo '  <td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'&del=true">Excluir</a></td>';
					echo '</tr>';
					}
					?>
					</table>

	<footer >
          <br>
          <div class="container ">
            <div class="row">
              <div class="col-sm-6 letra" >
                   <small> 

                    <a href="#" style="color: white">Atendimento</a>
                    <br>
                    <a href="#" style="color: white">Sobre a empresa</a>
                    <br>
                    Biblioteca Comunitária
                  </small>
			  </div>
			  <div class="col-sm-6 letra" >
                   <small> 

                    Contato: 61 9 99377576
                    <br>
                    Rua 05, nº102, Bairro São Vicente, Formosa-Goiás
                  </small>
			  </div>
			</div>
		</div>

               
    </footer> 
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
  
</html>