<?php
session_start();
require_once ("classes/DAO/usuarioDAO.php");

$usuarioDAO = new usuarioDAO();

if (isset($_POST['btnSubmit'])) {

    if ($usuarioDAO->login($_POST['txtEmail'], $_POST['txtPassword'])) {

        $_SESSION['logado'] = '1';
		$_SESSION['nome'] = $usuarioDAO->RetornaNome($_POST['txtEmail']);
	  
	  header ("Location: painel.php");
    } else {
        ?>
        <script type="text/javascript">
            alert("Usuário ou senha inválido.");
        </script>
        <?php
    }
}

if (isset($_GET['erro'])) {
    switch ($_GET['erro']) {
        case "1":
            ?>
            <script type="text/javascript">
                alert("Você não tem permissão para acessar o painel.");
            </script>
            <?php
            break;
        case "2":
            ?>
            <script type="text/javascript">
                alert("Você saiu do painel.");
            </script>
            <?php
            break;
    }
}

/*if ($_SESSION['logado'] == 1) {
   header ("Location: painel.php");
}*/
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>.::Portal Construtora::.</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<!-- Bootstrap core CSS -->
		<link href="dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="assets/css/logins.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
		
		<link href="asset/css/themify-icons.css" rel="stylesheet">
		
        <link rel="shortcut icon" href="img/logo2.png" />
    </head>
    <body>
	<div class="container">
            <form method="post" class="form-signin" name="frmLogin">
				<div class="alert">
					<center>
						<img src="img/portal.png">
						<h2 class="page-header"></h2>
					</center>
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						<div class="form-group">
							<input type="text" name="txtEmail" class="form-control" placeholder="Email" autocomplete="off" required >
						</div>
							<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
						<div class="form-group">
							<input type="password" name="txtPassword" class="form-control " placeholder="*****" autocomplete="off" required >		
						</div>
						<div class="form-group">
							<input type="submit" name="btnSubmit" value="Login" class="btn btn-danger" />
						</div>
						<center>
							<a href="recuperarSenha.php" class="colorwhite">Recuperar Senha</a>
						</center>
				</div>		
            </form>
	</div>	
    </body>
</html>
