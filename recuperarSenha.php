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
            <form method="post" class="form-signin" name="frmRecuperarSenha">
				<div class="alert">
					<center>
						<img src="img/portal.png">
						<h2 class="page-header"></h2>
					</center>	
					<p class="colorwhite">Para redefinir sua senha, por favor insira seu e-mail de cadastro no formulário abaixo.</p>
					<div class="form-group">
						<h5 class="colorwhite">E-mail:</h5>
						<input type="email" name="txtEmail" class="form-control" placeholder="email@dominio.com" required="required" class="inputForm" />
					</div>					
					<div class="form-group">	
						<input type="submit" name="btnSubmit" value="Recuperar" class="btn btn-danger" />
					</div>
				</div>		
            </form>
        </div>
    </body>
</html>
<?php
if (isset($_POST['btnSubmit'])) {
    $mail = $_POST['txtEmail'];
    $mailCript = base64_encode($_POST['txtEmail']);
    $mensagem = "Você esta recebendo este e-mail, por que foi solicitado a alteração de senha para o site NOME_SITE, clique no link abaixo para redefinir sua senha. <br /><a href='http://localhost/loginsistema/sistemalogin/redefinirSenha.php?conta={$mailCript}'>Recuperar Senha</a>";
    
    require_once("enviarEmail.php");

    enviarEmail($_POST['txtEmail'], "Prezado", "Recuperação de senha", $mensagem);
}
?>


<table class="table alert-success" style="border: 1px solid green">
										<tbody>
										<tr>
											<td>
												<h6 align="right">
												<strong>
												
												</strong>
												</h6>
											</td>
											<td>
												<h6>
													<strong>
															
													</strong>
														
												</h6>
												</td>
												<td>
												</td>
												<td>
													<h6 align="right">
													</h6>
												</td>
													<td>
														<h6>
															<center>
																<h1><br>Dados do Produtor</h1><br>
															<center>
														</h6>
													</td>
													<td>
													</td>
													<td>
														<h6 align="right">
														</h6>
													</td>
													<td>
														<h6>
															<strong>
																	
															</strong>
															
														</h6>
													</td>
													<td>
													</td>
													<td>
														<h6 align="right">
														</h6>
													</td>
														<td>
															<h6>
																<strong>
																	
																</strong>
																
															</h6>
														</td>
														<td>
														</td>
													<td>
													</td>
												</tr><br>
										
										
										<tr>
											<td>
												<h6 align="right">
												<strong>
												Dados:
												</strong>
												</h6>
											</td>
											<td>
												<h6>
													<strong>
															Safra:
													</strong>
														<?php echo number_format($w[1]->getProducaoEsperada(),0,",","."); ?> <small>Scs 60kgs</small>
												</h6>
												</td>
												<td>
												</td>
												<td>
													<h6 align="right">
													</h6>
												</td>
													<td>
														<h6>
															<strong>
																	Média - Litros Por Saca:
																</strong>
																<?php echo number_format($l[1]->getMediaLitroPorSaca(),0,",","."); ?><small>L/Scs</small>
														</h6>
													</td>
													<td>
													</td>
													<td>
														<h6 align="right">
														</h6>
													</td>
													<td>
														<h6>
															<strong>
																	Jornada de Trabalho Pós Colheita(hr):
															</strong>
															<?php echo $l[1]->getJornadaTrabalho();?> <small>hrs</small>
														</h6>
													</td>
													<td>
													</td>
													<td>
														<h6 align="right">
														</h6>
													</td>
														<td>
															<h6>
																<strong>
																	Café de Varrição(%):
																</strong>
																<?php echo $l[1]->getCafeDeVarricao();?><small>%.</small>
															</h6>
														</td>
														<td>
														</td>
													<td>
													</td>
												</tr>
											<br>
										</tbody>
									</table>