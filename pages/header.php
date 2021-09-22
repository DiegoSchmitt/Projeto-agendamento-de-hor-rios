<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Projeto agendamento de serviços</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
</head>
<body>
		 <nav class="navbar navbar-expand-lg navbar-light">
		 	<div class="navbar-brand"><img src="" width="200px">Logo</div>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse menu" id="navbarMenu">
				<div class="navbar-nav">
					<a href="index.php" class="nav-item nav-link">Home</a>
					<a href="servicos.php" class="nav-item nav-link">Serviços</a>
					<a href="fotos.php" class="nav-item nav-link">Fotos</a>

					<?php require 'cadastro.php';?>
					<a href="" class="nav-item nav-link" data-toggle="modal" data-target="#janela">Cadastre-se</a>
						<div class="modal fade" id="janela">
							<div class="modal-dialog modal-dialog-centered modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Insira seus dados</h5>
										<button class="close" data-dismiss="modal"><span>&times;</span></button>
									</div>	
									<div class="modal-body">
										<form method="POST">
											<div class="form-group">
												<input id="nome" type="text" name="nome" class="form-control" placeholder="Nome" required />
											</div>
											<div class="form-group">
												<input id="telefone" type="number" name="telefone" class="form-control" placeholder="telefone" required/>
											</div>
											<div class="form-group">
												<input id="email" type="email" name="email" class="form-control" placeholder="E-mail" required />
											</div>
											<div class="form-group">
												<input id="senha" type="password" name="senha" class="form-control" placeholder="Criar senha"
												required/>
											</div>
											<div class="form-group">
												<input class="btn btn-dark" type="submit" value="Cadastrar"/>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

					<a href="" class="nav-item nav-link" data-toggle="modal" data-target="#janela2">Agendar horário</a>
						<div class="modal fade" id="janela2">
							<div class="modal-dialog modal-dialog-centered modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Login</h5>
										<button class="close" data-dismiss="modal"><span>&times;</span></button>
									</div>	
									<div class="modal-body">
										<form method="POST">
											<div class="form-group">
												<input id="nome" type="name" name="nome" class="form-control" placeholder="Nome" required/>
											</div>
											<div class="form-group">
												<input id="senha" type="password" name="senha" class="form-control" placeholder="Senha" required/>
											</div>
											<div class="form-group">
												<input class="btn btn-dark" type="submit" value="Entrar"/>
											</div>
												<?php require 'login.php';?>
											<a href="">Esqueci minha senha</a>
										</form>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		 </nav>
	<script type="text/javascript" src="assets/js/JQuery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>