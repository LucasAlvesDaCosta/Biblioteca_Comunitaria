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
$id = -1;
$nome   = "";
$email  = "";
$password = "";
 
if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["password"]))
{
	if(empty($_POST["nome"]))
		$erro = "Campo nome obrigatório";
	else
	if(empty($_POST["email"]))
		$erro = "Campo e-mail obrigatório";
    else
       if(empty($_POST["password"]))
             $erro = "campo de senha obrigatório";
     else        
	{
		$id     = $_POST["id"];		
		$nome   = $_POST["nome"];
		$email  = $_POST["email"];
		$password = $_POST["password"];
			
		if($id == -1)
		{
			$stmt = $obj_mysqli->prepare("INSERT INTO `servidor` (`nome`,`email`,`password`) VALUES (?,?,?)");
			$stmt->bind_param('sss', $nome, $email, $password);	
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				header("Location:cadastrar.php");
				exit;
			}
		}
		
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Cadastrar-se</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
					<label for="example-text-input" class="col-xs-2 col-form-label">Nome</label>
					<input class="form-control" name="nome" type="text" placeholder="Qual seu nome?" value="<?=$nome?>" >
					
                    <label for="example-text-input" class="col-xs-2 col-form-label">Email</label>
					<input class="form-control" name="email" type="email" placeholder="email@example.com" value="<?=$email?>" >
					
                    <label for="example-email-input" class="col-xs-2 col-form-label">Senha</label>
                    <input class="form-control" name="password" type="password" placeholder="******" value="<?=$password?>" >
                    
					<br>
					<br>
					<input type="hidden" value="<?=$id?>" name="id">
				<!--Alteramos aqui também, para poder mostrar o texto Cadastrar, ou Salvar, de acordo com o momento. :)-->
					<button class="btn btn-success my-2 my-sm-0" type="submit"><?=($id==-1)?"Cadastrar":"Salvar"?></button>
					
				</div>
			</form>
	<br>
    <br>
    <!--Esta parte pode está contida em um arquivo separado -->
  </body>
</html>