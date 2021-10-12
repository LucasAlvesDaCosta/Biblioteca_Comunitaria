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
$nome   = "";
$email  = "";
$livro_doado = "";
$telefone     = "";
 
if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["livro_doado"]) && isset($_POST["telefone"]))
{
	if(empty($_POST["nome"]))
		$erro = "Campo nome obrigatório";
	else
	if(empty($_POST["email"]))
		$erro = "Campo e-mail obrigatório";
	else
	{
		$id     = $_POST["id"];		
		$nome   = $_POST["nome"];
		$email  = $_POST["email"];
		$livro_doado = $_POST["livro_doado"];
		$telefone    = $_POST["telefone"];
			
		if($id == -1)
		{
			$stmt = $obj_mysqli->prepare("INSERT INTO `doador` (`nome`,`email`,`livro_doado`,`telefone`) VALUES (?,?,?,?)");
			$stmt->bind_param('ssss', $nome, $email, $livro_doado, $telefone);	
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				header("Location:cadastro doador.php");
				exit;
			}
		}
		else
		if(is_numeric($id) && $id >= 1)
		{
			$stmt = $obj_mysqli->prepare("UPDATE `doador` SET `nome`=?, `email`=?, `livro_doado`=?, `telefone`=? WHERE id = ? ");
			$stmt->bind_param('ssssi', $nome, $email, $livro_doado, $telefone, $id);
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				header("Location:cadastro doador.php");
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
		$stmt = $obj_mysqli->prepare("DELETE FROM `doador` WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		
		header("Location:cadastro doador.php");
		exit;
	}
	else
	{
		$stmt = $obj_mysqli->prepare("SELECT * FROM `doador` WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		
		$result = $stmt->get_result();
		$aux_query = $result->fetch_assoc();
		
		$nome = $aux_query["Nome"];
		$email = $aux_query["Email"];
		$livro_doado = $aux_query["Livro_doado"];
		$telefone = $aux_query["Telefone"];
		
		$stmt->close();		
	}
}
 ?>
<!DOCTYPE html>
<html>
  <head>
	<title>Cadastro doador</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
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
                <a class="nav-link" href="home.html">Home-page</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Busca_cliente.html">Procurar por usuários</a>
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
					
					
					
					<label for="example-text-input" class="col-xs-2 col-form-label">Nome</label>
					<input class="form-control" name="nome" type="text" placeholder="Qual nome?" value="<?=$nome?>" >

					<label for="example-text-input" class="col-xs-2 col-form-label">Email</label>
					<input class="form-control" name="email" type="email" placeholder="email@example.com" value="<?=$email?>" >

					<label for="example-email-input" class="col-xs-2 col-form-label">Primeiro Livro doado</label>
					<input class="form-control" name="livro_doado" type="text" placeholder="Exemplo: Cartas para Julieta" value="<?=$livro_doado?>" >

					<label for="example-url-input" class="col-xs-2 col-form-label">Telefone</label>
					<input class="form-control" name="telefone" maxlength="15" type="text" data-format="+55 (ddd) ddd-dddd" placeholder="Exemplo: (DDD) 99999-9999" value="<?=$telefone?>" >
		
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
			
              <h4>Lista de Doadores cadastrados</h4>
					<table class="table table-striped table-bordered table-condensed table-hover" width="450px" border="3" cellspacing="1">
					<tr>
						<td><strong>id</strong></td>
						<td><strong>Nome:</strong></td>
						<td><strong>E-mail:</strong></td>
						<td><strong>Primeiro Livro Doado:</strong></td>
						<td><strong>Telefone:</strong></td>
						<td><strong>Editar</strong></td>
						<td><strong>Excluir</strong></td>
					</tr>
					<?php
					$result = $obj_mysqli->query("SELECT * FROM `doador`");
					while ($aux_query = $result->fetch_assoc()) 
					{
					echo '<tr>';
					echo '  <td>'.$aux_query["Id"].'</td>';
					echo '  <td>'.$aux_query["Nome"].'</td>';
					echo '  <td>'.$aux_query["Email"].'</td>';
					echo '  <td>'.$aux_query["Livro_doado"].'</td>';
					echo '  <td>'.$aux_query["Telefone"].'</td>';
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