<?php
require 'autoload.php';
$sql = new Chat();

//VERIFICANDO SE POST EXISTE E ESTA PREENCHIDO
if (!empty($_POST)) { 
	$_SESSION['user'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	if ($sql->setUser($_SESSION['user'])) {
		header('Location: chat.php'); 
	} else {
		unset($_SESSION['user']);
		echo '<script>alert("Esse nick já existe");</script>';
		echo '<script>window.location.href="index.php";</script>';
	}
	
}

if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
	header('Location: index.php'); 
}


?>
<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): 
$nicks = $sql->getUser();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=320px">
	<title>Chat</title>
	<link rel="stylesheet" href="src/css/bootstrap.css">
	<link rel="stylesheet" href="src/css/fontawesome/css/all.css">
	<link rel="stylesheet" href="src/css/chat.css">
	<style type="text/css">
		body{
			background-image: url('src/img/dark.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>
</head>
	<body>
		<div class="container">
			<div class="well text-center">
				<div class="row">
					<div class="col-sm-6">
						<h3>Chat - <?=$nicks[0]['qt']; if($nicks[0]['qt'] == 1): echo ' Usuário'; else: echo ' Usuários'; endif; ?></h3>
					</div>
					<div class="col-sm-6">
						<a href="sair.php" class="btn btn-danger btn-block btn-lg">Sair</a>
					</div>
				</div>
			</div>
			<div class="alert alert-info">
				<div class="row">
					<div class="col-sm-3">
						<!-- LISTA DE USUARIOS LOGADOS -->
						<div class="well nicks" style="overflow: auto;"></div>
					</div>
					<div class="col-sm-9">
						<div class="well chat" style="overflow: auto;"></div>
						<!-- FORMULARIO DE ENVIO DE MENSAGEM -->
						<div class="alert alert-warning form-chat">
							<div class="row">
								<div class="col-sm-2">
									<img src="" class="img-responsive">
									<i><?=htmlspecialchars($_SESSION['user']['nick']); ?></i>
								</div>
								<div class="col-sm-8">
									<textarea class="form-control" name="mensagem" id="mensagem" style="height: 80px;" required=""></textarea>
								</div>
								<div class="col-sm-2">
									<button class="btn btn-primary btn-block btn-enviar">Enviar</button>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="src/js/jquery.min.js"></script>
	<script src="src/js/bootstrap.js"></script>
	<script src="src/js/script.js"></script>
</html>
<?php endif; ?>