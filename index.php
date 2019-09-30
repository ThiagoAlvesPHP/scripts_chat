<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=320px">
	<title>Chat</title>
	<link rel="stylesheet" href="src/css/bootstrap.css">
	<link rel="stylesheet" href="src/css/fontawesome/css/all.css">
	<link rel="stylesheet" href="src/css/style.css">
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
				<h1>Login do Chat</h1>
			</div>
			<div class="alert alert-info">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<form method="POST" action="chat.php">
							<label>Nick</label>
							<input type="text" name="nick" class="form-control" autofocus="">
							<label>Sexo</label>
							<select class="form-control" name="sexo">
								<option value="1">Masculino</option>
								<option value="2">Feminino</option>
							</select>
							<br>
							<button class="btn btn-success btn-block btn-lg">Entrar</button>
						</form>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</div>
		</div>
	</body>
	<script src="src/js/jquery.min.js"></script>
	<script src="src/js/bootstrap.js"></script>
	<script src="src/js/script.js"></script>
</html>