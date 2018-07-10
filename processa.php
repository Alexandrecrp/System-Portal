<?php
session_start();

//Incluir a conexao com BD
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "logsystem";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

//Receber os dados do formulário
//$arquivo = $_FILES['arquivo'];
//var_dump($arquivo);
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

//ler todo o arquivo para um array
$dados = file($arquivo_tmp);
//var_dump($dados);

foreach($dados as $linha){
	$linha = trim($linha);
	$valor = explode(',', $linha);
	var_dump($valor);
	
	$nome = $valor[0];
	$valor = $valor[1];
	
	$result_produto = "INSERT INTO produtos (nome, valor, data) VALUES ('$nome', '$valor',now())";
	
	$resultado_produto = mysqli_query($conn, $result_produto);	
}
$_SESSION['msg'] = "<p style='color: green;'>Carregado os dados com sucesso!</p>";
header("Location: painel.php");
?>



